<?php

namespace App\Http\Controllers\Backend\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
     public function edit(){

        $banner = Banner::first();
        return view('backend.banner.banner-edit', compact('banner'));

    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'bg_front' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'bg_page' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $banner = Banner::first();
        $storage = Storage::disk('public');

        if($request->hasFile('bg_front')){

            if($banner !== null && $storage->exists($banner->bg_front)) {
                    $storage->delete($banner->bg_front);
                }

                $bg_front = $request->file('bg_front');
                $filename = 'bg-front'.'.'.$bg_front->extension();
                $bgFrontName = $storage->putFileAs( 'banner', $bg_front, $filename);
                $validated['bg_front'] = $bgFrontName;
          }else{
                $validated['bg_front'] = $banner->bg_front??'';
          }

          //batas pengkondisian

         if($request->hasFile('bg_page')){

            if($banner !== null && $storage->exists($banner->bg_page)) {
                    $storage->delete($banner->bg_page);
                }

                $bg_page = $request->file('bg_page');
                $filename = 'bg-page'.'.'.$bg_page->extension();
                $bgPageName = $storage->putFileAs( 'banner', $bg_page, $filename);
                $validated['bg_page'] = $bgPageName;
          }else{
                $validated['bg_page'] = $banner->bg_page??'';
          }

          //batas pengkondisian


             if ($banner) {
                $banner->update($validated);
            } else {
                Banner::create($validated);
            }

        Alert::toast('Data berhasil diedit', 'success')->autoClose(5000);
        return redirect()->route('backend.banner.edit');

    }

}
