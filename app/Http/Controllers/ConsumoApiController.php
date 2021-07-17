<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ConsumoApiController extends Controller
{
    public function index() {
        $client = new Client([
            'base_uri' => 'https://fakestoreapi.com/',
            'timeout'  => 10.0
        ]);
            $response = $client->request('GET', 'products?limit=5');

            $responseId = $client->request('GET', 'products/7');

            $products = json_decode( $response->getBody()->getContents() );

            $singleProduct = json_decode( $responseId->getBody()->getContents() );

            $total = array_sum(array_column($products, 'price'));

            $discount = array_sum(array_column($products, 'price')) * 0.2;

            return view('produtos.index', compact('response', 'singleProduct','products', 'total', 'discount'));
    }
}
