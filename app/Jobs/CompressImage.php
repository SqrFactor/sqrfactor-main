<?php

namespace App\Jobs;

use App\ImagesForCompression;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class CompressImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $images = ImagesForCompression::where('status','n')->get();
        foreach ($images as $image){
            //Log::info($image->url);
            \Tinify\setKey('Sak_WBf0yIk2ZNNp08mV79sb851auJXx');

            $source = \Tinify\fromFile($image->url);
            $source->toFile($image->url);
            $image->status = "y";
            $image->save();
        }

    }
}
