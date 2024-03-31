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
        @if(auth()->user()->type == 'admin' || auth()->user()->type == 'company')
        <div class="row mb-4">
            <div class="col-auto float-end ms-auto">
                <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_branch"><i class="fa fa-plus"></i> New Branch</a>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="tblBranch">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Branch</th>
                                <th>Branch Code</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    @include('include.modal.branches-modal')
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
   
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var table = $('#tblBranch').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax : {
                    "url" : 'get-branch-data',
                    "type" : 'POST',
                },
            columns: [
                { data: 'no', name:'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'alias',
                    name: 'alias'
                },
                {
                    data: 'action',
                    name: 'action',
                    className : 'dt-center'
                },
            ],

        })
        $('#branchIdForm').on('submit',function(e){
            var data = $('#branchIdForm').serialize();
            e.preventDefault();
            $.ajax({
                url : "{{route('branches.store')}}",
                type : 'post',
                data : data,
                dataType : 'json',
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#add_branch').modal('hide')
                        $('#branchIdForm')[0].reset();
                        table.ajax.reload();
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    });
                }
            })
        })
        $(document).on('click','.edit-branch',function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url : 'edit-branch',
                data : {id:id},
                dataType : 'json',
                success : function(respon){
                    $('#edit_branch').modal('show')
                    $('#id').val(respon.id)
                    $('#company_id').val(respon.company_id)
                    $('#alias').val(respon.alias)
                    $('#edit-name-branch').val(respon.name)
                }
            })
        })
        $('#edit-form-branch').on('submit',function(e){
            e.preventDefault();
            var data = $('#edit-form-branch').serialize();
            $.ajax({
                url : 'update-branch',
                type : 'post',
                data : data,
                dataType : 'json',
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#edit_branch').modal('hide')
                        $('#edit-form-branch')[0].reset();
                        table.ajax.reload();
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    });
                }
            })
        })
        $(document).on('click','.delete-branch',function(e){
           e.preventDefault();
            var id = $(this).attr('data-id')
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
                        url : 'delete-branch',
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
                            table.ajax.reload();
                        },
                        error : function (){
                            alert('There is an error !, please try again')
                        }
                    })
                }
            })
        })
    })

</script>
@endsection