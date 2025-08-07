@extends('Admin.layout.app')
@section('category_active', 'active')
@section('category_open', 'open')
@section('title', __('messages.categories'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>{{ __('messages.categories') }}</h4>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> {{ __('messages.add_banner') }}
    </a>
</div>

<table class="table table-striped text-black">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('messages.name') }}</th>
            <th>{{ __('messages.image') }}</th>
            <th>{{ __('messages.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>


            <td>
                @if($category->image)
                <img src="{{ asset( $category->image) }}" width="60" alt="">
                @else
                -
                @endif
            </td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">{{ __('messages.edit') }}</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
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
    {{ $categories->links('pagination::bootstrap-4') }}
</div>
@endsection