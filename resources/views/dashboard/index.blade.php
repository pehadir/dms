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
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 mb-4">
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
                        <span>NEW</span>
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
                        <span>EMPLOYEE</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon text-success"><i class="fa fa-cubes"></i></span>
                    <div class="dash-widget-info">
                        <h3>{{$archiveTotal}}</h3>
                        <span class="text-success">TOTAL ARCHIVE</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class=" rounded shadow">
                {!! $bar->container() !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class=" rounded shadow">
                {!! $pie->container() !!}
            </div>
        </div>
    </div>
    
    <script src="{{ $pie->cdn() }}"></script>
    <script src="{{ $bar->cdn() }}"></script>
    
    {{ $pie->script() }}
    {{ $bar->script() }}
    <style>
        #charts{
          width: 30px !important;
          height: 30px !important;
          border: 1px solid #000;
        }
        </style>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
@endsection()
