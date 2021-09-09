<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use File;
use Storage;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if($request->keyword)
        {
        // search by title
        $user = auth()->user();
        $schedules = $user->schedules()->where('title','LIKE','%'.$request->keyword.'%')->paginate(2);
        }

        else
        {
            // query all schedule from 'schedules' table to $schedules
            // select * from schedules - SQL Query
            //$schedules = Schedule::all();
            $user = auth()->user();
            $schedules = $user->schedules()->paginate(2);
        }
        // query all schedule from 'schedules' table to $schedules
        // select * from schedules - SQL Query
        // $schedules = Schedule::all();

        // schedules user yg tgah login sahaja
        // function paginate utk show berapa per page
        // $user = auth()->user();
        // $schedules = $user->schedules()->paginate(2);

        // return to view with $schedules
        // resurces/views/schedules/index.blade.php
        return view('schedules.index', compact('schedules'));

    }

    public function create()
    {
        // this is schedule create form
        // show create form
        // resources/views/schedules/create.blade.php
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        // store all input to table 'schedules' using model Schedule
        $schedule = new Schedule();
        $schedule->title = $request->title;
        $schedule->description = $request->description;
        $schedule->user_id = auth()->user()->id;
        $schedule->save();

        // add attachment
        if($request->hasFile('attachment'))
        {
            //rename file - ltak id, tarikh ( 5-2021-09-03.jpg/xls)
            $filename = $schedule->id.'-'.date("y-m-d").'.'.$request->attachment->getClientOriginalExtension();

            //Storage attachment on storage
            Storage::disk('public')->put($filename, File::get($request->attachment));

            // update row
            $schedule->attachment = $filename;
            $schedule->save();
        }

        // return to index
        return redirect()
            ->route('schedule:index')
            ->with([
            'alert-type' => 'alert-primary',
            'alert' => 'Your Schedule Have Been Saved!'
        ]);
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Schedule $schedule, Request $request)
    {
        // Update $schedule using input from edit form

        $schedule->title = $request->title;
        $schedule->description = $request->description;
        $schedule->save();

        //redirect to schedule index
        return redirect()->route('schedule:index');
    }

    public function destroy (Schedule $schedule)
    {
        if($schedule->attachment)
        {
            Storage::disk('public')->delete($schedule->attachment);
        }

        // Delete $schedule from db
        $schedule->delete();

        // return to schedule index
        return redirect()
        ->route('schedule:index')
        ->with([
            'alert-type' => 'alert-danger',
            'alert' => 'Your Schedule Have Been Deleted!'
        ]);
    }

    public function forceDestroy(Schedule $schedule)
{
    $schedule->forceDelete();

    return redirect()
    ->route('schedule:index')
    ->with([
        'alert-type' => 'alert-danger',
        'alert' => 'Your Schedule Have Been Deleted!'
    ]);
}
}
