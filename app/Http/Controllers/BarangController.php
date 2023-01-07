<?php

namespace App\Http\Controllers;

use App\Helpers\HttpClient;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    function index()
    {
        $responseData = HttpClient::fetch(
            "GET",
            "https://api-supplychainmeuble.fly.dev/api/barang"
        );
        $data = $responseData["data"];

        $responseData = HttpClient::fetch(
            "GET",
            "https://api-supplychainmeuble.fly.dev/api/kategori"
        );
        $kategori = $responseData["data"];

        $responseData = HttpClient::fetch(
            "GET",
            "https://api-supplychainmeuble.fly.dev/api/material"
        );
        $material = $responseData["data"];

        $responseData = HttpClient::fetch(
            "GET",
            "https://api-supplychainmeuble.fly.dev/api/barangrecycle"
        );
        $recycle = $responseData["data"];
        
        // dd($data);
        return view('barang.list', [
            "data" => $data,
            "kategori" => $kategori,
            "material" => $material,
            "recycle" => $recycle,
            "page" => 'barang'
        ]);
    }

    function detail($id)
    {
        $linknya = "https://api-supplychainmeuble.fly.dev/api/barang/" . $id;
        $responseData = HttpClient::fetch(
            "GET",
            $linknya
        );
        $data = $responseData["data"];
        
        if($responseData['status'] == false){
            return redirect()->route('barang.index');
        }
        
        return view('barang.detail', [
            "data" => $data,
            "page" => 'barang'
        ]);
    }

    function create()
    {
        return view('barang.create',[
        "page" => 'barang'
    ]);
    }

    function store(Request $request)
    {
        $request->validate([
            "nama_barang" => 'required',
            "kategori" => 'required|integer',
            "material" => 'required|integer',
            "panjang" => 'required|integer',
            "lebar" => 'required|integer',
            "tinggi" => 'required|integer',
            "gambar" => 'required|mimes:jpg,jpeg,png',
        ]);
        $payload = [
            "nama_barang" => $request->input("nama_barang"),
            "deskripsi_barang" => $request->input("deskripsi_barang"),
            "id_kategori" => $request->input("kategori"),
            "id_material" => $request->input("material"),
            "panjang" => $request->input("panjang"),
            "lebar" => $request->input("lebar"),
            "tinggi" => $request->input("tinggi"),
        ];

        $file = [
            "gambar" => $request->file('gambar')
        ];

        $barang = HttpClient::fetch(
            "POST",
            "https://api-supplychainmeuble.fly.dev/api/barang/",
            $payload,
            $file
        );
        // dd($barang,$barang['message'],$payload,$file);

        return redirect()->back()->with(['success' => $barang['message']]);
    }
    function edit($id)
    {
        $linknya = "https://api-supplychainmeuble.fly.dev/api/barang/" . $id;
        $responseData = HttpClient::fetch(
            "GET",
            $linknya
        );
        $data = $responseData["data"];

        if($responseData['status'] == false){
            return redirect()->route('barang.index');
        }

        return view('barang.edit', [
            "data" => $data,
            "page" => 'barang'
        ]);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            "nama_barang" => 'required',
            "kategori" => 'required|integer',
            "material" => 'required|integer',
            "panjang" => 'required|integer',
            "lebar" => 'required|integer',
            "tinggi" => 'required|integer'
        ]);
        $payload = [
            "nama_barang" => $request->input("nama_barang"),
            "deskripsi_barang" => $request->input("deskripsi_barang"),
            "id_kategori" => $request->input("kategori"),
            "id_material" => $request->input("material"),
            "panjang" => $request->input("panjang"),
            "lebar" => $request->input("lebar"),
            "tinggi" => $request->input("tinggi"),
        ];
        $file = [];

        if ($request->file('gambar')) {
            $request->validate([
                "gambar" => 'mimes:jpg,jpeg,png',
            ]); 
            $file = [
                "gambar" => $request->file('gambar')
            ];
        }
        // dd($file);

        $barang = HttpClient::fetch(
            "POST",
            "https://api-supplychainmeuble.fly.dev/api/barang/" . $id . "/edit",
            $payload,
            $file
        );

        return redirect()->back()->with(['success' => 'Data terupdate']);
    } // untuk update data

    function destroy($id)
    {
        HttpClient::fetch(
            "POST",
            "https://api-supplychainmeuble.fly.dev/api/barang/" . $id . "/delete",
        );

        return redirect()->back()->with(['success' => 'Data terhapus']);
    } // menghapus data
    function recycle($id)
    {
        $anjay = HttpClient::fetch(
            "POST",
            "https://api-supplychainmeuble.fly.dev/api/barang/" . $id . "/recycle",
        );

        return redirect()->back()->with(['edotensei' => $anjay['message']]);
    } // menghapus data

}
