@extends('template.main')
@section('content')
    <!-- Search Filter -->
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3"> 
            <div class="form-group form-focus select-focus">
                <select class="select floating" id="branch_id"> 
                    @foreach ($branch as $branches)
                        <option value="{{$branches->id}}">{{ $branches->alias}}</option> 
                    @endforeach
                   
                </select>
                <label class="focus-label">BRANCH</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="row">
                <div class="col-md-2 me-1">
                    <a href="#" class="btn btn-success" id="search"> Search </a>  
                </div>
                <div class="col-md-3">
                    <a href="{{ route('create-employee')}}" class="btn btn-primary"><span class="fa fa-plus me-1"></span>Create</a>
                </div>
            </div>  
        </div>
    </div>
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
    <!-- Search Filter -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table w-100" id="tblEmployee">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Identity Number</th>
                            <th>Name</th>
                            {{-- <th>Email</th> --}}
                            {{-- <th>Phone</th> --}}
                            <th>Files</th>
                            <th class="text-end no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
            });
            var branch = $('#branch_id').val();
            loadData(branch);
            function loadData(branch){
                $('#tblEmployee').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax : {
                            "url" : 'get-employee',
                            "type" : 'POST',
                            "data" : {branch : branch},
                        },
                    columns: [
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        {
                            data: 'identity_card',
                            name: 'identity_card'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        // {
                        //     data: 'email',
                        //     name: 'email'
                        // },
                        // {
                        //     data: 'phone',
                        //     name: 'phone'
                        // },
                        {
                            data: null,
                            render : function(data,row,type){
                                var view = `<div class="dropdown">
                                                <a href="" data-id=`+data.id+` class="link-file btn btn-white btn-sm btn-rounded dropdown-toggle w-100" data-bs-toggle="dropdown" aria-expanded="false">FILE </a>
                                                <div class="dropdown-menu files-append">
                                                    
                                                </div>
                                            </div>`;
                                return view;
                            },
                            className : 'dt-center'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            // className : 'dt-center'
                        },
                    ],
        
                })
            }
            $('#search').on('click',function(){
                var branch = $('#branch_id').val();
                loadData(branch);
            })
           
            $(document).on('click','.delete-employee',function(e){
               e.preventDefault();
                var id = $(this).attr('data-id')
                var branch = $('#branch_id').val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then(function(confirm){
                    if (confirm.value == true){
                        $.ajax({
                            url : 'delete-employee',
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
                                loadData(branch);
                            },
                            error : function (){
                                alert('There is an error !, please try again')
                            }
                        })
                    }
                })
            })
            $(document).on('click','.link-file',function(){
                var employee_id = $(this).attr('data-id');
                $.ajax({
                    url : 'get_attechment',
                    type : 'post',
                    data : {employee_id : employee_id},
                    dataType : 'json',
                    beforeSend : function(){

                    },
                    success : function(respon){
                        var html ='';
                        $.each(respon.file, function(key,val){
                            html +=`<a class="dropdown-item" target ="_blank" href="`+val.url_file+`">`+val.name+`</a>`;
                        })
                        $('.files-append').html(html)
                    },
                    error :function(){
                        alert('Something went wrong!')
                    }
                })
            })
        })
    </script>
@endsection()