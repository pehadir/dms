<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\models\User;
use DataTables;

class UserController extends Controller
{
    public function index(){
        $data['title']      = 'User Management';
        $data['page']       = 'USER MANAGEMENT';
        $data['subpage']    = 'data user';
        return view('contents.user.index',$data);
    }
    public function get_user(){
        $data = User::where('branch_id',Auth::user()->branch_id)->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                        <a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-primary btn-sm edit-user"><span class="fa fa-edit"></span></a>
                        <a href="javascript:void(0);" data-id="'.$row->id.'" class="btn btn-danger btn-sm delete-user"><span class="fa fa-trash"></span></a>
                    ';
                               
                            return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function store(Request $request){
        $cekUser = User::where('email',$request->email)->count();
        if($cekUser > 0 ){
            $res = [
                'status' => 'info',
                'msg'    => 'Email is already, please choose email other.'
            ];
            return response()->json($res);
        }
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'branch_id'=> Auth::user()->branch_id,
        ];
        $insert = User::create($data);
        if ($insert){
            $res = [
                'status' => 'success',
                'msg'    => 'Create data successfully.'
            ];
            return response()->json($res);
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
        }
        
    }
    public function edit(Request $request){
        $data = User::find($request->id);
        return response()->json($data);
    }
    public function update(Request $request){
        $cekUser = User::where('email',$request->email)->where('id','<>',$request->id)->count();
        if($cekUser > 0 ){
            $res = [
                'status' => 'info',
                'msg'    => 'Email is already, please choose email other.'
            ];
            return response()->json($res);
        }
        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            // 'password' => Hash::make($password),
            // 'branch_id'=> Auth::user()->branch_id,
        ];
        $insert = User::where('id',$request->id)->update($data);
        if ($insert){
            $res = [
                'status' => 'success',
                'msg'    => 'Update data successfully.'
            ];
            return response()->json($res);
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
        }
    }

    public function change_pass(){
        $data['title']      = 'User Management';
        $data['page']       = 'Cange Password';
        $data['subpage']    = 'data user';
        $data['user'] = User::where('id',Auth::user()->id)->first();
        return view('contents.user.change_password',$data);
    }
    public function change_password_new(Request $request){
        $user = User::find(Auth::user()->id);
        $hasher = app('hash');
        if ($hasher->check($request->pass_old, $user->password)) {
            $passNew = Hash::make($request->pass_new);
            $update = User::where('id',Auth::user()->id)->update(['password' => $passNew]);
            if ($update){
                $res = [
                    'status' => 'success',
                    'msg'    => 'Change Password Successfuly !'
                ];
            }else{
                $res = [
                    'status' => 'error',
                    'msg'    => 'Sameting went wrong !'
                ];
            }
            return response()->json($res);
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'your password old wrong !'
            ];
            return response()->json($res);
        }
    }
   
    public function destroy(Request $request){
        $des = User::destroy($request->id);
        if ($des){
            $res = [
                'status' => 'success',
                'msg'    => 'Delete data successfully.'
            ];
            return response()->json($res);
        }else{
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
        }
    }
}
