<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public function getAll(string $url): array|null
    {
        $response = Http::get($url);
        return $response->successful() ? $response->json() : null;
    }
}
