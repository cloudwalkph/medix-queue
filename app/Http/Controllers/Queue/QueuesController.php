<?php
namespace App\Http\Controllers\Queue;

use App\Events\QueueUpdated;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Queue;
use App\Models\QueueNumber;
use App\Notifications\AppointmentCreated;
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