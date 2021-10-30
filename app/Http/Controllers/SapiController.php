<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sapi;
use App\Models\History;
use Alert, File, Validator, DataTables;

class SapiController extends Controller
{
    // Daftar Sapi
    public function daftarsapi(){
        $counter = Sapi::count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Sapi.daftarsapi', compact('counter'));
    }

    public function storeDaftarSapi(Request $request){

        $messages = array(
            'kode.required' => 'Kode sapi tidak boleh kosong!',
            'kode.unique' => 'Kode sapi sudah terpakai!',
            'umur.required' => 'Umur sapi tidak boleh kosong!',
            'berat.required' => 'Berat sapi tidak boleh kosong!',
            'jenis.required' => 'Jenis sapi tidak boleh kosong!',
            'status.required' => 'Status sapi tidak boleh kosong!'
        );

        $validator = Validator::make($request->all(),[
            'kode' => 'required|unique:sapi,kode',
            'umur' => 'required',
            'berat' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'foto' => 'image|nullable'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        if($request->hasFile('foto')){
            $upFoto = 'Sapi-'.$request->kode.'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->store('assets/img/sapi/', $upFoto);

            $sapi = new Sapi;
            $sapi->kode = $request->kode;
            $sapi->umur = $request->umur;
            $sapi->berat = $request->berat;
            $sapi->jenis = $request->jenis;
            $sapi->status = $request->status;
            $sapi->foto = $upFoto;
            $sapi->save();
        }else{
            $sapi = new Sapi;
            $sapi->kode = $request->kode;
            $sapi->umur = $request->umur;
            $sapi->berat = $request->berat;
            $sapi->jenis = $request->jenis;
            $sapi->status = $request->status;
            $sapi->save();
        }

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Data Sapi dengan Kode : '".$request->kode."'";
        $history->save();

        return response([
            'message' => 'sukses',
        ]);
    }

    public function destroyDaftarSapi($id){
        // Hapus Foto Sapi
        $foto = Sapi::select('foto')->where('id', $id)->get()->first();
        File::delete('assets/img/sapi/'.$foto);

        $sapi = Sapi::find($id);
        $sapi->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Data Sapi dengan Kode : '".$sapi->kode."'.";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadTableDaftarSapi(){
        return view('DataTables.Sapi.DaftarSapiDatatable');
    }

    public function LoadDataDaftarSapi(){
        $sapi = Sapi::orderBy('id','desc')->get();

            return Datatables::of($sapi)->addIndexColumn()
            ->editColumn('created_at', function($sapi){
                return date('H:i:s | d-m-Y', strtotime($sapi->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-kode="'.$row->kode.'" class="btn btn-outline-danger btn-delete-daftarsapi">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }

    // Sapi Keluar
    public function sapimasuk(){
        return view('Sapi.sapimasuk');
    }

    public function sapikeluar(){
        return view('Sapi.sapikeluar');
    }

    public function hasilperah(){
        return view('HasilPerah.index');
    }
    
}
