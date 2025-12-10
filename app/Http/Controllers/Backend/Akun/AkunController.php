<?php

namespace App\Http\Controllers\Backend\Akun;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AkunController extends Controller
{
    public function show()
    {
        $akuns = User::orderByRaw('id = ? DESC', [Auth::id()])
             ->orderByRaw("role = 'admin' DESC")
             ->orderBy('name')
             ->get();

        return view('backend.akun.akun', compact('akuns'));
    }

    public function create()
    {
        return view('backend.akun.akun-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'pass_konfirm' => 'required|same:password',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'pass_hint' => encrypt($request->password),
        ]);

        Alert::toast('Data berhasil ditambah', 'success')->autoClose(5000);
        return redirect()->route('backend.akun');

    }

    public function edit(string $id)
    {
        $akun = User::findOrfail($id);
        return view('backend.akun.akun-edit', compact('akun'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8',
            'pass_konfirm' => 'required|same:password',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'pass_hint' => encrypt($request->password),
        ]);

        Alert::toast('Data berhasil diubah', 'success')->autoClose(5000);
        return redirect()->route('backend.akun');
    }

    public function destroy(string $id)
    {
        if($id){
            User::destroy($id);
            Alert::success('Terhapus', 'Warta berhasil dihapus');
        }

        return redirect()->route('backend.akun');
    }


}
