@extends('template.main')
@section('content')
    <!-- /Page Header -->
    <form action="{{route('save-employee')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card emp_details">
                    <div class="card-header p-3"><h4 class="mb-0">Data Personal</h4></div>
                    <div class="card-body employee-detail-edit-body fulls-card">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Name</label><span class="text-danger pl-1">*</span>
                                <input class="form-control"  name="name" type="text" id="name" required>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label><span class="text-danger pl-1">*</span>
                                <input class="form-control" name="dob" type="date" id="dob" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="gender" class="form-label">Gender</label><span class="text-danger pl-1">*</span>
                                <div class="d-flex radio-check mt-2">
                                    <select class="form-control form-select" name="gender" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="identity_card" class="form-label">Identity Number <span class="text-danger pl-1">*</span></label>
                                <input class="form-control"  name="identity_card" type="text" id="name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="branch_id" class="form-label">Branch <span class="text-danger pl-1">*</span></label>
                                <select class="form-control select" name="branch_id" id="branch_id" required>
                                    <option value="" selected>-- Select Branch --</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id }}">{{$branch->alias}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="marital_status" class="form-label">Status <span class="text-danger pl-1">*</span></label>
                                <select class="form-control form-select" id="status-employee-edit" name="status" required>
                                    <option value="active" selected>Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card emp_details">
                    <div class="card-header p-3"><h4 class="mb-0">Attechments</h4></div>
                    
                    <div class="container mb-4">
                        {{-- <h5>Add Attech</h5> --}}
                        <hr>
                        <div id="attech">
                            
                        </div>
                        <button class="btn btn-success" id="add_attech"><span class="fa fa-plus"></span></button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <a href="{{route('employee')}}" class="btn btn-secondary me-1" type="submit" id="btn-simpan">Back</a>
                <button class="btn btn-primary" type="submit" id="btn-simpan">Save</button>
            </div>
        </div>
    </form>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script>
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
    </script>
@endsection
