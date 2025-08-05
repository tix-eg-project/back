@extends('Admin.layout.app')

@section('title', __('messages.add_banner'))

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ __('messages.add_banner') }}</h5>

        <form method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Title AR --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.title') }} (AR)</label>
                <input type="text" name="title[ar]" class="form-control @error('title.ar') is-invalid @enderror"
                    value="{{ old('title.ar') }}">
                @error('title.ar')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Title EN --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.title') }} (EN)</label>
                <input type="text" name="title[en]" class="form-control @error('title.en') is-invalid @enderror"
                    value="{{ old('title.en') }}">
                @error('title.en')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description AR --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.description') }} (AR)</label>
                <textarea name="description[ar]" class="form-control @error('description.ar') is-invalid @enderror">{{ old('description.ar') }}</textarea>
                @error('description.ar')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description EN --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.description') }} (EN)</label>
                <textarea name="description[en]" class="form-control @error('description.en') is-invalid @enderror">{{ old('description.en') }}</textarea>
                @error('description.en')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.image') }}</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
            <a href="{{ route('banners.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
        </form>
    </div>
</div>
@endsection