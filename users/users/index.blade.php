@extends('Admin.layouts.app')
@section('title', __('Users'))

{{-- علشان يظلل الجزء المعروض فى السيدبار --}}
@section('employee_active', 'active')
{{-- علشان يخلى الدروب دون مفتوحة  --}}
@section('user_open', 'open')

@push('styles')
    <style>
        .table-responsive {
            overflow: visible;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-center">
            <h4 class="fw-bold py-3 mb-4 text-center">
                <span class="text-muted fw-light"></span>
                {{ __('dashboard.Show Employees') }}
            </h4>
        </div>


        {{-- Flash Messages --}}
        @foreach (['Add' => 'success', 'Error' => 'danger', 'edit' => 'success', 'delete' => 'danger'] as $key => $type)
            @if (session()->has($key))
                <div class="alert alert-{{ $type }} alert-dismissible fade show text-center" role="alert">
                    <strong>{{ session()->get($key) }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach

        <script>
            setTimeout(() => $('.alert').fadeOut('slow'), 3000);
        </script>

        <div class="d-flex justify-content-center">
            <div class="card w-100" style="max-width: 1000px;">

                {{-- Search + Add --}}
                <div class="d-flex justify-content-between align-items-center p-3">
                    {{-- زر الرجوع --}}
                    <a href="{{ route('admin.home.index') }}" class="btn btn-primary">
                      <i class="bi bi-arrow-left"></i>  {{ __('dashboard.Back') }}
                    </a>
                    <form method="GET" action="{{ route('admin.pages.users.index') }}" id="searchForm" class="d-flex"
                        style="gap: 10px;">
                        <input type="text" name="search" id="UserSearch" class="form-control  text-dark text-center"
                            placeholder="{{ __('dashboard.Search by employee name') }}" value="{{ request('search') }}"
                            style="width: 250px;">
                    </form>

                    <a href="{{ route('admin.pages.users.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> {{ __('dashboard.Add User+') }}
                    </a>
                </div>

                {{-- Table --}}
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('dashboard.Name') }}</th>
                                <th>{{ __('dashboard.Email') }}</th>
                                <th>{{ __('dashboard.Phone') }}</th>
                                <th>{{ __('dashboard.Address') }}</th>
                                <th>{{ __('dashboard.Change Status') }}</th>
                                <th>{{ __('dashboard.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <form action="{{ route('admin.pages.users.toggleStatus', $user->id) }}"
                                            method="POST" class="d-flex align-items-center justify-content-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status"
                                                class="form-select form-select-sm text-center status-select"
                                                style="width: 120px;" onchange="this.form.submit()"
                                                data-user-status="{{ $user->status }}">
                                                <option value="1" {{ $user->status ? 'selected' : '' }}>مفعل</option>
                                                <option value="0" {{ !$user->status ? 'selected' : '' }}>غير مفعل
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.pages.users.edit', $user) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <button type="button" onclick="deleteId({{ $user->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">{{ __('dashboard.Nothing!') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-3 text-end">
                    {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- SweetAlert Delete --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteId(id) {
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: "{{ __('Do you want to delete this item') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC143C',
                cancelButtonColor: '#696969',
                cancelButtonText: "{{ __('Cancel') }}",
                confirmButtonText: '{{ __('Yes, delete it!') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.action = "{{ route('admin.pages.users.delete', '') }}/" + id;
                    form.method = 'POST';

                    form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

    {{-- Auto Search --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById("UserSearch");
            const form = document.getElementById("searchForm");
            let timeout = null;

            input.addEventListener("input", function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => form.submit(), 500);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.status-select').forEach(select => {
                function updateColor() {
                    if (select.value === "1") {
                        select.classList.remove('border-danger', 'text-danger');
                        select.classList.add('border-success', 'text-success');
                    } else {
                        select.classList.remove('border-success', 'text-success');
                        select.classList.add('border-danger', 'text-danger');
                    }
                }

                updateColor(); // Initial call
                select.addEventListener('change', updateColor); // On change
            });
        });
    </script>
@endpush
