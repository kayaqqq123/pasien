<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokter;
use App\TipeDokter;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::with('tipe_dokter')->orderBy('created_at', 'DESC')->paginate(10);
        return view('dokter.index', compact('dokter'));
    }

    public function create()
    {
    $tipe_dokter = TipeDokter::orderBy('tipe_dokter', 'ASC')->get();
    return view('dokter.create', compact('tipe_dokter'));
    }

    public function store(Request $request)
    {
    //validasi data
    $this->validate($request, [
        'nama' => 'required|string|max:100',
        'tipe_dokter_id' => 'required|exists:tipe_dokters,id',
        'jenis_kelamin' => 'required|string|max:100'
    ]);
    try {
        $dokter = Dokter::firstOrCreate([
                    'nama' => $request->nama,
                    'tipe_dokter_id' => $request->tipe_dokter_id,
                    'jenis_kelamin' => $request->jenis_kelamin
        ]);
        return redirect(route('dokter.index'))
        ->with(['success' => '<strong>' . $dokter->nama . '</strong> Ditambahkan']);
    } catch (\Exception $e) {
    return redirect()->back()
        ->with(['error' => $e->getMessage()]);
    }
    }

    public function edit($id)
    {
        //query select berdasarkan id
        $dokter = Dokter::findOrFail($id);
        $tipe_dokter = TipeDokter::orderBy('tipe_dokter', 'ASC')->get();
        return view('dokter.edit', compact('dokter', 'tipe_dokter'));
    }

    public function update(Request $request, $id)
    {
    //validasi form
    $this->validate($request, [
        'nama' => 'required|string|max:50',
        'tipe_dokter_id' => 'required|exists:tipe_dokters,id',
        'jenis_kelamin' => 'required|string|max:50'
    ]);
    try {
        $dokter = Dokter::findOrFail($id);
        $dokter->update([
            'nama' =>$request->nama,
            'tipe_dokter_id' =>$request->tipe_dokter_id,
            'jenis_kelamin' =>$request->jenis_kelamin
        ]);
        return redirect(route('dokter.index'))->with(['success' => 'Dokter:' . $dokter->nama . 'Diupdate']);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        return redirect()->back()->with(['success' => '<strong>' . $dokter->nama . '</strong> Telah Dihapus!']);
    }
}
