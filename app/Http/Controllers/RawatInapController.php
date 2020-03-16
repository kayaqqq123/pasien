<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perawat;
use App\RawatInap;

class RawatInapController extends Controller
{
    public function index()
    {
        $rawat = RawatInap::with('perawat')->orderBy('created_at', 'DESC')->paginate(10);
        return view('rawat-inap.index', compact('rawat'));
    }

    public function create()
    {
    $perawat = Perawat::orderBy('nama', 'ASC')->get();
    return view('rawat-inap.create', compact('perawat'));
    }

    public function store(Request $request)
    {
    //validasi data
    $this->validate($request, [
        'no_kamar' => 'required|string|max:100',
        'id_perawat' => 'required|exists:perawats,id'
    ]);
    try {
        $rawat = RawatInap::firstOrCreate([
                    'no_kamar' => $request->no_kamar,
                    'id_perawat' => $request->id_perawat
        ]);
        return redirect(route('rawat-inap.index'))
        ->with(['success' => '<strong>' . $rawat->no_kamar . '</strong> Ditambahkan']);
    } catch (\Exception $e) {
    return back()
        ->with(['error' => $e->getMessage()]);
    }
    }

    public function edit($id)
    {
        //query select berdasarkan id
        $rawat = RawatInap::findOrFail($id);
        $perawat = Perawat::orderBy('nama', 'ASC')->get();
        return view('rawat-inap.edit', compact('rawat', 'perawat'));
    }

    public function update(Request $request, $id)
    {
    //validasi form
    $this->validate($request, [
        'no_kamar' => 'required|string|max:50',
        'id_perawat' => 'required|exists:perawats,id'
    ]);
    try {
        $rawat = RawatInap::findOrFail($id);
        $rawat->update([
            'no_kamar' =>$request->no_kamar,
            'perawat_id' =>$request->perawat_id,
        ]);
        return redirect(route('rawat-inap.index'))->with(['success' => 'Rawat Inap:' . $rawat->no_kamar . 'Diupdate']);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
        {
            $rawat = RawatInap::findOrFail($id);
            $rawat->delete();
            return redirect()->back()->with(['success' => '<strong>' . $rawat->no_kamar . '</strong> Telah Dihapus!']);
        }

}
