<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\CreateTaskRequest;

class TaskController extends Controller{
    public function index(){
        $tasks = Task::all();
        if($tasks->isEmpty())
            return response()->json([
                "data" => "No tasks found."
            ], 404);
        else
            return response()->json([
                "data" => TaskResource::collection($tasks)
            ], 201);
    }
    // CreateTaskRequest
    public function store(CreateTaskRequest $request){
        try{
            $task = new Task();
            $task->name = $request->name;
            $task->save();

            return response()->json([
                "data" => $task,
                "message" => "The task was created successfully."
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                "message" => "The task was not created."
            ], 500);
        }
    }

    public function update(CreateTaskRequest $request, Task $task){
        try{
            $task->name = $request->name;
            $task->save();

            return response()->json([
                "message" => "Task updated successfully."
            ], 201);
        }
        catch(Exception $e){            
            return response()->json([
                "message" => "Task could not be updated."
            ], 404);
        }
    }

    public function destroy(Task $task){
        try{
            $task->delete();
            return response()->json([
                "message" => "Task deleted successfully."
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                "message" => "Task was not deleted."
            ], 404);
        }
    }
}
