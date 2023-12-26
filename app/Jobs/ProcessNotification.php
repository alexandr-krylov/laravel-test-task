<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $product;
    protected $emailAddress;

    /**
     * Create a new job instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
        $this->emailAddress = config('products.email');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        var_dump($this->product, $this->emailAddress);
    }
}
