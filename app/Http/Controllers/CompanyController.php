<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Branch;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CompanyController extends Controller
{
     public function index(){
        $data['title']      = 'DMS-COMPANY';
        $data['page']       = 'COMPANY';
        $data['subpage']    = '';
        return view('contents.company.index',$data);
    }
    public function get_data(Request $request){
        try {
            $data = Company::all();
             return DataTables::of($data)
                            ->addColumn('action', function ($d) {
                        $view = '';
                        if(Auth()->user()->type == 'company'){
                            $view = '<td class="text-end" >
                                            <div class="dropdown dropdown-action" >
                                                <a href ="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons"> more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">';
                            /** edit */
                            $view .= '<a href="#" data-id = "'.$d->id.'" class="dropdown-item edit-company"><i class="fa fa-pencil m-r-5" ></i> Edit</a>';
                            /** delete */
                            $view .= '<a data-id="'.$d->id.'" class="dropdown-item delete-company" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                            /** delete */
                            $view .= '</div></div></td>';
                        }
                    return $view;
                })
               ->rawColumns(['action'])
                        ->make(true);
        }catch (Throwable $e) {
            /** error response */
            $response = response()->json([
                'draw'            => 0,
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'data'            => [],
                'error'           => $e->getMessage(),
            ]);
        }
        return $response;
    }
    public function store(Request $request){
        // try {
        // DB::beginTransaction();
            $data =[
                'name'      => $request->company_name,
                'addrees'   => $request->address,
                'is_active' => '1',
            ];
            
            $save = Company::create($data)->id;
            $branch = [
                'name'       => $request->company_name,
                'alias'      => $request->company_name,
                'created_by' => Auth::user()->id,
                'company_id' => $save,
            ];
            // Branch::insert($branch);
        //     DB::commit();
        //      $res = [
        //         'status' => 'success',
        //         'msg'    => 'Data success saved !',
        //     ];
        //     return response()->json($res);
        // }catch (Exception $e) {
        //         DB::rollBack();
        //          $res = [
        //         'status' => 'error',
        //         'msg'    => 'Something went wrong! try again.',
        //     ];
        //     return response()->json($res);
        // }
        
    }
    public function edit(Request $request){
        $data = Company::find($request->id);
        return response()->json($data);
    }
    public function update(Request $request){
        if ($request->file('logo')) {
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $store = $request->file('logo')->storeAs('logo/', $fileName);
            $pathFile = 'logo/' . $fileName ?? null;
        }else{
            $pathFile ='';
        }
        $data =[
            'name'      => $request->company_name,
            'addrees'   => $request->address,
            'logo'      => $pathFile,
            'is_active' => $request->status,
        ];
        $save = Company::where('id',$request->id)->update($data);
         if ($save){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success updated !',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Something went wrong !, try again.',
            ];
        }
        return response()->json($res);
    }
    public function destroy(Request $request){
        $destr = Company::destroy($request->id);
         if ($destr){
            $res = [
                'status' => 'success',
                'msg'    => 'Data success deleted !',
            ];
        }else{
            $res = [
                'status' => 'success',
                'msg'    => 'Something went wrong !, try again.',
            ];
        }
        return response()->json($res);
    }
}
