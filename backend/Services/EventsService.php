<?php

namespace App\Services;

use App\Helpers\EventHelper;
use App\Helpers\HttpHelper;

class EventsService
{
    private const BASE_URL = "https://interview.civicplus.com/e5990d6e-097e-4d19-8d68-c74e20a1caf4/api/";
    private const EVENTS_PATH = "Events";
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
        $filter = null;
        if (!empty($params['filter'])) {
            $filter = "title%20eq%20'".$params['filter']."'";
        }
        $orderBy = $params['orderBy'] ?? null;

        $response = $this->http->get(
            self::EVENTS_PATH .
            '?$top=' . $top .
            '&$skip=' . $skip .
            ($filter ? '&$filter=' . $filter : '') .
            ($orderBy ? '&$orderBy=' . $orderBy : '')
        );
        $response = json_decode($response);
        $formattedItems = EventHelper::formatDateTime($response->items);
        $response->items = $formattedItems;

        return json_encode($response);
    }

    public function find($id)
    {
        $event = $this->http->get(self::EVENTS_PATH . '/' . $id);
        $event = EventHelper::formatDateTime([json_decode($event)]);

        return json_encode(current($event));
    }

    public function create($data)
    {
        return $this->http->post(self::EVENTS_PATH, $data);
    }
}