@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('photos.index') }}">{{ __('photos.pages.index.title') }}</a></li>
              <li class="breadcrumb-item active">{{ __('photos.pages.show.title') }}</li>
            </ol>

            <div class="card">
                <div class="card-body">
                    <a href="{{ route('uploads.photos.show', ['id' => $photo->id, 'original' => 1]) }}">
                        <img class="img-thumbnail img-fluid mx-auto d-block" src="{{ route('uploads.photos.show', ['id' => $photo->id, 'width' => 500]) }}" alt="{{ $photo->social_handle }}" />
                    </a>
                    <dl class="row mt-3">
                        <dt class="col-sm-3">{{ __('photos.attributes.uploader.text') }}</dt>
                        <dd class="col-sm-9">{{ $photo->user->name }}</dd>
                        <dt class="col-sm-3">{{ __('photos.attributes.social_handle.text') }}</dt>
                        <dd class="col-sm-9">{{ '@'.$photo->social_handle }}</dd>
                        @if (isset($photo->featuring))
                            <dt class="col-sm-3">{{ __('photos.attributes.featuring.text') }}</dt>
                            <dd class="col-sm-9">
                                @foreach (explode("\n", $photo->featuring) as $line)
                                    {{ $line }}<br />
                                @endforeach
                            </dd>
                        @endif
                        @if (isset($photo->camera_metadata))
                            <dt class="col-sm-3">{{ __('photos.attributes.camera_metadata.text') }}</dt>
                            <dd class="col-sm-9">
                                @foreach (explode("\n", $photo->camera_metadata) as $line)
                                    {{ $line }}<br />
                                @endforeach
                            </dd>
                        @endif
                        @if (isset($photo->comment))
                            <dt class="col-sm-3">{{ __('photos.attributes.comment.text') }}</dt>
                            <dd class="col-sm-9">
                                @foreach (explode("\n", $photo->comment) as $line)
                                    {{ $line }}<br />
                                @endforeach
                            </dd>
                        @endif
                    </dl>
                </div>
                <div class="card-footer text-right">
                    @can('delete', $photo)
                        <a href="{{ route('photos.destroy', ['id' => $photo->id]) }}"
                           class="btn btn-danger"
                           role="button"
                           onclick="event.preventDefault();
                                    document.getElementById('delete-photo-{{ $photo->id }}-form').submit();"
                        >
                            {{ __('photos.pages.show.delete_action') }}
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
        </div>
    </div>
</div>
@endsection
