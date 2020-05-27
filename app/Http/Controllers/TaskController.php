<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Repositories\TaskRepository;
use App\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * Repository that holds all tasks
     * 
     * @var \App\Repositories\TaskRepository
     */
    protected $repository;

    /**
     * Create an instance
     */
    public function __construct(TaskRepository $repository)
    {
        $this->middleware('auth');
        $this->middleware('can:delete,task')->only('destroy');

        $this->repository = $repository;
    }

    /**
     * Display all tasks
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->repository->forUser($request->user()),
        ]);
    }

    /**
     * Save new task
     * 
     * @param \App\Http\Requests\CreateTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    /**
     * Delete an existing task
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        try {
            $result = $task->delete();
        } catch (Exception $exeption) {
            return redirect('/tasks')
                ->withErrors([
                    'message' => $exeption->getMessage(),
                ]);
        }

        return redirect('/tasks');
    }
}
