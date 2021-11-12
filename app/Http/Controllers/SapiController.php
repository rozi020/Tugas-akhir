<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Sapi;
use App\Models\SapiKeluar;
use App\Models\HasilPerah;
use App\Models\History;
use DB, Alert, Validator, DataTables;

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

    public function updateDaftarSapi(Request $request, $id){

        $sapi = Sapi::find($id);
        $sapi->umur = $request->edit_umur;
        $sapi->berat = $request->edit_berat;
        $sapi->jenis = $request->edit_jenis;
        $sapi->status = $request->edit_status;
        $sapi->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Mengedit Data Sapi dengan Kode : '".$request->edit_kode."' pada tabel Daftar Sapi";
        $history->save();

        return response([
            'message' => 'update successfully'
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
            ->editColumn('updated_at', function($sapi){
                return date('H:i:s | d-m-Y', strtotime($sapi->updated_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-kode="'.$row->kode.'" data-umur="'.$row->umur.'" data-berat="'.$row->berat.'" data-jenis="'.$row->jenis.'" data-status="'.$row->status.'" class="btn btn-outline-success btn-edit-daftarsapi">
                <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" data-id="'.$row->id.'" data-kode="'.$row->kode.'" class="btn btn-outline-danger btn-delete-daftarsapi">
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
        Sapi::where('kode',$request->kode)->first()->delete();

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
                </a>
                <a href="javascript:void(0)" data-id="'.$row->id.'" data-kode="'.$row->kode.'" class="btn btn-outline-danger btn-delete-sapikeluar">
                    <i class="fas fa-trash"></i>
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

    public function destroySapiKeluar($id){
        $sapi = SapiKeluar::find($id);
        $sapi->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Data Sapi Keluar.";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    // Hasil Perah
    public function hasilperah(){
        $data_sapi = Sapi::select('id','kode')->get();
        $counter = HasilPerah::count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('HasilPerah.index', compact('data_sapi','counter'));
    }

    public function storeHasilPerah(Request $request){

        $messages = array(
            'id_sapi.required' => 'Kode sapi tidak boleh kosong!',
            'jumlah_perah.required' => 'Umur sapi tidak boleh kosong!',
            'tanggal_perah.required' => 'Berat sapi tidak boleh kosong!'
        );

        $validator = Validator::make($request->all(),[
            'id_sapi' => 'required',
            'jumlah_perah' => 'required',
            'tanggal_perah' => 'required'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $hasil = new HasilPerah;
        $hasil->id_sapi = $request->id_sapi;
        $hasil->jumlah_perah = $request->jumlah_perah;
        $hasil->id_user = auth()->user()->id;
        $hasil->tanggal_perah = $request->tanggal_perah;
        $hasil->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Data Pemerahan pada sapi";
        $history->save();

        return response([
            'message' => 'sukses',
        ]);
    }

    public function updateHasilPerah(Request $request, $id){

        $hasil = HasilPerah::find($id);
        $hasil->id_sapi = $request->edit_id_sapi;
        $hasil->jumlah_perah = $request->edit_jumlah;
        $hasil->id_user = auth()->user()->id;
        $hasil->tanggal_perah = $request->edit_tanggal;
        $hasil->save();

        $sapi =DB::table('hasil_perah')
                ->join('sapi', 'hasil_perah.id_sapi', '=', 'sapi.id')
                ->select('sapi.kode as kode')
                ->where('hasil_perah.id',$id)
                ->first();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Mengedit Data Pemerahan pada sapi dengan kode : '".$sapi->kode."'";
        $history->save();

        return response([
            'message' => 'update successfully'
        ]);
    }

    public function destroyHasilPerah($id){
        $hasil = HasilPerah::find($id);
        $hasil->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Data Perah.";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadTableHasilPerah(){
        return view('DataTables.Sapi.HasilPerahDatatable');
    }

    public function LoadDataHasilPerah(){
        $hasil = HasilPerah::orderBy('id','desc')->get();
        $hasil =DB::table('hasil_perah')
                ->join('sapi', 'hasil_perah.id_sapi', '=', 'sapi.id')
                ->join('users', 'hasil_perah.id_user', '=', 'users.id')
                ->select('hasil_perah.*','sapi.kode as kode_sapi','users.name as nama_user')
                ->orderBy('hasil_perah.id','desc')
                ->get();

            return Datatables::of($hasil)->addIndexColumn()
            ->editColumn('tanggal_perah', function($hasil){
                return date('d-m-Y', strtotime($hasil->tanggal_perah));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-ids="'.$row->id_sapi.'" data-jumlah="'.$row->jumlah_perah.'" data-tanggal="'.$row->tanggal_perah.'" class="btn btn-outline-success btn-edit-hasilperah">
                <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" data-id="'.$row->id.'" data-kode="'.$row->kode_sapi.'" class="btn btn-outline-danger btn-delete-hasilperah">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }
    
}
