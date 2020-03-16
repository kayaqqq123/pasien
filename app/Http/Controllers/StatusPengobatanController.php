<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusPengobatan;

class StatusPengobatanController extends Controller
{
    public function index()
    {
        $status_pengobatan = StatusPengobatan::orderBy('created_at', 'DESC')->paginate(10);
        return view('status-pengobatan.index', compact('status_pengobatan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|string|max:50',
        ]);

        try {
            $status_pengobatan = StatusPengobatan::firstOrCreate([
                'status' => $request->status
            ]);
            return redirect()->back()->with(['success' => 'Status Pengobatan' . $status_pengobatan->status . 'Ditambahkan']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
    }

    public function edit($id)
    {
    $status_pengobatan = StatusPengobatan::findOrFail($id);
    return view('status-pengobatan.edit', compact('status_pengobatan'));
    }

    public function update(Request $request, $id)
    {
    //validasi form
    $this->validate($request, [
        'status' => 'required|string|max:50'
    ]);
    try {
        $status_pengobatan = StatusPengobatan::findOrFail($id);
        $status_pengobatan->update([
            'status' =>$request->status
        ]);
        return redirect(route('status-pengobatan.index'))->with(['success' => 'Status Pengobatan:' . $status_pengobatan->status . 'Diupdate']);
        } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
    $status_pengobatan = StatusPengobatan::findOrFail($id);
    $status_pengobatan->delete();
    return redirect()->back()->with(['success' => 'Tipe Dokter: ' . $status_pengobatan->status . ' Telah Dihapus']);
    }
}
