<?php

namespace App\Helpers;

class TimeZoneHelper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function options()
    {
        $options = [];
        foreach (timezone_identifiers_list() as $timezone) {
            $options[$timezone] = $timezone;
        }

        return $options;
    }
}
