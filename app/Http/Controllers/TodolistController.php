<?php

namespace App\Http\Controllers;

class TodolistController extends Controller
{
    public function index()
    {
        return view('list');
    }

    public function store()
    {
        return view('add');
    }

    public function show($id)
    {
        return view('task', ['id' => $id]);
    }

    public function update($id)
    {
        return view('modify', ['id' => $id]);
    }
}
