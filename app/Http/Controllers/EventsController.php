<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEventRequest;
use Carbon\Carbon;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::latest()->first();

        $dates = CarbonPeriod::create($event->from, $event->to);

        $dates = collect($dates->toArray())->filter(function($date) use($event){

            $day = strtolower(Carbon::parse($date)->format('l'));

            return in_array($day, $event->days);

        })->map(function($date) use($event) {
            return $date->format('Y-m-d');
        })->values();

        return response()->json([
            'dates' => $dates,
            'title' => $event->name,
            'class' => 'bg-blue-500 text-white mx-2'
        ], 200);
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request)
    {
        
        $event = Event::create(
            $request->validated()
        );


        return response()->json([
            'event' => $event
        ], 201);
    }

}
