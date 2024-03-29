<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Branch;
class DashboardController extends Controller
{
    public function index(){
        $data['page']           = 'Dashboard';
        $data['title']          = 'DMS';
        $data['subpage']        = '';
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        $data['dataIn']         = Employee::whereRaw(DB::raw("to_char(created_at,'YYYY-MM') = to_char(now(),'YYYY-MM')"))->count();
        $data['dataActive']     = Employee::where('status','active')->count();
        $data['dataNonactive']  = Employee::where('status','nonactive')->count();
        $data['dataTotal']      = Employee::count(); 
        return view('dashboard.index',$data);
    }
    public function search(Request $request){
        $data['page']           = 'Dashboard';
        $data['title']          = 'dashboard';
        $data['subpage']        = '';
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        if ($request->branch_id == 'all'){
            $data['dataIn']         = Employee::whereRaw(DB::raw("to_char(created_at,'YYYY-MM') = to_char(now(),'YYYY-MM')"))->count();
            $data['dataActive']     = Employee::where('status','active')->count();
            $data['dataNonactive']  = Employee::where('status','nonactive')->count();
            $data['dataTotal']      = Employee::count(); 
            return view('dashboard.index',$data);
        }
        $data['dataIn']         = Employee::whereRaw(DB::raw("to_char(created_at,'YYYY-MM') = to_char(now(),'YYYY-MM')"))->where('branch_id',$request->branch_id)->count();
        $data['dataActive']     = Employee::where('status','active')->where('branch_id',$request->branch_id)->count();
        $data['dataNonactive']  = Employee::where('status','nonactive')->where('branch_id',$request->branch_id)->count();
        $data['dataTotal']      = Employee::where('branch_id',$request->branch_id)->count(); 
        return view('dashboard.index',$data);
    }
}
