<?php

namespace App\Http\Controllers;

use Hungsondo\TarotReader\TarotReader;
use Illuminate\Http\Request;

class TarotController extends Controller
{
    public function pickCards()
    {
        $reader = new TarotReader();
        $cards = $reader->pickCards();

        return response()->json($cards);
    }

    public function getResult(Request $request)
    {
        $reader = new TarotReader();
        $result = $reader->getResult(data_get($request->all(), 'cards'));

        return response()->json($result);
    }
}
