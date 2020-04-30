<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public $messageData = [
        "userId" => "134256",
        "currencyFrom" => "EUR",
        "currencyTo" => "GBP",
        "amountSell" => 1000,
        "amountBuy" => 747.10,
        "rate" => 0.7471,
        "timePlaced" => "24-JAN-18 10:27:44",
        "originatingCountry" => "FR"
    ];
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testConsumeMessage()
    {
        $response = $this->postJson(route('consume',$this->messageData));

        $response->assertStatus(200)->assertJson([
            "status" => "success"
        ]);
    }

    public function testConsumeInvalidMessage()
    {
        $this->messageData["currencyTo"] = "ABCDE";
        $response = $this->postJson(route('consume',$this->messageData));

        $response->assertStatus(422)->assertJson([
            "status" => "error"
        ]);
    }

    public function testConsumeMessageMissingParameter()
    {
        unset($this->messageData["originatingCountry"]);
        $response = $this->postJson(route('consume',$this->messageData));

        $response->assertStatus(422)->assertJson([
            "status" => "error"
        ]);
    }
}
