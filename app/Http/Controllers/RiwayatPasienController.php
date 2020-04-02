<?php

namespace App\Http\Controllers;
use App\Pasien;
use App\Dokter;
use App\StatusPengobatan;
use App\RawatInap;
use App\RiwayatPasien;
use Illuminate\Http\Request;

class RiwayatPasienController extends Controller
{
    public function index() {
    $rawatPasien = RiwayatPasien::with('pasien')->orderBy('created_at', 'DESC')->paginate(10);
    $rawatPasien = RiwayatPasien::with('dokter')->orderBy('created_at', 'DESC')->paginate(10);
    $rawatPasien = RiwayatPasien::with('statuspengobatan')->orderBy('created_at', 'DESC')->paginate(10);
    $rawatPasien = RiwayatPasien::with('rawatinap')->orderBy('created_at', 'DESC')->paginate(10);
    return view('riwayat-pasien.index', compact('rawatPasien'));
    }

    public function create()
    {
    $pasien = Pasien::orderBy('nama', 'ASC')->get();
    $dokter = Dokter::orderBy('nama', 'ASC')->get();
    $status_pengobatan = StatusPengobatan::orderBy('status', 'ASC')->get();
    $rawat = RawatInap::orderBy('kamar', 'ASC')->get();
    return view('riwayat-pasien.create', compact('pasien', 'dokter', 'status_pengobatan', 'rawat'));
    }

    public function store(Request $request)
    {
    //validasi data
    $this->validate($request, [
        'pasien_id' => 'required|exists:pasiens,id',
        'dokter_id' => 'required|exists:dokters,id',
        'status_pengobatan_id' => 'required|exists:status_pengobatans,id',
        'diagnosa_penyakit' => 'required|string|max:100',
    ]);
    try {
        $rawatPasien = RiwayatPasien::create([
                    'pasien_id' => $request->pasien_id,
                    'dokter_id' => $request->dokter_id,
                    'status_pengobatan_id' => $request->status_pengobatan_id,
                    'diagnosa_penyakit' => $request->diagnosa_penyakit,
                    'rawat_inap_id' => $request->rawat_inap_id
        ]);




        return redirect(route('riwayat-pasien.index'))
        ->with(['success' => '<strong>' . $rawatPasien->pasien_id . '</strong> Ditambahkan']);
    } catch (\Exception $e) {
    return back()
        ->with(['error' => $e->getMessage()]);
    }
    }

    public function edit($id)
    {
        //query select berdasarkan id
        $rawatPasien = RiwayatPasien::findOrFail($id);
        $pasien = Pasien::orderBy('nama', 'ASC')->get();
        $dokter = Dokter::orderBy('nama', 'ASC')->get();
        $status_pengobatan = StatusPengobatan::orderBy('status', 'ASC')->get();
        $rawat = RawatInap::orderBy('kamar', 'ASC')->get();
        return view('riwayat-pasien.edit', compact('rawatPasien', 'pasien', 'dokter', 'status_pengobatan', 'rawat'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'status_pengobatan_id' => 'required|exists:status_pengobatans,id',
            'diagnosa_penyakit' => 'required|string|max:100',
            'rawat_inap_id' => 'required|exists:rawat_inaps,id'
            ]);
            try {
                $rawatPasien = RiwayatPasien::findOrFail($id);
                $rawatPasien->update([
                    'pasien_id' => $request->pasien_id,
                    'dokter_id' => $request->dokter_id,
                    'status_pengobatan_id' => $request->status_pengobatan_id,
                    'diagnosa_penyakit' => $request->diagnosa_penyakit,
                    'rawat_inap_id' => $request->rawat_inap_id
                    ]);
                    return redirect(route('riwayat-pasien.index'))->with(['success' => 'Riwayat Pasien:' . $rawatPasien->pasien_id . 'Diupdate']);
                } catch (\Exception $e) {
                    return redirect()->back()->with(['error' => $e->getMessage()]);
                }
            }


        public function destroy($id)
        {
                $rawatPasien = RiwayatPasien::findOrFail($id);
                $rawatPasien->delete();
                return redirect()->back()->with(['success' => '<strong>' . $rawatPasien->pasien_id . '</strong> Telah Dihapus!']);
        }

        public function select_inap(Request $id)
        {
            $rawatPasien = RiwayatPasien::where('status_pengobatan_id', $id->status_pengobatan)->get()->pluck('kamar');
            return response()->json($rawatPasien);
        }
}
