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
                    <div class="card-header p-3"><h4 class="mb-0">Data</h4></div>
                    <div class="card-body employee-detail-edit-body fulls-card">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Name</label><span class="text-danger pl-1">*</span>
                                <input name="id" type="hidden" value="{{$emp->id}}" required>
                                <input class="form-control" name="name" type="text" id="name" value="{{$emp->name}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob" class="form-label">Date</label><span class="text-danger pl-1">*</span>
                                <input class="form-control" name="dob" type="date" id="dob" value="{{ date('Y-m-d', strtotime($emp->created_at)) }}" readonly>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="gender" class="form-label">Gender</label><span class="text-danger pl-1">*</span>
                                <div class="d-flex radio-check mt-2">
                                    <select class="form-control form-select" name="gender" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="MALE" {{($emp->gender=='MALE') ? 'selected' : ''}}>Male</option>
                                        <option value="FEMALE" {{($emp->gender=='FEMALE') ? 'selected' : ''}}>Female</option>
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
                    <div class="card-header p-3"><h4 class="mb-0">Upload Attachment</h4></div>
                    <div class="card-body employee-detail-edit-body fulls-card">
                        <div class="row">
                            <hr >
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
                <a href="{{route('data-archive')}}" class="btn btn-secondary me-1">Back</a>
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
                                <input type="file" name="attech[]" class="form-control type-file" required>
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
        function getFile(filename) {
            return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
        }
        $(document).on('change','.type-file',function(){
            var type = $(this)[0].files[0];
            var ext  = getFile(type.name)
            console.log(ext[0])
            if (ext[0] != 'pdf' & ext[0] != 'jpg' & ext[0] != 'jpeg' & ext[0] != 'png' & ext[0] != 'webp' & ext[0] != 'svg'){
                $('#add_attech').attr('disabled',true)
                $('#btn-simpan').attr('disabled',true)
                swal.fire({
                    icon : 'info',
                    text : 'file extention invalid !'
                })
            }else{
                $('#add_attech').attr('disabled',false)
                $('#btn-simpan').attr('disabled',false)
            }
        })
        $(document).on('click','.remove',function(e){
            e.preventDefault();
            var classFile = $(this).attr('data-class');
            $('.'+classFile).remove();
            $('#add_attech').attr('disabled',false)
            $('#btn-simpan').attr('disabled',false)
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
