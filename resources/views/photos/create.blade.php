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
                            <label for="title" class="form-control-label">
                                 {{ __('photos.attributes.title.text') }}<span class="text-danger">*</span>
                            </label>

                            <input  id="title" type="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" placeholder="{{ __('photos.attributes.title.placeholder') }}" value="{{ old('title') }}" required>

                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

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
