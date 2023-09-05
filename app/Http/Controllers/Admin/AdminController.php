<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
   
        public function index()
        {


            //show user
            $userCount = DB::table('users')->count(); 
            //Show today task
            $date = date('Y-m-d');
            $todaycount = DB::table('tasks')
            ->whereDate('created_at', '=', $date)
            ->count();

            //Show pendding tasks
            $penddingtask = Task::whereIn('status', ['1', '0'])->count();

            //Show Done tasks
            $donetask = Task::where('status', 2)->count();
                 
   


    
            return view('admin.admindashboard',['userCount' => $userCount,'todaycount'=>$todaycount,'penddingtask'=>$penddingtask,'donetask'=>$donetask]);
        }

        public function all_user(){
            $users = DB::table('users')->get(); 
            // ->where('role', '!=', 1)
             return view('admin.user_detail', ['users' => $users]);
        
        }

        public function user_edit($id){
        
            $user = DB::table('users')->where('id', $id)->first();
        
            return view('admin.user_edit', ['user' => $user]);
        }

        
        public function user_update(Request $request, $id)
        {
            $user = User::find($id);
         
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'required|digits:10',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'role'  =>'required'
            ]);
    
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('user_image'), $imageName);
                $user->image = 'user_image/' . $imageName;
            }
    
            $user->save();
    
            return redirect()->route('users')->with('success', 'User profile updated successfully');
        }
    }