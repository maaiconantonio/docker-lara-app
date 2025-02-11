<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Cake;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\InterestEmail;

class SendInterestNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $cake;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Cake $cake)
    {
        $this->user = $user;
        $this->cake = $cake;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new InterestEmail($this->user, $this->cake));
    }
}
