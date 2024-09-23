<?php

namespace App\Jobs;

use App\Mail\ProductNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendProductNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    /**
     * Create a new job instance.
     *
     * @param $product
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->product->user->email)->send(new ProductNotification($this->product));
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }
}
