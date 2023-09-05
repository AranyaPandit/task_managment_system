<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       
        $status = request()->input('status', 'all');
    
        $tasksQuery = Auth::user()->tasks();
    
        if ($status !== 'all') {
            $tasksQuery->where('status', $status);
        }
    
        $tasks = $tasksQuery->orderBy('id', 'desc')->get();
    
        return view('index', compact('tasks'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = [
            [
                'label' => 'Todo',
                'value' => '0',
            ],
            [
                'label' => 'Pendding',
                'value' => '1',
            ],
            [
                'label' => 'Done',
                'value' => '2',
            ]
        ];
        return view('create', compact('statuses'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->url = $request->url;
        $task->status = $request->status;
        $task->user_id = Auth::id();
        $task->assign_by = Auth::user()->id;
    
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = $image->move(public_path('task_images'), $imageName);
                $imagePaths[] = 'task_images/' . $imageName; 
            }
            $task->images = implode(',', $imagePaths);
        }
    
        $task->save();
    
        return redirect()->route('user-task');
    }
    
    
 
    public function show($id)
    {
       
    }

 
    public function edit($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $statuses = [
            [
                'label' => 'Todo',
                'value' => '0',
            ],
            [
                'label' => 'Pendding',
                'value' => '1',
            ],
            [
                'label' => 'Done',
                'value' => '2',
            ]
        ];
        return view('edit', compact('statuses', 'task'));
    }

    public function update(Request $request, $id)
{
    $task = Auth::user()->tasks()->findOrFail($id);

    $request->validate([
        'title' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        
    ]);


    $task->title = $request->title;
    $task->description = $request->description;
    $task->status = $request->status;
    $task->start_date = $request->start_date;
    $task->end_date = $request->end_date;
     $task->url = $request->url;

    $task->save();

    return redirect()->route('user-task');
}


    // public function destroy($id)
    // {
    //     $task = Auth::user()->tasks()->findOrFail($id);
    //     $task->delete();
    //     return redirect()->route('user-task');
    // }

  
public function showDetails($id)
{
    $task = Auth::user()->tasks()->findOrFail($id);
    return view('task_details', compact('task'));
}

}
