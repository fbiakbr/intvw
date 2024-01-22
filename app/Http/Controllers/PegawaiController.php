<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::all();

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $payload = $request->input();
        $data = [
            "nama" => $payload["nama"],
            "nip" => $payload["nip"],
            "jenis_kelamin" => $payload["jenis_kelamin"],
            "tanggal_lahir" => $payload["tanggal_lahir"],
            "jabatan" => $payload["jabatan"],
            "unit_kerja" => $payload["unit_kerja"]
        ];
        $result = Pegawai::create($data);

        return response()->json($result, 200);
    }

    public function destroy(Request $request, String $id)
    {
        Pegawai::destroy($id);

        return response()->json([], 200);
    }

    public function update(Request $request, String $id)
    {
        $payload = $request->input();

        $data = [
            "nama" => $payload["nama"],
            "nip" => $payload["nip"],
            "jenis_kelamin" => $payload["jenis_kelamin"],
            "tanggal_lahir" => $payload["tanggal_lahir"],
            "jabatan" => $payload["jabatan"],
            "unit_kerja" => $payload["unit_kerja"]
        ];

        // Find the record by ID
        $pegawai = Pegawai::find($id);

        // Check if the record exists
        if (!$pegawai) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Update the record
        $pegawai->update($data);

        return response()->json(['message' => 'Record updated successfully']);
    }
}
