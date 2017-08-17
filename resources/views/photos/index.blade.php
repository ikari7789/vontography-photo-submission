@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 mb-3 justify-content-md-center">
        <div class="col-md-10 offset-md-2">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Home</li>
            </ol>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <a class="btn btn-primary btn-lg btn-block mb-3" href="{{ route('photos.create') }}">Add a new submission</a>

            <div class="card-columns">
            @foreach($photos as $photo)
                <div class="card">
                    <img class="card-img-top" src="{{ route('uploads.photos.show', ['id' => $photo->id]) }}" alt="{{ $photo->title }}">
                    <div class="card-body">
                        <h4 class="card-title">{{ $photo->title }}</h4>
                        <dl class="row">
                            <dt class="col-sm-6">Uploader</dt>
                            <dd class="col-sm-6">{{ $photo->user->name }}</dd>
                        </dl>
                        <a href="{{ route('photos.show', ['id' => $photo->id]) }}" class="btn btn-primary" role="button">Details</a>
                        @can('delete', $photo)
                            <a href="{{ route('photos.destroy', ['id' => $photo->id]) }}"
                               class="btn btn-danger"
                               role="button"
                               onclick="event.preventDefault();
                                        document.getElementById('delete-photo-{{ $photo->id }}-form').submit();"
                            >
                                Delete
                            </a>
                            <form class="form-inline"
                                  id="delete-photo-{{ $photo->id }}-form"
                                  method="POST"
                                  action="{{ route('photos.destroy', ['id' => $photo->id]) }}"
                            >
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
