<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Jobs\ProcessExportUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        $data['users']=User::select('users.*','roles.name as role')
        ->leftJoin('roles','roles.id','users.role_id')
        ->paginate(20);

        return view('users.index',$data);
    }

    public function detail()
    {
        $id=Auth::id();
        $data['user']=User::find($id);
        // dd($data);
        return view('users.detail',$data);
    }


    public function show($id)
    {
        $data['user']=User::find($id);
        return view('users.show',$data);
    }

    public function cari(Request $request)
    {
        $data['users']=User::where('name','LIKE','%'.$request->q.'%')->paginate(20);
        return view('users.index',$data);
    }

    public function create()
    {
        if (Auth::user()->role_id==1) {
            return abort(404);

        }

        return view('users.add');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id==1) {
            return abort(404);

        }
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "birth" => "required",
            "gender" => "required",
            "address" => "required",
            "role" => "required",
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->birth=$request->birth;
        $user->gender=$request->gender;
        $user->address=$request->address;
        $user->role_id=$request->role;
        $user->save();
        return redirect()->route('users.index')->with('success','Success Adding New User!');

        
    }

    public function edit($id)
    {
        $data['user']=User::find($id);
        return view('users.edit',$data);
    }

    public function update($id,Request $request)
    {
        if (Auth::user()->role_id==1 && Auth::id()!=$id) {
            return abort(404);
        }

        $request->validate([
            "name" => "required",
            "email" => "required",
            "birth" => "required",
            "gender" => "required",
            "address" => "required",
        ]);
        $user=new User();
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->birth=$request->birth;
        $user->gender=$request->gender;
        $user->address=$request->address;
        if (Auth::user()->role_id!=1) {
            $user->role_id=$request->role;
        }
        $user->save();
        return redirect()->back()->with('success','Success Updating User!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role_id==1) {
            return abort(404);
        }

        $user=User::find($id);
        $user->delete();
    }

    public function export() 
    {

        
        (new UsersExport)->queue('users' . date('Y-m-d H_i') . '.xlsx');
        echo back()->withSuccess('Export started!');
        
    }
}
