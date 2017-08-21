<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use App\Notifications\PhotoUploaded;
use App\Rules\CustomDimensions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

class PhotoController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can:view,photo')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $photos = [];

        if ($user) {
            if ($user->is_admin) {
                $photos = Photo::all();
            } else {
                $photos = $user->photos;
            }
        }

        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required|max:192',
            'photo' => [
                'image',
                'required',
                'max:52428800',
                new CustomDimensions([
                    'min_width' => 1920,
                    'min_height' => 1080,
                    'orientation_agnostic' => true,
                ]),
            ],
            'featuring' => 'string|nullable',
            'comment' => 'string|nullable',
        ]);

        // Determine user
        $user = $this->getUser($request);

        // Save file
        $path = $request->photo->store('photos');

        $photo = new Photo([
            'title' => $request->input('title'),
            'filepath' => $path,
            'url' => $request->input('url'),
            'location' => $request->input('location'),
            'featuring' => $request->input('featuring'),
            'comment' => $request->input('comment'),
        ]);

        $user->photos()->save($photo);

        $user->notify(new PhotoUploaded($photo));

        // Notify admins
        foreach (User::where('is_admin', 1)->get() as $admin) {
            if ($admin->id !== $user->id) {
                $admin->notify(new PhotoUploaded($photo));
            }
        }

        return redirect()->route('photos.index')
            ->with('status', 'Photo successfully uploaded!');
    }

    /**
     * Return currently authenticated user or attempt to create
     * and authenticate one given a request object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\User
     */
    protected function getUser(Request $request)
    {
        $user = Auth::user();

        if (! isset($user)) {
            $request->validate([
                'name' => 'string|required|max:192',
                'email' => 'email|required|unique:users|max:192',
            ]);

            $email = $request->input('email');
            $password = Str::random(64);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $email,
                'password' => bcrypt($password),
            ]);

            Auth::attempt([
                'email' => $email,
                'password' => $password,
            ]);
        }

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $this->authorize('delete', $photo);

        // Delete file from storage
        Storage::delete($photo->filepath);

        // Delete the record
        $photo->delete();

        return redirect()->route('photos.index')
            ->with('status', "Photo [{$photo->title}] deleted!");
    }
}
