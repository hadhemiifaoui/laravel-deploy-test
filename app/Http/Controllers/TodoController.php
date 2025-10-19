<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderBy('created_at','desc')->get();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|max:255']);

        $todo = Todo::create(['title' => $request->title]);

        return response()->json([
            'success' => true,
            'todo' => $todo
        ]);
    }   
}
