<?php

namespace App\Jobs;

use App\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CurrencyJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $baseId = '';
    public $key = '';
    public $value = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key,$value,$baseid)
    {
        $this->key = $key;
        $this->baseId = $baseid;
        $this->value = $value;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $create =Currency::where('name','=',$this->key)->delete();
            Currency::create(['name'=>$this->key,'rate'=>$this->value,'base_id'=>$this->baseId]);

}
}
