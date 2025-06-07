<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class NovaPoshtaController extends Controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NOVA_POSHTA_API_KEY');
    }

    public function getCities()
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/', [
            'apiKey' => $this->apiKey,
            'modelName' => 'Address',
            'calledMethod' => 'getCities',
            'methodProperties' => new \stdClass()
        ]);

        return response()->json($response['data'] ?? []);
    }

    public function getWarehouses($cityRef)
    {
        $response = Http::post('https://api.novaposhta.ua/v2.0/json/', [
            'apiKey' => $this->apiKey,
            'modelName' => 'Address',
            'calledMethod' => 'getWarehouses',
            'methodProperties' => [
                'CityRef' => $cityRef,
            ]
        ]);

        return response()->json($response['data'] ?? []);
    }
}

