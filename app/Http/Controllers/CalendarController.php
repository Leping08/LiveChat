<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Event;

class CalendarController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }
}
