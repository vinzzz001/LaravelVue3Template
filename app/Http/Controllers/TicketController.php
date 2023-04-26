<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketAssignedToRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Requests\UpdateTicketResponseRequest;
use App\Http\Requests\UpdateTicketStatusRequest;
use App\Http\Resources\TicketResource;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TicketResource::collection(Ticket::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();
        $ticket = Ticket::Create($validated);

        $ticket->user_id = auth()->id();
        $ticket->push();

        return new TicketResource($ticket);
    }

    /**
     * Display the specified ticket with responses.
     *
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $ticket = $ticket->load('responses');
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest $request
     * @param  \App\Models\Ticket                     $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();
        $ticket->update($validated);

        return new TicketResource($ticket->load('responses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketStatusRequest $request
     * @param  \App\Models\Ticket                           $ticket
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(UpdateTicketStatusRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();
        $ticket->update($validated);

        return new TicketResource($ticket->load(['responses', 'notes']));
    }


        /**
         * Update the specified resource in storage.
         *
         * @param  \App\Http\Requests\UpdateTicketStatusRequest $request
         * @param  \App\Models\Ticket                           $ticket
         * @return \Illuminate\Http\Response
         */
    public function updateAssignedTo(UpdateTicketAssignedToRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();
        $ticket->update($validated);

        // todo: Return the data with resources. All the data!
        return new TicketResource($ticket->load('responses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //Destroy all attached responses too?
    }



}
