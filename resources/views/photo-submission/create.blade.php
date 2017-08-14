@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3 justify-content-md-center">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Photo Submission</div>

                <div class="card-block">
                    <form method="POST" action="/photo-submissions">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="name-help" placeholder="Enter name" />
                            <small id="name-help" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="Enter email" />
                            <small id="email-help" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help" placeholder="Enter title" />
                            <small id="title-help" class="form-text text-muted">What do you call this photo?</small>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" aria-describedby="photo-help" placeholder="Upload photo" />
                            <small id="photo-help" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url" aria-describedby="url-help" placeholder="Enter URL" />
                            <small id="url-help" class="form-text text-muted">Where can we find this picture or what's your site?</small>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" aria-describedby="location-help" placeholder="Enter location" />
                            <small id="location-help" class="form-text text-muted">Where was the photo taken?</small>
                        </div>
                        <div class="form-group">
                            <label for="featuring">Featuring</label>
                            <input type="text" class="form-control" id="featuring" name="featuring" aria-describedby="featuring-help" placeholder="Enter featuring" />
                            <small id="featuring-help" class="form-text text-muted">Who appears in the photo?</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload Photo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
