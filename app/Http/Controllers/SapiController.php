<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sapi;
use App\Models\SapiKeluar;
use App\Models\History;
use Alert, Validator, DataTables;

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
            'status' => 'required'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $sapi = new Sapi;
        $sapi->kode = $request->kode;
        $sapi->umur = $request->umur;
        $sapi->berat = $request->berat;
        $sapi->jenis = $request->jenis;
        $sapi->status = $request->status;
        $sapi->save();

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
    public function sapikeluar(){
        $data_sapi = Sapi::select('kode')->get();
        $counter = SapiKeluar::count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Sapi.sapikeluar', compact('data_sapi','counter'));
    }

    public function storeSapiKeluar(Request $request){
        $messages = array(
            'kode.required' => 'Kode sapi tidak boleh kosong!',
            'status.required' => 'Status sapi tidak boleh kosong!',
            'keterangan.required' => 'Keterangan sapi tidak boleh kosong!'
        );

        $validator = Validator::make($request->all(),[
            'kode' => 'required',
            'status' => 'required',
            'keterangan' => 'required'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $sapi_keluar = new SapiKeluar;
        $sapi_keluar->kode = $request->kode;
        $sapi_keluar->harga = $request->harga;
        $sapi_keluar->status = $request->status;
        $sapi_keluar->keterangan = $request->keterangan;
        $sapi_keluar->save();

        // Delete data sapi di tabel daftar
        $delete = Sapi::select('id')->where('kode',$request->kode)->first()->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Data Sapi dengan Kode : '".$request->kode."' kedalam tabel Sapi Keluar";
        $history->save();

        return response([
            'message' => 'sukses',
        ]);
    }

    public function LoadTableSapiKeluar(){
        return view('DataTables.Sapi.SapiKeluarDatatable');
    }

    public function LoadDataSapiKeluar(){
        $sapi = SapiKeluar::orderBy('id','desc')->get();

            return Datatables::of($sapi)->addIndexColumn()
            ->editColumn('created_at', function($sapi){
                return date('H:i:s | d-m-Y', strtotime($sapi->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-kode="'.$row->kode.'" data-harga="'.$row->harga.'" data-status="'.$row->status.'" data-keterangan="'.$row->keterangan.'" class="btn btn-outline-success btn-edit-sapikeluar">
                <i class="fas fa-pencil-alt"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }

    public function updateSapiKeluar(Request $request, $id){

        $sapi_keluar = SapiKeluar::find($id);
        $sapi_keluar->harga = $request->edit_harga;
        $sapi_keluar->status = $request->edit_status;
        $sapi_keluar->keterangan = $request->edit_keterangan;
        $sapi_keluar->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Mengedit Data Sapi dengan Kode : '".$request->edit_kode."'";
        $history->save();

        return response([
            'message' => 'update successfully'
        ]);
    }

    public function hasilperah(){
        return view('HasilPerah.index');
    }
    
}
