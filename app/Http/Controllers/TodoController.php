<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('created_at', 'desc')->paginate(8);
        return view('pages.todos.index', [
          'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation rules
        $rules = [
          'title' => 'required|string|unique:todos,title|min:2|max:191',
          'body'  => 'required|string|min:5|max:1000',
        ];
        //custom validation error messages
        $messages = [
            'title.unique' => 'Todo title should be unique', //syntax: field_name.rule
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Create a Todo
        $todo        = new Todo;
        $todo->title = $request->title;
        $todo->body  = $request->body;
        // $todo->user_id = Auth::id();
        $todo->save(); // save it to the database.
        //Redirect to a specified route with flash message.
        return redirect()->route('todo.index')->with('status','Created a new Todo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        $todo = Todo::findOrFail($todo->id);
        return view('pages.todos.show',[
            'todo' => $todo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //Find a Todo by it's ID
        $todo = Todo::findOrFail($todo->id);
        return view('pages.todos.edit',[
            'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //validation rules
        $rules = [
            'title' => "required|string|unique:todos,title,{$todo->id}|min:2|max:191", //Using double quotes
            'body'  => 'required|string|min:5|max:1000',
        ];
        //custom validation error messages
        $messages = [
            'title.unique' => 'Todo title should be unique',
        ];
        //First Validate the form data
        $request->validate($rules,$messages);
        //Update the Todo
        $todo        = Todo::findOrFail($todo->id);
        $todo->title = $request->title;
        $todo->body  = $request->body;
        $todo->save(); //Can be used for both creating and updating
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('todo.show',$todo->id)
            ->with('status','Updated the selected Todo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //Delete the Todo
        $todo = Todo::findOrFail($todo->id);
        $todo->delete();
        //Redirect to a specified route with flash message.
        return redirect()
            ->route('todo.index')
            ->with('status','Deleted the selected Todo!');
    }
}
