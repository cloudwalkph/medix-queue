<?php
namespace App\Http\Controllers\Queue;

use App\Http\Controllers\Controller;

class QueuesController extends Controller {
    public function queues()
    {
        return view('queue.index');
    }
}