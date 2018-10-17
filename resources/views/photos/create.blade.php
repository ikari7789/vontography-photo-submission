@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('photos.index') }}">{{ __('photos.pages.index.title') }}</a></li>
              <li class="breadcrumb-item active">{{ __('photos.pages.create.title') }}</li>
            </ol>

            <div class="card">
                <div class="card-header">{{ __('photos.pages.create.form_title') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                        @csrf

                        @guest
                        <p class="alert alert-info">
                            {!! __('photos.pages.create.alert', ['request_url' => route('password.request')]) !!}
                        </p>
                        <div class="form-group row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="name" class="form-control-label">
                                    {{ __('photos.attributes.name.text') }}<span class="text-danger">*</span>
                                </label>

                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="{{ __('photos.attributes.name.placeholder') }}" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="email" class="form-control-label">
                                    {{ __('photos.attributes.email.text') }}<span class="text-danger">*</span>
                                </label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('photos.attributes.email.placeholder') }}" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endguest

                        <div class="form-group">
                            <label for="photo" class="form-control-label">
                                {{ __('photos.attributes.photo.text') }}<span class="text-danger">*</span>
                            </label>

                            <input id="photo" type="file" class="form-control-file{{ $errors->has('photo') ? ' is-invalid' : '' }}" name="photo" aria-describedby="photo-help" placeholder="{{ __('photos.attributes.photo.text') }}" value="{{ old('photo') }}" required>

                            <small id="photo-help" class="form-text text-muted">{{ __('photos.attributes.photo.description') }}</small>

                            @if ($errors->has('photo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="social_handle" class="form-control-label">
                                 {{ __('photos.attributes.social_handle.text') }}<span class="text-danger">*</span>
                            </label>

                            <input id="social_handle" type="text" class="form-control{{ $errors->has('social_handle') ? ' is-invalid' : '' }}" name="social_handle" placeholder="{{ __('photos.attributes.social_handle.placeholder') }}" value="{{ old('social_handle') }}" required>

                            @if ($errors->has('social_handle'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('social_handle') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="featuring" class="form-control-label">
                                {{ __('photos.attributes.featuring.text') }}
                            </label>

                            <textarea id="featuring" type="text" class="form-control{{ $errors->has('featuring') ? ' is-invalid' : '' }}" name="featuring" placeholder="{{ __('photos.attributes.featuring.placeholder') }}" />{{ old('featuring') }}</textarea>

                            @if ($errors->has('featuring'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('featuring') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="camera_metadata" class="form-control-label">
                                {{ __('photos.attributes.camera_metadata.text') }}
                            </label>

                            <textarea id="camera_metadata" class="form-control{{ $errors->has('camera_metadata') ? ' is-invalid' : '' }}" style="height: 6em" name="camera_metadata" placeholder="{{ __('photos.attributes.camera_metadata.placeholder') }}" />{{ old('camera_metadata') }}</textarea>

                            <small id="camera_metadata-help" class="form-text text-muted">{{ __('photos.attributes.camera_metadata.description') }}</small>

                            @if ($errors->has('camera_metadata'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('camera_metadata') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="comment" class="form-control-label">
                                {{ __('photos.attributes.comment.text') }}
                            </label>

                            <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" placeholder="{{ __('photos.attributes.comment.placeholder') }}" />{{ old('comment') }}</textarea>

                            @if ($errors->has('comment'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('photos.pages.create.submit') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
