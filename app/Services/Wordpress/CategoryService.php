<?php

namespace App\Services\Wordpress;

use App\Services\ApiService;

class CategoryService
{
    protected const string URL = '/categories';

    public function __construct(protected ApiService $apiService) { }

    public function getAll(): array|null
    {
        $apiUrl = config('app.requireDevApiUrl');
        return $this->apiService->getAll($apiUrl . self::URL);
    }
}
