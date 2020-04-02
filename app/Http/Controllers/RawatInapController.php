<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perawat;
use App\RawatInap;
use App\StatusPengobatan;

class RawatInapController extends Controller
{
    public function index()
    {
        $rawat = RawatInap::with('status_pengobatan')->orderBy('created_at', 'DESC')->paginate(10);
        $rawat = RawatInap::with('perawat')->orderBy('created_at', 'DESC')->paginate(10);
        return view('rawat-inap.index', compact('rawat'));
    }

    public function create()
    {
    $perawat = Perawat::orderBy('nama', 'ASC')->get();
    $status_pengobatan = StatusPengobatan::orderBy('status', 'ASC')->get();
    return view('rawat-inap.create', compact('perawat', 'status_pengobatan'));
    }

    public function store(Request $request)
    {
    //validasi data
    $this->validate($request, [
        'kamar' => 'required|string|max:100',
        'id_perawat' => 'required|exists:perawats,id',
        'status_pengobatan_id' => 'required|exists:status_pengobatans,id'
    ]);
    try {
        $rawat = RawatInap::firstOrCreate([
                    'kamar' => $request->kamar,
                    'id_perawat' => $request->id_perawat,
                    'status_pengobatan_id' => $request->status_pengobatan_id
        ]);
        return redirect(route('rawat-inap.index'))
        ->with(['success' => '<strong>' . $rawat->kamar . '</strong> Ditambahkan']);
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
        $status_pengobatan = StatusPengobatan::orderBy('status', 'ASC')->get();
        return view('rawat-inap.edit', compact('rawat', 'perawat', 'status_pengobatan'));
    }

    public function update(Request $request, $id)
    {
    //validasi form
    $this->validate($request, [
        'kamar' => 'required|string|max:50',
        'id_perawat' => 'required|exists:perawats,id',
        'status_pengobatan_id' => 'required|exists:status_pengobatans,id'
    ]);
    try {
        $rawat = RawatInap::findOrFail($id);
        $rawat->update([
            'kamar' =>$request->kamar,
            'id_perawat' =>$request->id_perawat,
            'status_pengobatan_id' => $request->status_pengobatan_id
        ]);
        return redirect(route('rawat-inap.index'))->with(['success' => 'Rawat Inap:' . $rawat->kamar . 'Diupdate']);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
        {
            $rawat = RawatInap::findOrFail($id);
            $rawat->delete();
            return redirect()->back()->with(['success' => '<strong>' . $rawat->kamar . '</strong> Telah Dihapus!']);
        }

    public function select_inap(Request $id)
        {
        $rawat = RawatInap::where('status_pengobatan_id', $id->status_pengobatan)->get()->pluck('id','kamar');
        return response()->json($rawat);
        }

}
