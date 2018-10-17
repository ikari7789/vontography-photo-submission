<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class TermsController extends Controller
{
    public function show()
    {
        $termsUpdatedAt = Carbon::createFromFormat('Y-m-d H:i:s e', config('legal.terms_updated_at'));

        return view('terms.show', ['terms_updated_at' => $termsUpdatedAt]);
    }
}