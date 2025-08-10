@extends('Admin.layout.app')

@section('title', __('Dashboard'))

@section('content')

    <div class="analytics">
        <div class="row text-center">

            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card rounded-4 custom-card bg-light text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                            <h5 class="mb-0">
                                  <i class="menu-icon tf-icons bx bx-buildings text-primary"></i>
                                {{ __('messages.Number Of City') }}
                            </h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('cities.index') }}" class="btn btn-success">
                                {{ __('messages.Show') }}
                            </a>
                            <h2 class="fw-bold mb-0">{{ $citycount }}</h2>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card rounded-4 custom-card bg-light text-dark">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center gap-3 mb-2">
                            <h5 class="mb-0">
                                   <i class="menu-icon tf-icons bx bx-globe text-primary"></i>
                                {{ __('messages.Number Of Country') }}
                            </h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('country.index') }}" class="btn btn-success">
                                {{ __('messages.Show') }}
                            </a>
                            <h2 class="fw-bold mb-0">{{ $countrycount }}</h2>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


@endsection
