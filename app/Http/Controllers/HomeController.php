<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Queue;
use App\Models\QueueNumber;
use App\Notifications\AppointmentCreated;
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

        $queues = Queue::whereDate('created_at', '=', $today)
            ->where('status', '<>', 'completed')
            ->get();

        return view('dashboard.index', compact('patients', 'appointments', 'queues'));
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

            if ($request->has('addToQueue') && $request->get('addToQueue')) {
                $this->addToQueue($appointment->id);
            }
        }

        return redirect()->back();
    }

    private function addToQueue($appointmentId)
    {
        $result = null;
        \DB::transaction(function() use ($appointmentId, &$result) {
            $data = [
                'appointment_id'    => $appointmentId,
                'user_id'           => 1,
                'queue_number'      => $this->generateQueueNumber(),
                'status'            => 'available',
                'facility'          => 'consultation'
            ];

            // consultation
            $result[] = Queue::create($data);

            // laboratory
            $data['status'] = 'lock';
            $data['facility'] = 'laboratory';
            $result[] = Queue::create($data);

            // xray
            $data['status'] = 'lock';
            $data['facility'] = 'xray';

            if ($result) {
                // Update appointment
                Appointment::where('id', $appointmentId)
                    ->update([
                        'status'    => 'in-queue'
                    ]);
            }

            $result[] = Queue::create($data);
        });

        if (count($result) > 0) {
            $appointment = Appointment::where('id', $appointmentId)->first();

            $appointment->patient->notify(new AppointmentCreated($result[0]->queue_number));
        }
    }

    private function generateQueueNumber()
    {
        $queue = 1000;
        $today = Carbon::today('Asia/Manila')->toDateString();

        $current = QueueNumber::whereDate('number_date', '=', $today)
            ->orderBy('number', 'DESC')
            ->first();

        if (! $current) {
            QueueNumber::create([
                'number' => $queue,
                'number_date'   => $today
            ]);

            return $queue;
        }

        $queue = $current->number + 1;
        QueueNumber::create([
            'number' => $queue,
            'number_date'   => $today
        ]);

        return $queue;
    }
}
