<?php

namespace App\Http\Controllers\BpsStaff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoachingScheduleController extends Controller
{
    public function index()
    {
        $schedules = \App\Models\CoachingSchedule::orderBy('date', 'desc')->orderBy('time', 'asc')->get();
        return view('bps.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('bps.schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'topic' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'participants' => 'required|string',
            'status' => 'required|in:upcoming,postponed,completed',
        ]);

        \App\Models\CoachingSchedule::create($request->all() + [
            'created_by' => auth('bps')->id(),
        ]);

        return redirect()->route('bps.schedule.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $schedule = \App\Models\CoachingSchedule::findOrFail($id);
        return view('bps.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'topic' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'participants' => 'required|string',
            'status' => 'required|in:upcoming,postponed,completed',
        ]);

        $schedule = \App\Models\CoachingSchedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('bps.schedule.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $schedule = \App\Models\CoachingSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('bps.schedule.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
