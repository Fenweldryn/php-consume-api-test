<?php

namespace App\Services;

use App\Helpers\HttpHelper;

class EventsService
{
    private const BASE_URL = "https://interview.civicplus.com/e5990d6e-097e-4d19-8d68-c74e20a1caf4/api/";
    private const EVENTS_PATH = "Events/";
    private const AUTH_PATH = "Auth";
    private $http;

    public function __construct()
    {
        try {
            $this->http = new HttpHelper(self::BASE_URL, self::AUTH_PATH, getenv('CLIENT_ID'), getenv('CLIENT_SECRET'));

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function all(array $params)
    {
        $top = $params['top'] ?? 10;
        $skip = $params['skip'] ?? 0;
        $filter = $params['filter'] ?? null;
        $orderBy = $params['orderBy'] ?? null;

        return $this->http->get(
            self::EVENTS_PATH .
            '?$top=' . $top .
            '&$skip=' . $skip .
            ($filter ? '&$filter=' . $filter : '') .
            ($orderBy ? '&$orderBy=' . $orderBy : '')
        );
    }

    public function find($id)
    {
        return $this->http->get(self::EVENTS_PATH . $id);
    }

    public function create($data)
    {
        return $this->http->post(self::EVENTS_PATH, $data);
    }
}