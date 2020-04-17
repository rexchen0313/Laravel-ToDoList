<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Todolist;
use App\Http\Requests\TodolistRequest;

class TodoAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todolist::orderBy('id', 'desc')->simplePaginate(12);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return Todolist::findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TodolistRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodolistRequest $request)
    {
        return response()->json(Todolist::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TodolistRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodolistRequest $request, $id)
    {
        Todolist::findOrFail($id)->update($request->all());

        return response()->json(Todolist::findOrFail($id), Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todolist::findOrFail($id)->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
