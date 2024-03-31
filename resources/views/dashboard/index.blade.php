@extends('template.main')
@section('content')
    <div class="row">
        <form action="{{route('search')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="branch_id" name="branch_id"> 
                            <option value="all">All</option>
                            @foreach ($branch as $branches)
                                <option value="{{$branches->id}}">{{ $branches->name}}</option> 
                            @endforeach
                        
                        </select>
                        <label class="focus-label">BRANCH</label>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$dataIn}}</h3>
                        <span>DATA THIS MONTH</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon text-success"><i class="fa fa-check"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$dataActive}}</h3>
                        <span class="text-success">DATA ACTIVE</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon text-danger"><i class="fa fa-close"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$dataNonactive}}</h3>
                        <span class="text-danger">DATA NON ACTIVE</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$dataTotal}}</h3>
                        <span>TOTAL DATA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- 
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Total Revenue</h3>
                            <div id="bar-charts"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Sales Overview</h3>
                            <div id="line-charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
@endsection()
