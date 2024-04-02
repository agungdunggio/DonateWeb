<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            "title" => "Charity",
            "charities" => Charity::latest()->limit(6)->get()
        ]);
    }
}
