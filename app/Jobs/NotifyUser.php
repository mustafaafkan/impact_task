<?php

namespace App\Jobs;

use App\Models\CreditPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
class NotifyUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $payment;
    /**
     * Create a new job instance.
     */
    public function __construct(CreditPayment $creditPayment)
    {
        $this->payment = $creditPayment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = $this->payment->credit->user->email;

        Mail::send('email.notify-user',[], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Monthly Installment');
        });
    }
}
