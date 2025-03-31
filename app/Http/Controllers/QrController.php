<?php

namespace App\Http\Controllers;

use HungSonDo\QRCodeGenerator\QRCodeGenerator;
use Illuminate\Http\Request;

class QrController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $qr = new QRCodeGenerator();

        return response()->json($qr->generate($request->get('text')));
    }
}
