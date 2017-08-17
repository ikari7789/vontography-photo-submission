<?php

namespace App\Http\Controllers\Uploads;

use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use InvalidArgumentException;

class PhotoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        $this->authorize('view', $photo);

        $key = "photos_{$photo->id}";

        $imageData = Cache::remember($key, 30, function() use ($photo) {
            return Storage::get($photo->filepath);
        });

        return Image::make($imageData)->response();
    }
}
