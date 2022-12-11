<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        $response = ['status' => true, 'message' => '', 'data' => ['todos' => $todos]];
        return response($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'description'            => 'required',
        ],
            [
                'title.required' => 'The title of the ToDo task is required',
                'description.required' => 'The description of the ToDo task is required',
            ]

        );

        if ($validator->fails()) {
            return response([ 'status' => false,'message' => 'There were some problems with your input',
                'data' => $validator->errors()]);
        }

        $todo = Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'due_date_time' => $request->input('due_date_time'),
        ]);

        $todo->save();

        $response = [ 'status' => true, 'message' => 'Todo created successfully.','data'=>''];
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        $response = [ 'status' => true, 'message' => 'Todo task found.','data'=> ['todo' => $todo]];
        return response($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'description'            => 'required',
        ],
            [
                'title.required' => 'The title of the ToDo task is required',
                'description.required' => 'The description of the ToDo task is required',
            ]

        );

        if ($validator->fails()) {
            return response([ 'status' => false,'message' => 'There were some problems with your input',
                'data' => $validator->errors()]);
        }

        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->status = $request->input('status');
        $todo->due_date_time = $request->input('due_date_time');
        $todo->save();

        $response = [ 'status' => true, 'message' => 'Todo updated successfully.','data'=>''];
        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        $response = [ 'status' => true, 'message' => 'Todo deleted successfully.','data'=>''];
        return response($response, 200);
    }
}
