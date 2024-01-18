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
                "message" => "Tasks found.",
                "data" => $tasks
            ], 201);
    }

    
    public function show($id){
        try{
            $task = Task::find($id);
            if($task){
                return response()->json([
                    "id" => $task->id,
                    "task" => $task->name,
                    "completed" => $task->is_done,
                ], 201);
            }
        }
        catch(Exception $e){
            return response()->json([
                "message" => "Task not found",
            ], 404);
        }
    }
    // CreateTaskRequest
    public function store(CreateTaskRequest $request){
        try{
            $task = new Task();
            $task->name = $request->name;
            $task->is_done = $request->is_done;
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

    public function update($id, CreateTaskRequest $request){
        try{
            // dd->request(all);   //for debugging
            $task = Task::find($id);    //will find the task in the table by id
            if($task == null){
                return response()->json([
                    "message" => "Task does not exist."
                ], 404);
            }
            
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

    public function updateStatus(Task $task, Request $request){
        try{
            $task->is_done = !$task->is_done;
            $task->save();
            return response()->json([
                "message" => "Task updated successfully."
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                "message" => "Task was not updated."
            ], 401);
        }
    }
}
