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
            'timeout'  => 10.0
        ]);
            $response = $client->request('GET', 'products?limit=5');

            $responseId = $client->request('GET', 'products/7');

            $produtos = json_decode( $response->getBody()->getContents() );

            $produtoAvulso = json_decode( $responseId->getBody()->getContents() );

            $total = array_sum(array_column($produtos, 'price'));

            $desconto = array_sum(array_column($produtos, 'price')) * 0.2;

            return view('produtos.index', compact('response', 'produtoAvulso','produtos', 'total', 'desconto'));
    }
}
