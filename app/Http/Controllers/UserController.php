<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\History;
use Validator;
use Alert;
use File;
use DataTables;

class UserController extends Controller
{
    public function pengurus(){
        $counter = User::where('id_role',2)->count();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('Pengurus.index', compact('counter'));
    }

    public function store(Request $request){

        $messages = array(
            'name.required' => 'Kolom nama tidak boleh kosong!',
            'username.required' => 'Kolom Email tidak boleh kosong!',
            'username.unique' => 'Email telah digunakan!',
            'password.required' => 'Kolom Password tidak boleh kosong!',
            'password.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'phone_number.required' => 'Kolom Nomor Telepon tidak boleh kosong!',
            'phone_number.unique' => 'Nomor Telepon telah digunakan!',
        );

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'phone_number' => 'required|unique:users,phone_number'
        ],$messages);

        if($validator->fails()){
            $error = $validator->errors()->first();
                return response()->json([
                    'error' => $error,
                ]);
        }

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->phone_number = $request->phone_number;
        $user->id_role = 2;
        $user->remember_token = '';
        $user->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Tambah";
        $history->keterangan = "Menambahkan Akun Pengurus dengan username : '".$request->username."'";
        $history->save();

        return response([
            'message' => 'sukses',
        ]);
    }

    public function updatePassword(Request $request, $id){

        $user = User::find($id);
        $user->password = bcrypt($request->edit_password);
        $user->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Mengubah password Pengurus pada Username : '".$user->username."'";
        $history->save();

        return response([
            'message' => 'update successfully'
        ]);
    }

    public function destroy($id){
        // Hapus Avatar
        $avatar = User::select('avatar')->where('id', $id)->get()->first();
        File::delete('assets/img/users/avatar/'.$avatar);

        $user = User::find($id);
        History::where('id',$user->id)->delete();
        $user->delete();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Hapus";
        $history->keterangan = "Menghapus Akun '".$user->username."' beserta Historynya";
        $history->save();

        return response([
            'message' => "delete sukses"
        ]);
    }

    public function LoadTablePengurus(){
        return view('DataTables.Pengurus.PengurusDatatable');
    }

    public function LoadDataPengurus(){
        $pengurus = User::where('id_role','2')->orderBy('id','desc')->get();

            return Datatables::of($pengurus)->addIndexColumn()
            ->editColumn('created_at', function($pengurus){
                return date('H:i:s | d-m-Y', strtotime($pengurus->created_at));
            })
            ->addColumn('aksi', function($row){
                $btn =  '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-outline-success btn-edit-password">
                <i class="fas fa-key"></i>
                </a>
                <a href="javascript:void(0)" data-id="'.$row->id.'" data-name="'.$row->name.'" class="btn btn-outline-danger btn-delete-pengurus">
                <i class="fas fa-trash"></i>
                </a>';
                return $btn;
         })
         ->rawColumns(['aksi'])
            ->make(true);
    }
}
