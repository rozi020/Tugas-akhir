<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pengeluaran;
use App\Models\History;
use Alert, Validator, DataTables;

class PengeluaranController extends Controller
{
    public function index(){
        $counter = Pengeluaran::count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Pengeluaran.index', compact('counter'));
    }

    public function store(Request $request){

        $messages = array(
            'jumlah.required' => 'Jumlah Pengeluaran tidak boleh kosong!',
            'tanggal.required' => 'Tanggal tidak boleh kosong!',
            'keterangan.required' => 'Keterangan Pengeluaran tidak boleh kosong!'
        );

        $validator = Validator::make($request->all(),[
            'jumlah' => 'required',
            'tanggal' => 'required',
            'keterangan' => 'required'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $pengeluaran = new Pengeluaran;
        $pengeluaran->jumlah = $request->jumlah;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Data Pengeluaran";
        $history->save();

        return response([
            'message' => 'sukses',
        ]);
    }

    public function update(Request $request, $id){
        $messages = array(
            'edit_jumlah.required' => 'Jumlah Pengeluaran tidak boleh kosong!',
            'edit_tanggal.required' => 'Tanggal tidak boleh kosong!',
            'edit_keterangan.required' => 'Keterangan Pengeluaran tidak boleh kosong!'
        );

        $validator = Validator::make($request->all(),[
            'edit_jumlah' => 'required',
            'edit_tanggal' => 'required',
            'edit_keterangan' => 'required'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->jumlah = $request->edit_jumlah;
        $pengeluaran->tanggal = $request->edit_tanggal;
        $pengeluaran->keterangan = $request->edit_keterangan;
        $pengeluaran->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Mengedit Data Pengeluaran";
        $history->save();

        return response([
            'message' => 'update successfully'
        ]);
    }

    public function destroy($id){
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Data Pengeluaran";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadTablePengeluaran(){
        return view('DataTables.Pengeluaran.PengeluaranDatatable');
    }

    public function LoadDataPengeluaran(){
        $pengeluaran = Pengeluaran::orderBy('id','desc')->get();

            return Datatables::of($pengeluaran)->addIndexColumn()
            ->editColumn('tanggal', function($pengeluaran){
                return date('d-m-Y', strtotime($pengeluaran->tanggal));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" data-jumlah="'.$row->jumlah.'" data-tanggal="'.$row->tanggal.'" data-keterangan="'.$row->keterangan.'" class="btn btn-outline-success btn-edit-pengeluaran">
                <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-outline-danger btn-delete-pengeluaran">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }
}
