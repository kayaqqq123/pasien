<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipeDokter;


class TipeDokterController extends Controller
{
    public function index()
    {
        $tipe_dokter = TipeDokter::orderBy('created_at', 'DESC')->paginate(10);
        return view('tipe_dokter.index', compact('tipe_dokter'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tipe_dokter' => 'required|string|max:50',
        ]);

        try {
            $tipe_dokter = TipeDokter::firstOrCreate([
                'tipe_dokter' => $request->tipe_dokter
            ]);
            return redirect()->back()->with(['success' => 'Tipe Dokter' . $tipe_dokter->tipe_dokter . 'Ditambahkan']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
    }

    public function edit($id)
    {
    $tipe_dokter = TipeDokter::findOrFail($id);
    return view('tipe_dokter.edit', compact('tipe_dokter'));
    }

    public function update(Request $request, $id)
    {
    //validasi form
    $this->validate($request, [
        'tipe_dokter' => 'required|string|max:50'
    ]);
    try {
        $tipe_dokter = TipeDokter::findOrFail($id);
        $tipe_dokter->update([
            'tipe_dokter' =>$request->tipe_dokter
        ]);
        return redirect(route('tipe_dokter.index'))->with(['success' => 'Tipe Dokter:' . $tipe_dokter->tipe_dokter . 'Diupdate']);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
    $tipe_dokter = TipeDokter::findOrFail($id);
    $tipe_dokter->delete();
    return redirect()->back()->with(['success' => 'Tipe Dokter: ' . $tipe_dokter->tipe_dokter . ' Telah Dihapus']);
    }
}
