<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Perawat;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index()
    {
        $pwrt = Perawat::with('dokter')->orderBy('created_at', 'DESC')->paginate(10);
        return view('data-perawat.index', compact('pwrt'));
    }

    public function create()
    {
    $dokter = Dokter::orderBy('nama', 'ASC')->get();
    return view('data-perawat.create', compact('dokter'));
    }

    public function store(Request $request)
    {
    //validasi data
    $this->validate($request, [
        'nama' => 'required|string|max:100',
        'dokter_id' => 'required|exists:dokters,id',
        'jenis_kelamin' => 'required|string|max:100',
    ]);
    try {
        $pwrt = Perawat::firstOrCreate([
                    'nama' => $request->nama,
                    'dokter_id' => $request->dokter_id,
                    'jenis_kelamin' => $request->jenis_kelamin
        ]);
        return redirect(route('data-perawat.index'))
        ->with(['success' => '<strong>' . $pwrt->nama . '</strong> Ditambahkan']);
    } catch (\Exception $e) {
    return back()
        ->with(['error' => $e->getMessage()]);
    }
    }

    public function edit($id)
    {
        //query select berdasarkan id
        $pwrt = Perawat::findOrFail($id);
        $dokter = Dokter::orderBy('nama', 'ASC')->get();
        return view('data-perawat.edit', compact('pwrt', 'dokter'));
    }

    public function update(Request $request, $id)
    {
    //validasi form
    $this->validate($request, [
        'nama' => 'required|string|max:50',
        'dokter_id' => 'required|exists:dokters,id',
        'jenis_kelamin' => 'required|string|max:50'
    ]);
    try {
        $pwrt = Perawat::findOrFail($id);
        $pwrt->update([
            'nama' =>$request->nama,
            'dokter_id' =>$request->dokter_id,
            'jenis_kelamin' =>$request->jenis_kelamin
        ]);
        return redirect(route('data-perawat.index'))->with(['success' => 'Perawat:' . $pwrt->nama . 'Diupdate']);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function destroy($id)
    {
        $pwrt = Perawat::findOrFail($id);
        $pwrt->delete();
        return redirect()->back()->with(['success' => '<strong>' . $pwrt->nama . '</strong> Telah Dihapus!']);
    }
}
