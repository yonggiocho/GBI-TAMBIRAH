<?php

namespace App\Http\Controllers\Backend\Identitas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Identitas;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class IdentitasController extends Controller
{
    public function edit(){

        $identitas = Identitas::first();
        return view('backend.identitas.identitas-edit', compact('identitas'));

    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_website' => 'required|string|max:150',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:50',
            'email' => 'required|email',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,svg|max:1024',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'map' => 'nullable'
        ]);

        $identitas = Identitas::first();
        $storage = Storage::disk('public');

        if ($request->hasFile('logo')){

            if($identitas !== null && $storage->exists($identitas->logo)) {
                    $storage->delete($identitas->logo);
                }

                $logo = $request->file('logo');
                $filename = 'logo-img'.'.'.$logo->extension();
                $logoImg = $storage->putFileAs( 'logo', $logo, $filename);
                $validated['logo'] = $logoImg;
          }else{
                $validated['logo'] = $identitas->logo??'';
          }

         if ($request->hasFile('favicon')){

            if($identitas !== null && $storage->exists($identitas->favicon)) {
                    $storage->delete($identitas->favicon);
                }

                $favicon = $request->file('favicon');
                $filename = 'favicon-img'.'.'.$favicon->extension();
                $faviconImg = $storage->putFileAs( 'logo', $favicon, $filename);
                $validated['favicon'] = $faviconImg;
          }else{
                $validated['favicon'] = $identitas->favicon??'';
          }


             if ($identitas) {
                $identitas->update($validated);
            } else {
                Identitas::create($validated);
            }

        Alert::toast('Data berhasil diedit', 'success')->autoClose(5000);
        return redirect()->route('backend.identitas.edit');

    }
}
