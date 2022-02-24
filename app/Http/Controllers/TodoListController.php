<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\todolist;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $todoList = todolist::all();
        $today = new DateTime();
        foreach ($todoList as $key => $value) {
            $todoListDate = new DateTime($value->end);
            if ($value->status == 'Waiting' && $todoListDate < $today) {
                $todoList = todoList::find($value->id);
                $todoList->status = 2;
                $todoList->color = '#ff0000';
                $todoList->save();
            }
        }

        if ($request->ajax()) {
            $data = todolist::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end', 'color']);
            return response()->json($data);
        }
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'todoTitle' => 'required',
            'todoDescription' => 'required',
            'todoStartDateAndTime' => 'required',
            'todoEndDateAndTime' => 'required'
        ]);
        
        $todoStartDateAndTime = new DateTime($request->todoStartDateAndTime);
        $todoEndDateAndTime = new DateTime($request->todoEndDateAndTime);
        $todoList = new todolist();
        $todoList->title = $request->todoTitle;
        $todoList->description = $request->todoDescription;
        $todoList->start = $todoStartDateAndTime;
        $todoList->end = $todoEndDateAndTime;
        $todoList->status = 'Waiting';
        $todoList->color = '#0000ff';

        $todoList->save();
        return view('index');
        
    }

    public function todoListAjax(Request $request){
        $todo = todolist::find($request->id);
        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
