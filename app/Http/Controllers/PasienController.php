<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;


class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
            return view('pasien.index', compact('pasien'));
    }

    public function store(Request $request)
    {
        $file = $request->file('foto');
        $directory = 'foto';

        $pasien = new Pasien($request->all());

        if($request->hasFile('foto')) {
            $fileName = time().$file->getClientOriginalName();
            $file->move($directory, $fileName);
            $pasien->foto = $fileName;
        }

        $pasien->save();

        return redirect()->route('pasien.index');
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.details', compact('pasien'));
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $file = $request->file('foto');
        $directory = 'foto';

        $pasien->update($request->all());

        if($request->hasFile('foto')) {
            $fileName = time().$file->getClientOriginalName();
            $file->move($directory, $fileName);
            $pasien->foto = $fileName;
        }

        $pasien->save();

        return redirect()->route('pasien.index');
    }

    public function destroy($id)
    {
        $data_pasien = Pasien::findOrFail($id);
        $data_pasien->delete();
        return redirect()->route('pasien.index');
    }
}
