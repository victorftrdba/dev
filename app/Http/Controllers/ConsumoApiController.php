<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ConsumoApiController extends Controller
{
    public function index() {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://fakestoreapi.com/',
            // You can set any number of default request options.
            'timeout'  => 2.0
        ]);
            $response = $client->request('GET', 'products?limit=5');

            $produtos = json_decode( $response->getBody()->getContents() );

            return view('produtos.index', compact('produtos'));
    }
}
