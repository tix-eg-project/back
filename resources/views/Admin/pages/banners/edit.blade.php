@extends('Admin.layout.app')

@section('title', __('messages.edit_banner'))

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ __('messages.edit_banner') }}</h5>

        <form method="POST" action="{{ route('banners.update', $banner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title AR --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.title') }} (AR)</label>
                <input type="text" name="title[ar]" class="form-control @error('title.ar') is-invalid @enderror"
                    value="{{ old('title.ar') ?? (json_decode($banner->getRawOriginal('title'), true)['ar'] ?? '') }}">
                @error('title.ar')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Title EN --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.title') }} (EN)</label>
                <input type="text" name="title[en]" class="form-control @error('title.en') is-invalid @enderror"
                    value="{{ old('title.en') ?? (json_decode($banner->getRawOriginal('title'), true)['en'] ?? '') }}">
                @error('title.en')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description AR --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.description') }} (AR)</label>
                <textarea name="description[ar]" class="form-control @error('description.ar') is-invalid @enderror">{{ old('description.ar') ?? (json_decode($banner->getRawOriginal('description'), true)['ar'] ?? '') }}</textarea>
                @error('description.ar')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description EN --}}
            <div class="mb-3">
                <label class="form-label">{{ __('messages.description') }} (EN)</label>
                <textarea name="description[en]" class="form-control @error('description.en') is-invalid @enderror">{{ old('description.en') ?? (json_decode($banner->getRawOriginal('description'), true)['en'] ?? '') }}</textarea>
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

                @if($banner->getFirstMediaUrl(\App\Enums\ImageEnum::IMAGE))
                <div class="mt-2">
                    <img src="{{ $banner->getFirstMediaUrl(\App\Enums\ImageEnum::IMAGE) }}" width="80" alt="current image">
                    <small class="text-white d-block mt-1">{{ basename($banner->getFirstMediaPath(\App\Enums\ImageEnum::IMAGE)) }}</small>
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
            <a href="{{ route('banners.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
        </form>
    </div>
</div>
@endsection