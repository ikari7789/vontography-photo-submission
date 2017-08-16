<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PhotoSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::with('user')->get();

        return view('photo-submission.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photo-submission.create');
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
            'name'      => 'string|required|max:192',
            'email'     => 'email|required|max:192',
            'title'     => 'string|required|max:192',
            'photo'     => 'image|required',
            'url'       => 'active_url|nullable|max:192',
            'location'  => 'string|nullable|max:192',
            'featuring' => 'string|nullable|max:192',
        ]);

        // Determine user
        $user = Auth::user();
        if (! isset($user)) {
            $request->validate([
                'email' => 'unique:users',
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

        // save file
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

        return redirect('photo-submissions')->with('status', 'Submission recieved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Photo::find($id);

        return view('photo-submission.show', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $filepath = $photo->filepath;

        if ($photo->user->id === Auth::id()) {
            Storage::disk('s3')->delete($filepath);

            if (Storage::disk('local')->exists($filepath)) {
                Storage::disk('local')->delete($filepath);
            }

            $photo->delete();
        }

        return redirect('photo-submissions')->with('status', 'Submission deleted!');
    }
}
