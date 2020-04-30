<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
use Carbon\Carbon;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::insert([
            'user_id' => 134256,
            'currency_from' => 'EUR',
            'currency_to' => 'GBP',
            'amount_sell' => 1000,
            'amount_buy' => 747.1,
            'rate' => 0.7471,
            'time_placed' => '2018-01-24 10:27:44',
            'originating_country' => 'FR',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Message::insert([
            'user_id' => 134256,
            'currency_from' => 'HKD',
            'currency_to' => 'GBP',
            'amount_sell' => 5000,
            'amount_buy' => 515.83,
            'rate' => 0.103166,
            'time_placed' => '2018-01-24 10:27:44',
            'originating_country' => 'HK',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Message::insert([
            'user_id' => 134256,
            'currency_from' => 'EUR',
            'currency_to' => 'HKD',
            'amount_sell' => 1000,
            'amount_buy' => 8414.38,
            'rate' => 8.41438,
            'time_placed' => '2018-01-24 10:27:44',
            'originating_country' => 'FR',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Message::insert([
            'user_id' => 134256,
            'currency_from' => 'HKD',
            'currency_to' => 'GBP',
            'amount_sell' => 2000,
            'amount_buy' => 206.33,
            'rate' => 0.103165,
            'time_placed' => '2018-01-24 10:27:44',
            'originating_country' => 'HK',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Message::insert([
            'user_id' => 134256,
            'currency_from' => 'EUR',
            'currency_to' => 'USD',
            'amount_sell' => 1500,
            'amount_buy' => 1628.31,
            'rate' => 1.08554,
            'time_placed' => '2018-01-24 10:27:44',
            'originating_country' => 'DE',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        Message::insert([
            'user_id' => 134256,
            'currency_from' => 'EUR',
            'currency_to' => 'GBP',
            'amount_sell' => 2000,
            'amount_buy' => 1494.2,
            'rate' => 0.7471,
            'time_placed' => '2018-01-24 10:27:44',
            'originating_country' => 'IT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
