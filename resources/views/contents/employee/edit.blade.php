@extends('template.main')
@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('error')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    <!-- /Page Header -->
    <form action="{{route('update-employee')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card emp_details">
                    <div class="card-header p-3"><h4 class="mb-0">Personal Detail</h4></div>
                    <div class="card-body employee-detail-edit-body fulls-card">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Name</label><span class="text-danger pl-1">*</span>
                                <input name="id" type="hidden" value="{{$emp->id}}" required>
                                <input class="form-control" name="name" type="text" id="name" value="{{$emp->name}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label><span class="text-danger pl-1">*</span>
                                <input class="form-control" name="dob" type="date" id="dob" value="{{$emp->dob}}" required>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="gender" class="form-label">Gender</label><span class="text-danger pl-1">*</span>
                                <div class="d-flex radio-check mt-2">
                                    <select class="form-control form-select" name="gender" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="MALE" {{($emp->gender=='MALE') ? 'selected' : ''}}>MALE</option>
                                        <option value="FEMALE" {{($emp->gender=='FEMALE') ? 'selected' : ''}}>FEMALE</option>
                                    </select>

                                </div>
                            </div>
                          
                            <div class="form-group col-md-6">
                                <label for="identity_card" class="form-label">Identity Number</label>
                                <input class="form-control" value="{{$emp->identity_card}}" name="identity_card" type="text" id="name">
                            </div>
                           
                            
                            <div class="form-group col-md-6">
                                <label for="marital_status" class="form-label">Status</label>
                                <select class="form-control form-select" id="status-employee-edit" name="status" required>
                                    <option value="active" {{($emp->status=='active') ? 'selected' : ''}}>Active</option>
                                    <option value="nonactive" {{($emp->status=='nonactive') ? 'selected' : ''}}>Non Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="branch_id" class="form-label">Branch</label>
                                <select class="form-control select" name="branch_id" id="branch_id" required>
                                    <option value="" selected>-- Select Branch --</option>
                                    @foreach ($branches as $branch)
                                        @if ($emp->branch->id == $branch->id)
                                        <option value="{{$branch->id }}" selected>{{$branch->alias}}</option>
                                        @else
                                        <option value="{{$branch->id }}">{{$branch->alias}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card emp_details">
                    <div class="card-header p-3"><h4 class="mb-0">Attechments</h4></div>
                    <div class="card-body employee-detail-edit-body fulls-card">
                        <div class="row">
                            {{-- <div class="form-group col-md-6">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input class="form-control" value="{{$emp->no_employee}}" name="no_employee" type="text" id="employee_id">
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label class="form-label">Employee Type</label>
                                <select class="form-control form-select"  name="employee_type" id="employee_type">
                                    <option value="" disabled>Select Type</option>
                                    <option value="permanent" {{($emp->employee_type=='permanent') ? 'selected' : ''}}>Permanent</option>
                                    <option value="probation" {{($emp->employee_type=='probation') ? 'selected' : ''}}>Probation</option>
                                    <option value="contract" {{($emp->employee_type=='contract') ? 'selected' : ''}}>Contract</option>
                                    <option value="outsourcing" {{($emp->employee_type=='outsourcing') ? 'selected' : ''}}>Outsourcing</option>
                                    <option value="hl" {{($emp->employee_type=='hl') ? 'selected' : ''}}>Daily Worker</option>
                                    <option value="magang" {{($emp->employee_type=='magang') ? 'selected' : ''}}>Magang</option>
                                    <option value="freelancers" {{($emp->employee_type=='freelancers') ? 'selected' : ''}}>Freelancers</option>
                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label for="leave_type" class="form-label">Work Type</label>
                                <select class="form-control form-select"  id="work_type" name="work_type">
                                    <option value="">Select Type</option>
                                    <option value="61" {{($emp->work_type=='61') ? 'selected' : ''}}>6-1 (6 Days Work) </option>
                                    <option value="52" {{($emp->work_type=='52') ? 'selected' : ''}}>5-2 (5 Days Work) </option>
                                    <option value="42" {{($emp->work_type=='42') ? 'selected' : ''}}>4-2 (6 Days Work) </option>
                                    <option value="30" {{($emp->work_type=='30') ? 'selected' : ''}}>3-0 (Full Days Work) </option>
                                </select>
                            </div> --}}
                            
                            <hr >
                            
                            {{-- <div class="form-group col-md-6">
                                <label for="company_doj" class="form-label">Join Date</label>
                                <input class="form-control" value="{{$emp->company_doj}}" name="company_doj" type="date" id="company_doj">
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label class="form-label">Department </label>
                                <select class="form-control select" name="department" id="departs">
                                    <option value="" selected>Select Department</option>
                                    @foreach ($department as $depart)
                                        <option value="{{$depart->id }}">{{$depart->name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label class="form-label">Position </label>
                                <select class="form-control select" name="position" id="positId">
                                    <option value="" selected>Select Position</option>
                                    @foreach ($position as $post)
                                        <option value="{{$post->id }}">{{$post->position_name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                        </div>
                    </div>
                    <div class="container mb-4">
                        Attech :
                        <hr />
                        @if ($attech !=null)   
                            @foreach ($attech as $attechs)
                            <div class="form-group {{$attechs->id}}">
                                <div>
                                    <label>Name-File : {{$attechs->name}}</label>
                                </div>
                                <div>
                                    URL-File : <a href="{{asset($attechs->url_file)}}" class="mt-2" target="_blank">{{asset($attechs->url_file)}}</a>
                                </div>
                                <div>
                                    <a href="javascript:void(0);" class="fa fa-trash fa-lg text-danger remove-file" data-id = "{{$attechs->id}}"></a>
                                </div>
                            </div>
                            @endforeach
                        <hr />
                        @endif
                        
                        <div id="attech">
                               
                        </div>
                        <button class="btn btn-success" id="add_attech"><span class="fa fa-plus"></span></button>
                            
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{route('data-archive')}}" class="btn btn-secondary me-1" type="submit" id="btn-simpan">Back</a>
                <button class="btn btn-primary" type="submit" id="btn-simpan">Update</button>
            </div>
        </div>
    </form>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    
    <script>
         $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        $('#btn-simpan').on('submit',function(){
            $('#btn-simpan').attr('disabled',true)
        })
        $('#add_attech').on('click',function(e){
            e.preventDefault();
            var tot = 'a-1';
            $('.attech_file').each(function(x){
                tot = parseInt(x);
            })
            var classFile = "file-"+tot;
            var html = `<div class="attech_file `+classFile+`">
                            <div class="form-group">
                                <label>Document Name</label>
                                <input type="text" name="attech_name[]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="attech[]" class="form-control" required>
                            </div>
                        </div>
                        <div class="row `+classFile+`">
                            <div>
                                <botton class="btn btn-warning float-end remove `+classFile+`" data-class="`+classFile+`">remove</botton>
                            </div>
                            <hr class="border-dot" />
                        </div>`;
            $('#attech').append(html);
           
        })
        $(document).on('click','.remove',function(e){
            e.preventDefault();
            var classFile = $(this).attr('data-class');
            $('.'+classFile).remove();
        })
        $(document).on('click','.remove-file',function(e){
               e.preventDefault();
                var id = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will remove this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function(confirm){
                    if (confirm.value == true){
                        $.ajax({
                            url : "{{route('delete-file')}}",
                            type : 'post',
                            data : {id : id},
                            dataType : 'json',
                            beforeSend : function(){
                                // $('.containerLoader').attr('hidden',false)
                            },
                            success : function(respon){
                                // $('.containerLoader').attr('hidden',true)
                                swal.fire({
                                    icon : respon.status,
                                    text : respon.msg,
                                })
                                $('.'+id).fadeOut();
                            },
                            error : function (){
                                alert('There is an error !, please try again')
                            }
                        })
                    }
                })
            })
    </script>
@endsection
