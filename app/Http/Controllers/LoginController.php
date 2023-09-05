<?php
namespace App\Http\Controllers;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{

    //
    public function index()
    {
        return view('login');
    }



    //
    public function registerForm()
    {
        return view('register');
    }


///
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

      
        Auth::login($user);

        return redirect()->route('user-task')->with('success', 'Registration successful. Welcome to our platform!');
    }


//
public function login(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        
        if (Auth::user()->role == 1) {
   
            return redirect()->route('admindashbord');
        } else {
        
            return redirect()->route('user-task');
        }
    }
    return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
}



//
    
    public function logout()
    {
        Auth::logout();
        return view('welcome');
    }

//

    public function profile()
{
    return view('profile');
}


//
public function editProfile()
{
    return view('profile_edit');
}


//

public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'required|digits:10', 
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;                         
    
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('user_image'), $imageName);
        $user->image = 'user_image/' . $imageName;
    }

    $user->save();

    return redirect()->route('profile')->with('success', 'Profile updated successfully.');
}



}
