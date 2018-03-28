<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Event;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return Event::whereDate('date', '>', Carbon::now())->get();
    }
}
