<?php

namespace App\Controllers;

use App\Services\EventsService;
use App\Helpers\RequestHelper;
use App\Validator\Event\CreateRequestValidator;
use App\Validator\Event\ShowRequestValidator;

class EventController
{
    public function index()
    {
        $params = RequestHelper::sanitize($_GET);
        try {
            echo (new EventsService)->all($params);
        } catch (\Throwable $th) {
            echo json_encode(['error' => 'An error occurred']);
        }
    }

    public function show($id)
    {
        $payload = RequestHelper::sanitize(['id' => $id]);
        ShowRequestValidator::validate($payload);

        echo (new EventsService)->find($payload['id']);
    }

    public function create()
    {
        $payload = RequestHelper::getPayload();
        CreateRequestValidator::validate($payload, ['title', 'description', 'startDate', 'endDate']);

        http_response_code(201);
        echo (new EventsService)->create($payload);
    }
}