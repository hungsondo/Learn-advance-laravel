<?php

namespace App\Http\Controllers;

use Hungsondo\TarotReader\TarotReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function test(Request $request)
    {
        $url = Storage::disk('s3')->temporaryUrl('capsule_616x353.jpg', now()->addMinutes(5));
        
        $img = Storage::disk('s3')->get('capsule_616x353.jpg');

        // Storage::disk('s3')->put('test/lmao.jpg', $img);
        Storage::disk('s3')->copy('capsule_616x353.jpg', '69/abc.jpg');
        echo 'ok';
    }
}
