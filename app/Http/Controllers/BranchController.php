<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DataTables;
class BranchController extends Controller
{
   
    public function index()
    {
        $data['title']      = 'DMS-BRANCH';
        $data['page']       = 'BRANCH';
        $data['subpage']    = '';
        $br = Branch::where('id',Auth::user()->branch_id)->first();
        $data['branches'] = Branch::where('company_id',$br->company_id)->get();
        return view('contents.branch.index',$data);
    }
    public function get_data(Request $request){
        $br = Branch::where('id',Auth::user()->branch_id)->first();
        $data = Branch::where('company_id',$br->company_id)->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='';
                    if(auth()->user()->type == 'admin' || auth()->user()->type == 'company'){
                    $btn = '
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu">
                                    <a  data-id="'.$row->id.'" class="dropdown-item edit-branch" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-id="'.$row->id.'" class="dropdown-item delete-branch" href="#" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    }
                            return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
    }
    
    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->messages());
            }
            $branchId           = Auth::user()->branch_id;
            $comId              = Branch::where('id',$branchId)->first();
            $code               = $comId->company_id.$request->alias;
            if($comId->alias == $code){
                return redirect()->route('branches.index')->with('info', 'Branch  already !.');
            }
            $branch             = new Branch();
            $branch->name       = $request->name;
            $branch->alias      = $comId->company_id.$request->alias;
            $branch->company_id = $comId->company_id;
            $branch->created_by = Auth::user()->id;
            $branch->save();
            $res = [
                'status' => 'success',
                'msg'    => 'Create data successfully.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
        }
    }
    public function edit(Request $request)
    {
        $branch = Branch::where('id',$request->id)->first();
        return response()->json($branch);
    }
  

    public function update(Request $request)
    {
        try{
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with([
                    'errors'    => $validator->messages(),
                    'edit-show' => true,
                ]);
            }
            
            $data = [
                'name'  => $request->name,
                'alias' => $request->company_id.$request->alias
            ];
            Branch::where('id',$request->id)->update($data);
            
            $res = [
                'status' => 'success',
                'msg'    => 'Update data successfully.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Someting went wrong !'
            ];
            return response()->json($res);
        }
    }
    public function destroy(Request $request)
    {
        try{
            Branch::where('id',$request->id)->delete();
            $res = [
                'status' => 'success',
                'msg'    => 'Branch successfully deleted.'
            ];
            return response()->json($res);
        }catch(Exeption $e){
            $res = [
                'status' => 'error',
                'msg'    => 'Something when wrong!'
            ];
            return response()->json($res);
        }
    }
}
