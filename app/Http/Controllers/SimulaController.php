<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SimulaController extends Controller
{
    public function simula(Request $request) {
        $client = new Client([
            'base_uri' => 'https://viacep.com.br/ws/'.$request->input('cep'),
            'timeout'  => 10.0
        ]);

        $cep = $request->input('cep');

        $request = $client->request('GET', $request->input('cep').'/json');
        $response = json_decode($request->getBody()->getContents());

        return view('simulafrete.resultado', compact('response'));

    }
}
