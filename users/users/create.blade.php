@extends('Admin.layouts.app')
@section('title', __('Add User'))

@push('styles')
    <style>
        select.form-control {
            color: #000 !important;
            background-color: #fff;
        }

        select.form-control option {
            color: #000 !important;
            background-color: #fff;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-center">
            <div class="card w-100" style="max-width: 1000px;">
                <div class="card-header  text-white rounded-top text-center">
                    <h5 class="mb-0">{{ __('dashboard.Add a new user') }}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.pages.users.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('dashboard.Name') }}</label>
                                <input type="text" name="name" value="{{ old('name') }}" id="name"
                                    class="form-control" placeholder="{{ __('dashboard.Enter the user name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ __('dashboard.Email') }}</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="email"
                                    class="form-control" placeholder="{{ __('dashboard.Enter the user email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="form-label">{{ __('dashboard.address') }}</label>
                                <input type="text" name="address" class="form-control"
                                    placeholder="{{ __('dashboard.Enter the user address') }}"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">{{ __('dashboard.Phone') }}</label>
                                <input type="number" value="{{ old('phone') }}" name="phone" id="phone"
                                    class="form-control" placeholder="{{ __('dashboard.Enter the user mobile number') }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">{{ __('dashboard.Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="{{ __('Enter the user password') }}">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="role_id" class="form-label">{{ __('dashboard.Roles') }}</label>
                                <select class="form-select bg-white text-dark" name="role_id" id="role_id">
                                    <option value="" selected disabled>{{ __('dashboard.Choose the user role') }}
                                    </option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.pages.users.index') }}"
                                    class="btn btn-warning">{{ __('dashboard.Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('dashboard.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
