<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $tasks=Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(view:'tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreTaskRequest $request){
    //     $this->authorize('update', $request->conversation);
    //     $this->conversation->bestreply($request);
    
    //     Task::create($request->validate());
    //     return redirect()->route('tasks.index');
    // }

    public function store(StoreTaskRequest $request)
    {
        $student = new Task();
        $student->description = $request->input('description');
        $student->save();
        return redirect()->route('tasks.index');
        // return redirect()->back()->with('status','Student Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
    return view('tasks.show',  compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Task $task)
    {  
          abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, "You don't have permission for access this page!! Sorry!");
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)

    {
    
        $row=Task::find($task->id);
        $row->description=$request->description;
        // $row->update($request->validate());
        $row->save();
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    { 
         abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, "You don't have permission for access this page!! Sorry!");
         $task->delete();
         return redirect()->route('tasks.index');
    }
}
