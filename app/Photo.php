<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use lsolesen\pel\PelJpeg;
use lsolesen\pel\PelJpegInvalidMarkerException;
use lsolesen\pel\PelTag;

class Photo extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'social_handle',
        'filepath',
        'url',
        'location',
        'featuring',
        'comment',
        'camera_metadata',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function metadata(): array
    {
        $metadata = [];

        $jpeg = null;
        try {
            $jpeg = new PelJpeg(Storage::path($this->filepath));
        } catch (PelJpegInvalidMarkerException $e) {
            // Just skip the error
        }

        if (is_null($jpeg)) {
            return $metadata;
        }

        $exif = $jpeg->getExif();

        if (is_null($exif)) {
            return $metadata;
        }

        $tiff = $exif->getTiff();

        if (is_null($tiff)) {
            return $metadata;
        }

        $ifd = $tiff->getIfd();

        if (is_null($ifd)) {
            return $metadata;
        }

        foreach ($ifd->getEntries() as $entry) {
            $key   = PelTag::getName($entry->getIfdType(), $entry->getTag());
            $value = $entry->getText();

            $metadata[$key] = $value;
        }

        foreach ($ifd->getSubIfds() as $type => $subIfd) {
            foreach ($subIfd->getEntries() as $entry) {
                $key   = PelTag::getName($entry->getIfdType(), $entry->getTag());
                $value = $entry->getText();

                $metadata[$key] = $value;
            }
        }

        return $metadata;
    }
}
