<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoPage;
use Illuminate\Http\Request;

class InfoPageController extends Controller
{
    public function show_aboutus()
    {
        $data = InfoPage::where('title', 'About Us')->first();
        return view('admin.info-pages.aboutus', compact('data'));
    }

    public function update(Request $request, InfoPage $infoPage)
    {
        $validator = validator()->make(request()->all(), [
            'img1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'img2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'img3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }

        $data = [
            'heading1' => request()->get('heading1'),
            'heading2' => request()->get('heading2'),
            'heading3' => request()->get('heading3'),
            'section1' => request()->get('section1'),
            'section2' => request()->get('section2'),
            'section3' => request()->get('section3'),
            'img_text1' => request()->get('img_text1'),
            'img_text2' => request()->get('img_text2'),
            'img_text3' => request()->get('img_text3'),
        ];

        if ($request->hasFile('img1')) {
            $randomString = \Illuminate\Support\Str::random(10);
            $extension = $request->file('img1')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;

            $path = $request->file('img1')->storeAs('info_pages_img', $filename, 'public_dir');
            $data['img1'] = $path;
        }

        if ($request->hasFile('img2')) {
            $randomString = \Illuminate\Support\Str::random(10);
            $extension = $request->file('img2')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;

            $path = $request->file('img2')->storeAs('info_pages_img', $filename, 'public_dir');
            $data['img2'] = $path;
        }

        if ($request->hasFile('img3')) {
            $randomString = \Illuminate\Support\Str::random(10);
            $extension = $request->file('img3')->getClientOriginalExtension();
            $filename = $randomString . '.' . $extension;

            $path = $request->file('img3')->storeAs('info_pages_img', $filename, 'public_dir');
            $data['img3'] = $path;
        }

        $infoPage->update($data);


        return response()->json(['error' => 0, 'message' => 'Page updated successfully']);
    }

    public function show_ourpurpose()
    {
        $data = InfoPage::where('title', 'Our Purpose')->first();
        return view('admin.info-pages.ourpurpose', compact('data'));
    }

    public function show_contactus()
    {
        return view('admin.info-pages.contactus');
    }
}
