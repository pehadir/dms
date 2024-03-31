<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Attechment;
use DataTables;
use Illuminate\Routing\UrlGenerator;

class EmployeesController extends Controller
{
   
    public function index(){
        $data['title']      = 'DMS-ARCHIVE';
        $data['page']       = 'DATA ARCHIVE';
        $data['subpage']    = 'Archive';
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branch'] = Branch::where('company_id',$branch->company_id)->get();
        return view('contents.employee.index',$data);
    }
    public function get_data(Request $request){
        $data = Employee::where('branch_id',$request->branch)->get();
        $data = DB::SELECT("SELECT a.id,
        a.name,a.identity_card,a.email,a.phone,
        array_agg(b.url_file) as files
         FROM employees a 
        left join attechments b 
        ON b.employee_id = a.id
        where a.branch_id = $request->branch
        GROUP BY b.employee_id,a.id,a.name,a.identity_card,a.email,a.phone");
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn ='';
                            $btn .= '<div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                            <div class="dropdown-menu dropdown-menu-right text-right" style="align:right !important;">';
                            $btn .= '<a class="dropdown-item edit-employee" href="edit-employee/'.$row->id.'" ><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                            $btn .= '<a data-id='.$row->id.' class="dropdown-item delete-employee" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                            $btn .= '</div></div>';
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    public function create(){
        $data['title']      = 'create-DATA ARCHIVE';
        $data['page']       = 'DATA ARCHIVE';
        $data['subpage']    = 'Create ARCHIVE';
        $branch = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branches'] = Branch::where('company_id',$branch->company_id)->get();
        return view('contents.employee.create',$data);
    }
    public function store(Request $request){
        $saveEmp = [
            "name"                  =>ucwords($request->name),
            "dob"                   =>$request->dob,
            "gender"                =>$request->gender,
            "identity_card"         =>$request->identity_card,
            "status"                =>$request->status,
            "branch_id"             =>$request->branch_id,
            "created_by"            => Auth::user()->id,
        ];
        $save = Employee::create($saveEmp);
        $id=DB::getPdo()->lastInsertId();
        $i = 0;
        $document =[];
        if (isset($request->attech_name)){
            foreach($request->attech_name as $nameFile){
                
            if ($request->attech[$i]) {
                    $fileName = $i.time() . $request->attech[$i]->getClientOriginalName();
                    $store = $request->attech[$i]->storeAs('public', $fileName);
                    $pathFile_application = 'public/storage/' . $fileName ?? null;
                    $i++;
                    $arsip = [
                        'employee_id' => $id,
                        'name'        => $nameFile,
                        'url_file'    => $pathFile_application,
                        'created_at'  => date('Y-m-d H:m:s'),
                        'updated_at'  => date('Y-m-d H:m:s')
                    ];
                    if (!in_array($arsip,$document)){
                        array_push($document,$arsip);
                    } 
                }
            }
        }
        Attechment::insert($document);

        if ($save){
            return redirect()->route('employee')->with('success', 'Create Data successfully.');
        }else{
            return redirect()->route('employee')->with('error', 'Something went wrong!.');
        }
        
    }
    public function edit(Request $request){
        $data['title']      = 'edit-DATA ARCHIVE';
        $data['page']       = 'DATA ARCHIVE';
        $data['subpage']    = 'Edit DATA ARCHIVE';
        $data['emp']        = Employee::where('id',$request->id)
                                ->with('branch')->first();
        $data['attech']     = Attechment::where('employee_id',$request->id)->get();
        $branch             = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branches']   = Branch::where('company_id',$branch->company_id)->get();
        return view('contents.employee.edit',$data);
    }
    public function update(Request $request){
        $uptemployee = [
            "name"                  =>ucwords($request->name),
            "dob"                   =>$request->dob,
            "gender"                =>$request->gender,
            "identity_card"         =>$request->identity_card,
            "status"                =>$request->status,
            "created_by"            => Auth::user()->id,
            "updated_at"            => date('Y-m-d H:m:s'),
        ];
        $save = Employee::where('id',$request->id)->update($uptemployee);

        $i = 0;
        $document =[];
        if (isset($request->attech_name)){
            foreach($request->attech_name as $nameFile){
                
            if ($request->attech[$i]) {
                    $fileName = $i.time() . $request->attech[$i]->getClientOriginalName();
                    $store = $request->attech[$i]->storeAs('public', $fileName);
                    $pathFile_application = 'public/storage/' . $fileName ?? null;
                    $i++;
                    $arsip = [
                        'employee_id' => $request->id,
                        'name'        => $nameFile,
                        'url_file'    => $pathFile_application,
                        'created_at'  => date('Y-m-d H:m:s'),
                        'updated_at'  => date('Y-m-d H:m:s')
                    ];
                    if (!in_array($arsip,$document)){
                        array_push($document,$arsip);
                    } 
                }
            }
        }
        Attechment::insert($document);

        if ($save){
            return redirect()->route('employee')->with('success', 'update Data successfully.');
        }else{
            return redirect()->route('employee')->with('error', 'Something went wrong!.');
        }
    }
    public function destroy(Request $request){
        $del = Employee::destroy($request->id);
        $del = Attechment::where('employee_id',$request->id)->delete();
        if($del){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success deleted!',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success deleted!',
            ];
        }
        return response()->json($res);
    }
    public function delete_file(Request $request){
        $del = Attechment::where('id',$request->id)->delete();
        if($del){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success deleted!',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Data not success deleted!',
            ];
        }
        return response()->json($res);
    }
    public function get_attechment(Request $request){
        $data['file'] = Attechment::where('employee_id',$request->employee_id)->get();
        return response()->json($data);
    }
}
