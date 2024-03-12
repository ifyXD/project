<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\RequestUser;
use Illuminate\Http\Request;

class RequestUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestUser $requestUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestUser $requestUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestUser $requestUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestUser $requestUser)
    {
        //
    }
}
