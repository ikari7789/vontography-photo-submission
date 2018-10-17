@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">{{ __('photos.pages.index.title') }}</li>
            </ol>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <a class="btn btn-primary btn-lg btn-block mb-3" href="{{ route('photos.create') }}">{{ __('photos.pages.index.create_action') }}</a>

            <div class="card-columns">
            @foreach($photos as $photo)
                <div class="card">
                    <a href="{{ route('photos.show', ['id' => $photo->id]) }}">
                        <img class="card-img-top" src="{{ route('uploads.photos.show', ['id' => $photo->id, 'width' => 500]) }}" alt="{{ $photo->social_handle }}">
                    </a>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-6">{{ __('photos.attributes.uploader.text') }}</dt>
                            <dd class="col-sm-6">{{ $photo->user->name }}</dd>
                            <dt class="col-sm-6">{{ __('photos.attributes.social_handle.text') }}</dt>
                            <dd class="col-sm-6">{{ '@'.$photo->social_handle }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer text-right">
                        <a class="btn btn-primary" role="button" href="{{ route('photos.show', ['id' => $photo->id]) }}">{{ __('photos.pages.index.details') }}</a>
                        @can('delete', $photo)
                            <a href="{{ route('photos.destroy', ['id' => $photo->id]) }}"
                               class="btn btn-danger"
                               role="button"
                               onclick="event.preventDefault();
                                        document.getElementById('delete-photo-{{ $photo->id }}-form').submit();"
                            >
                                {{ __('photos.pages.index.delete_action') }}
                            </a>
                            <form class="form-inline"
                                  id="delete-photo-{{ $photo->id }}-form"
                                  method="POST"
                                  action="{{ route('photos.destroy', ['id' => $photo->id]) }}"
                            >
                                @csrf
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
