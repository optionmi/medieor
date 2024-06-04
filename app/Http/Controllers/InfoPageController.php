<?php

namespace App\Http\Controllers;

use App\Models\InfoPage;
use Illuminate\Http\Request;

class InfoPageController extends Controller
{
    public function aboutus()
    {
        $data = InfoPage::where('title', 'About Us')->first();
        return view('about-us', compact('data'));
    }

    public function ourpurpose()
    {
        $data = InfoPage::where('title', 'Our Purpose')->first();
        return view('our-purpose', compact('data'));
    }

    public function contactus()
    {
        $data = InfoPage::where('title', 'Contact Us')->first();
        $data->emails = explode(' ', $data->section2);
        $data->phones = explode(' ', $data->section3);
        return view('contact-us', compact('data'));
    }
}
