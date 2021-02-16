<?php

namespace App\Console\Commands;

use App\BaseCurrency;
use App\Currency;
use App\Jobs\CurrencyJobs;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CurrencyChanger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Currency ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        $base= BaseCurrency::first();
        $response = $client->get('https://api.exchangeratesapi.io/latest?base='.$base->name);
        $rate = json_decode($response->getBody());
        foreach ($rate->rates as $key=>$v){

            CurrencyJobs::dispatch($key,$v,$base->id)->delay(now()->addMinute(1));
//            Currency::create(['name'=>$key,'rate'=>$v,'base_id'=>$base->id]);

        }
    }
}
