@extends('Admin.layout.app')

@section('title', __('messages.banners'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>{{ __('messages.banners') }}</h4>

    <a href="{{ route('banners.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('messages.add_banner') }}
    </a>
</div>

<table class="table table-striped text-black">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('messages.title') }}</th>
            <th>{{ __('messages.description') }}</th>
            <th>{{ __('messages.image') }}</th>
            <th>{{ __('messages.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($banners as $banner)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $banner->title }}</td>
            <td>{{ Str::limit($banner->description, 50) }}</td>

            <td>
                @if($banner->image)
                <img src="{{ asset( $banner->image) }}" width="60" alt="">
                @else
                -
                @endif
            </td>
            <td>
                <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="d-inline-block">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('{{ __('messages.confirm_delete') }}')" class="btn btn-sm btn-danger">
                        {{ __('messages.delete') }}
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">{{ __('messages.no_data') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $banners->links('pagination::bootstrap-4') }}
</div>
@endsection