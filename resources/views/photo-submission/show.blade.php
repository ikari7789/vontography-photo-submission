@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 mb-3 justify-content-md-center">
        <div class="col-md-10 offset-md-2">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('photo-submissions.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Photo Details</li>
            </ol>

            <div class="card">
                <h4 class="card-header">{{ $photo->title }}</h4>
                <div class="card-body">
                    <img class="img-fluid mx-auto d-block mb-3 border border-dark" src="{{ route('photos.show', ['id' => $photo->id]) }}" alt="{{ $photo->title }}" />
                    <dl class="row">
                        <dt class="col-sm-3">Uploader</dt>
                        <dd class="col-sm-9">{{ $photo->user->name }}</dd>
                        @if (isset($photo->url))
                            <dt class="col-sm-3">URL</dt>
                            <dd class="col-sm-9"><a href="{{ $photo->url }}">{{ $photo->url }}</a></dd>
                        @endif
                        @if (isset($photo->location))
                            <dt class="col-sm-3">Location</dt>
                            <dd class="col-sm-9">{{ $photo->location }}</dd>
                        @endif
                        @if (isset($photo->featuring))
                            <dt class="col-sm-3">Featuring</dt>
                            <dd class="col-sm-9">{{ $photo->featuring }}</dd>
                        @endif
                        @if (isset($photo->comment))
                            <dt class="col-sm-3">Comment</dt>
                            <dd class="col-sm-9">{{ $photo->comment }}</dd>
                        @endif
                    </dl>
                    @if ($photo->user->id === Auth::id())
                        <a href="{{ route('photo-submissions.destroy', ['id' => $photo->id]) }}"
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
                              action="{{ route('photo-submissions.destroy', ['id' => $photo->id]) }}"
                        >
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
