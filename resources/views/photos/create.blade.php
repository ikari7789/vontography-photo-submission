@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 mb-3 justify-content-md-center">
        <div class="col-md-10 offset-md-2">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('photos.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Submit Photo</li>
            </ol>

            <div class="card">
                <div class="card-header">Photo Submission</div>

                <div class="card-body">
                    <form method="post" action="{{ route('photos.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            @guest
                            <div class="form-group col-md-6 mb-3">
                                <label for="name" class="form-control-label">
                                    Name or Social handle<span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="John Doe" value="{{ $name or old('name') }}" required />

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="email" class="form-control-label">
                                    Email<span class="text-danger">*</span>
                                </label>

                                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="john.doe@example.com" value="{{ $email or old('email') }}" required />

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @endguest
                        </div>

                        <div class="form-group">
                            <label for="title" class="form-control-label">
                                Title<span class="text-danger">*</span>
                            </label>

                            <input type="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Title of the photo" value="{{ $title or old('title') }}" required />

                            @if ($errors->has('title'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="photo" class="form-control-label">
                                Photo<span class="text-danger">*</span>
                            </label>

                            <input type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}" id="photo" name="photo" aria-describedby="photo-help" placeholder="Enter photo" value="{{ $photo or old('photo') }}" required />

                            <small id="photo-help" class="form-text text-muted">Minimum resolution: 1920px x 1080px</small>

                            @if ($errors->has('photo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="featuring" class="form-control-label">
                                Featuring
                            </label>

                            <textarea type="text" class="form-control{{ $errors->has('featuring') ? ' is-invalid' : '' }}" id="featuring" name="featuring" placeholder="Name / Social handle of cosplayer(s)" />{{ $featuring or old('featuring') }}</textarea>

                            @if ($errors->has('featuring'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('featuring') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="comment" class="form-control-label">
                                Comments
                            </label>

                            <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" id="comment" name="comment" placeholder="Anything you'd like to add?" />{{ $comment or old('comment') }}</textarea>

                            @if ($errors->has('comment'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('comment') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit Photo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
