@extends('template.main')
@section('content')
    <!-- Search Filter -->
    <div class="row">
        <div class="col-md-12">
            <a href="#" class="btn btn-primary mb-3 float-end" id="add_user"><span class="fa fa-plus me-1"></span>Create</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table w-100" id="tblUser">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('contents.user.modal.add')
@include('contents.user.modal.edit')

<!-- jQuery -->

<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });
        var table = $('#tblUser').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax : {
                    "url" : 'get-user',
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'action',
                    name: 'action',
                    className : 'dt-center'
                },
            ],

        })
        $('#add_user').on('click',function(){
            $('#add_userCreate').modal('show')
        })
        $('#formUser').on('submit',function(e){
            var data = $('#formUser').serialize();
            e.preventDefault();
            $.ajax({
                url : 'store-user',
                type : 'post',
                data : data,
                dataType : 'json',
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#add_userCreate').modal('hide')
                        $('#formUser')[0].reset();
                        table.ajax.reload();
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    });
                }
            })
        })
        $(document).on('click','.edit-user',function(){
            var id = $(this).attr('data-id');
            $.ajax({
                url : 'edit-user',
                type : 'post',
                data : {id:id},
                dataType : 'json',
                success : function(respon){
                    $('#edit_user').modal('show')
                    $('#id').val(respon.id)
                    $('#name').val(respon.name)
                    $('#email').val(respon.email)
                }
            })
        })
        $('#updateUser').on('submit',function(e){
            e.preventDefault();
            var data = $('#updateUser').serialize();
            $.ajax({
                url : 'update-user',
                type : 'post',
                data : data,
                dataType : 'json',
                success : function(respon){
                    if (respon.status == 'success'){
                        $('#edit_user').modal('hide')
                        $('#formUser')[0].reset();
                        table.ajax.reload();
                    }
                    swal.fire({
                        icon : respon.status,
                        text : respon.msg
                    });
                }
            })
        })
        $(document).on('click','.delete-user',function(e){
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
                        url : 'delete-user',
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
@endsection()
