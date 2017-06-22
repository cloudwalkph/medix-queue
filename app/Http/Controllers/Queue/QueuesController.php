<?php
namespace App\Http\Controllers\Queue;

use App\Events\QueueUpdated;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Queue;
use App\Models\QueueNumber;
use App\Notifications\AppointmentCreated;
use App\Notifications\AppointmentUpdated;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QueuesController extends Controller {
    public function queues()
    {
        return view('queue.index');
    }

    public function addQueue(Request $request)
    {
        $input = $request->only(['appointment_id']);

        // Create queues
        $result = null;
        \DB::transaction(function() use ($input, &$result) {
            $data = [
                'appointment_id'    => $input['appointment_id'],
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
                Appointment::where('id', $input['appointment_id'])
                    ->update([
                        'status'    => 'in-queue'
                    ]);
            }

            $result[] = Queue::create($data);
        });

        if (count($result) > 0) {
            $request->session()->flash('success', 'Successfully added appointment into the queue');
            $appointment = Appointment::where('id', $input['appointment_id'])->first();

            $appointment->patient->notify(new AppointmentCreated($result[0]->queue_number));
//            event(new QueueUpdated($result[0]));
        }

        return redirect()->back();
    }

    public function call(Request $request)
    {
        $input = $request->only(['queue_id']);

        $queue = Queue::where('status', 'available')
            ->where('id', $input['queue_id'])
            ->first();

        if ($queue) {
            // lock others
            Queue::where('queue_number', $queue->queue_number)
                ->where('status', 'available')
                ->where('id', '<>', $queue->id)
                ->update(['status' => 'lock']);

            event(new QueueUpdated($queue));
            $queue->appointment->patient->notify(new AppointmentUpdated($queue));
        }

        return redirect()->back();
    }

    public function arrived(Request $request)
    {
        $input = $request->only(['queue_id']);
        $user = $request->user();

        $queue = Queue::where('status', 'available')
            ->where('id', $input['queue_id'])
            ->first();

        $queue->update([
            'user_id' => $user->id,
            'status' => 'on-going',
            'started_time'  => Carbon::today('Asia/Manila')->toDateTimeString()
        ]);

        event(new QueueUpdated($queue));

        return redirect()->back();
    }

    public function completed(Request $request)
    {
        $input = $request->only(['queue_id']);
        $user = $request->user();

        $queue = Queue::where('status', 'on-going')
            ->where('id', $input['queue_id'])
            ->first();

        $queue->update([
            'user_id' => $user->id,
            'status' => 'completed',
            'completed_time'  => Carbon::today('Asia/Manila')->toDateTimeString()
        ]);

        Queue::where('queue_number', $queue->queue_number)
            ->where('status', 'lock')
            ->update(['status' => 'available']);

        $this->checkAllQueue($queue->appointment_id);

        return redirect()->back();
    }

    private function checkAllQueue($appointmentId)
    {
        $queues = Queue::where('appointment_id', $appointmentId)
            ->where('status', '<>', 'completed')
            ->get();

        if ($queues->isEmpty()) {
            // complete the appointment
            Appointment::where('id', $appointmentId)
                ->update(['status' => 'completed']);
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