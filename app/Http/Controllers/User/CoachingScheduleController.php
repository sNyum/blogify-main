<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoachingScheduleController extends Controller
{
    public function index()
    {
        $schedules = \App\Models\CoachingSchedule::orderBy('date', 'desc')->orderBy('time', 'asc')->get();
        return view('user.schedule.index', compact('schedules'));
    }
}
