<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use Carbon\Carbon;
use Validator;
use DB;
use App\Models\Message;

class TradeMessageController extends Controller
{
    //
    public function consume(Request $request) {
        $validateRules = [
            'userId' => 'required|integer|digits_between:0,10',
            'currencyFrom' => 'required|string|max:3' ,
            'currencyTo' => 'required|string|max:3',
            'amountSell' => 'required|numeric',
            'amountBuy' => 'required|numeric',
            'rate' => 'required|numeric|max:1',
            'timePlaced' => 'required|date',
            'originatingCountry' => 'required|string|max:2'
        ];

        $validator = Validator::make($request->all(), $validateRules);
        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $validator->errors()
            ], 422);
        }
        $validatedData = $request->validate($validateRules);

        $message = new Message;
        $message->user_id = $validatedData['userId'];
        $message->currency_from = $validatedData['currencyFrom'];
        $message->currency_to = $validatedData['currencyTo'];
        $message->amount_sell = $validatedData['amountSell'];
        $message->amount_buy = $validatedData['amountBuy'];
        $message->rate = $validatedData['rate'];
        $message->time_placed = Carbon::parse($validatedData['timePlaced'])->format('Y-m-d H:i:s');
        $message->originating_country = $validatedData['originatingCountry'];
        $message->save();

        Cache::forget("messages");
        Cache::forget("currencyFromStat");
        Cache::forget("currencyToStat");
        Cache::forget("originatingCountryStat");

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    public function dashboard(Request $request) {
        $cacheMinutes = 60;

        $messages = Cache::remember("messages",$cacheMinutes,function() {
            return (new Message)->get();
        });

        $statistics = [
            "currencyFrom" => Cache::remember("currencyFromStat",$cacheMinutes,function() {
                                return Message::select(DB::raw("currency_from AS currency"), DB::raw("COUNT(id) AS count"))
                                    ->groupBy("currency_from")
                                    ->orderBy("currency_from", "asc")
                                    ->get();
                            }),
            "currencyTo" => Cache::remember("currencyToStat",$cacheMinutes,function() {
                                return Message::select(DB::raw("currency_to AS currency"), DB::raw("COUNT(id) AS count"))
                                    ->groupBy("currency_to")
                                    ->orderBy("currency_to", "asc")
                                    ->get();
                            }),
            "originatingCountry" => Cache::remember("originatingCountryStat",$cacheMinutes,function() {
                                return Message::select(DB::raw("originating_country AS country"), DB::raw("COUNT(id) AS count"))
                                    ->groupBy("originating_country")
                                    ->orderBy("originating_country", "asc")
                                    ->get();
                            })
        ];


        return view('dashboard')
                ->with("messages",$messages)
                ->with("statistics",$statistics);
    }
}
