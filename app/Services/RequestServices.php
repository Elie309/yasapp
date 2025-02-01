<?php

namespace App\Services;


class RequestServices extends BaseServices
{

    public static $RequestStatuses = [
        'pending', 
        'on-track',  
        'on-hold', 
        'finishing', 
        'rejected', 
        'cancelled'
    ];

    public static $RequestPriorities = [
        'low', 
        'medium', 
        'high', 
    ];
    
}
