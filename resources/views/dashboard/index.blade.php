@extends('app')
@section('title', 'Dashboard')

@section('content')
    <div class="vh-100-custom container mt-15">
        <!-- We need to implement the following:-->
        <!--***************NEW USERS***************-->
        <!--***************RECENTLY INACTIVE USERS + REASON***************-->
        <!--***************PAYMENTS COLLECTED (Filtered by collector)***************-->
        <!--***************TOP CONSUMERS PER CACHE***************-->
        <div class="row row-cols-3">
            <div class="col">
                <a href=""
                    class="card-glass d-flex flex-column justify-content-center align-items-center text-decoration-none text-white fs-2 fw-bold p-4 mx-1">
                    <span><i class="fa fa-plus"></i> New Users</span>
                </a>
            </div>
            <div class="col">
                <a href=""
                    class="card-glass d-flex flex-column justify-content-center align-items-center text-decoration-none text-white fs-2 fw-bold p-4 mx-1">
                    <span><i class="fa fa-coins"></i> Payments</span>
                </a>
            </div>
            <div class="col">
                <a href=""
                    class="card-glass d-flex flex-column justify-content-center align-items-center text-decoration-none text-white fs-2 fw-bold p-4 mx-1">
                    <span><i class="fa fa-users"></i> Inactive Users</span>
                </a>
            </div>
        </div>
    </div>
@endsection
