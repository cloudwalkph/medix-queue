<?php
namespace App\Services;

use App\Services\SMS\Semaphore;

class SMSMessage {
    private $to;

    private $from;

    private $message;

    public function __construct()
    {
        $this->from = 'MEDIX';
    }

    /**
     * @param $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function send()
    {
        $semaphore = new Semaphore();

        return $semaphore->sendSMS($this->to, $this->message);
    }
}