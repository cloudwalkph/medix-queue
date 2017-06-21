<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        $today = Carbon::now('Asia/Manila')->toDateString();

        $appointments = Appointment::whereDate('appointment_date', '=', $today)
            ->orderBy('appointment_time')
            ->get();

        return view('dashboard.index', compact('patients', 'appointments'));
    }

    public function createAppointment(Request $request)
    {
        $user = $request->user();
        $input = $request->only(['patient_id', 'chief_complaint']);

        $input['appointment_date'] = Carbon::now('Asia/Manila')->toDateString();
        $input['appointment_time'] = Carbon::now('Asia/Manila')->toTimeString();
        $input['status'] = 'pending';
        $input['user_id'] = $user->id;

        $appointment = Appointment::create($input);

        if ($appointment) {
            $request->session()->flash('success', 'Successfully created an appointment');
        }

        return redirect()->back();
    }
}
