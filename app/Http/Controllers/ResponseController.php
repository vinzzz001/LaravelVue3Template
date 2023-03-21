<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Http\Requests\StoreResponseRequest;
use App\Http\Requests\UpdateResponseRequest;
use App\Http\Requests\UpdateTicketResponseRequest;
use App\Mail\NewResponseMail;
use App\Models\Ticket;
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
        return Response::all();
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

        Mail::to('vinzzz001@gmail.com')->send(new NewResponseMail($user));

        return $ticket->load('responses');
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

        return $ticket->load('responses');
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
