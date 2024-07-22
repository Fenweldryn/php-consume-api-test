<?php

namespace App\Helpers;

class EventHelper
{
    public static function formatDateTime(array $events, $format = 'm/d/Y H:i:s')
    {
        foreach ($events as $event) {
            $event->startDate = date($format, strtotime($event->startDate));
            $event->endDate = date($format, strtotime($event->endDate));
        }

        return $events;
    }
}