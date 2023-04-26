<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Http\Requests\UpdateTicketResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Mail\NewResponseMail;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResponseResource::collection(Response::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResponseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResponseRequest $request, Ticket $ticket)
    {
        Response::create($request->validated());
        $user = Auth::user();

        //Get the correct users to mail.
        $ticket_user = User::find($ticket->user_id)->email;
        $assigned_user = User::find($ticket->assigned_to)->email;

        Mail::to([$ticket_user, $assigned_user])->send(new NewResponseMail($user));

        return new ResponseResource($ticket->load('responses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResponseRequest  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResponseRequest $request, Ticket $ticket){
        $validatedResponse = $request->validated();
        Response::find($validatedResponse['id'])->update(['content' =>$validatedResponse['content']]);

        return new ResponseResource($ticket->load('responses'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
