<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Branch;
use App\Charts\Gander;
class DashboardController extends Controller
{
    public function index(Gander $chart){
        $data['page']           = 'Dashboard';
        $data['title']          = 'DMS';
        $data['subpage']        = '';
        $branch                 = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch']         = Branch::where('company_id',$branch->company_id)->get();
        $data['dataIn']         = Employee::whereRaw(DB::raw("to_char(employees.created_at,'YYYY-MM') = to_char(now(),'YYYY-MM')"))
                                    // ->where('branch_id',Auth::user()->branch_id)
                                    ->leftJoin('branches','branches.id','employees.branch_id')
                                    ->where('branches.company_id',$branch->company_id)
                                    ->count();
        $data['archiveTotal']   = DB::table('attechments')
                                    ->leftJoin('employees','employees.id','attechments.employee_id')
                                    // ->where('employees.branch_id',Auth::user()->branch_id)
                                    ->leftJoin('branches','branches.id','employees.branch_id')
                                    ->where('branches.company_id',$branch->company_id)
                                    ->count();
        $data['dataTotal']      = Employee::leftJoin('branches','branches.id','employees.branch_id')
                                    ->where('branches.company_id',$branch->company_id)
                                    // ->where('branch_id',Auth::user()->branch_id)
                                    ->count(); 
        $data['pie'] = $chart->pie();
        $data['bar'] = $chart->bar();
        return view('dashboard.index',$data);
    }
    public function search(Gander $chart,Request $request){
        $data['page']           = 'Dashboard';
        $data['title']          = 'dashboard';
        $data['subpage']        = '';
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        if ($request->branch_id == 'all'){
            $data['dataIn']         = Employee::whereRaw(DB::raw("to_char(employees.created_at,'YYYY-MM') = to_char(now(),'YYYY-MM')"))
                                        ->leftJoin('branches','branches.id','employees.branch_id')
                                        ->where('branches.company_id',$branch->company_id)
                                        ->count();
            $data['archiveTotal']   = DB::table('attechments')
                                        ->leftJoin('employees','employees.id','attechments.employee_id')
                                        // ->where('employees.branch_id',Auth::user()->branch_id)
                                        ->leftJoin('branches','branches.id','employees.branch_id')
                                        ->where('branches.company_id',$branch->company_id)
                                        ->count();
            $data['dataTotal']      = Employee::leftJoin('branches','branches.id','employees.branch_id')
                                        ->where('branches.company_id',$branch->company_id)
                                        ->count(); 
            $data['pie'] = $chart->pie();
            $data['bar'] = $chart->bar();
            return view('dashboard.index',$data);
        }
        $data['dataIn']         = Employee::whereRaw(DB::raw("to_char(created_at,'YYYY-MM') = to_char(now(),'YYYY-MM')"))->where('branch_id',$request->branch_id)->count();
        $data['archiveTotal']   = DB::table('attechments')
                                        ->leftJoin('employees','employees.id','attechments.employee_id')
                                        ->where('employees.branch_id',$request->branch_id)
                                        ->count();
        $data['dataTotal']      = Employee::where('branch_id',$request->branch_id)->count(); 
        $data['pie'] = $chart->pie();
        $data['bar'] = $chart->bar();
        $data['branchId'] = $branch->id;
        return view('dashboard.index',$data);
    }
}
