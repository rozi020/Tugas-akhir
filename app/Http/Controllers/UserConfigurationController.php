<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\History;
use App\Models\User;
use Alert, Validator, File;

class UserConfigurationController extends Controller
{
    public function profile(){
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }
        return view('UserConfiguration.profile');
    }

    public function updateProfile(Request $request){
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $error = array(
            'username.required' => 'Kolom Username tidak boleh kosong!',
            'username.unique' => 'Username sudah digunakan!',
            'avatar.mimes' => 'Mohon gunakan format gambar : .jpeg | .jpg | .png',
            'avatar.max' => 'Ukuran gambar anda melebihi 4MB!',
            'address.required' => 'Kolom Alamat tidak boleh kosong!'
        );

        $validateData = $request->validate([
            'username' => 'required|unique:users,username,'.$user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg|max:4096',
            'address' => 'required'
        ],$error);
        if( $request->avatar){
            $upAvatar = 'user-'.date('dmYhis').'.'.$request->avatar->getClientOriginalExtension();
            $request->avatar->move('assets/img/avatar/',$upAvatar);
            File::delete('assets/img/avatar/'.auth()->user()->avatar);

            $user->avatar = $upAvatar;
        }

        $history = History::where('nama',$user->name)->get();
        if($history){
            History::where('nama','=',auth()->user()->name)->update(array('nama' => $request->name));
        }
        $user->name = $request->name;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = $request->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->username."' merubah profilenya.";
        $history->save();

        return redirect('/dashboard')->with('success','Profile Berhasil diubah !');
    }

    public function password(){
        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }
        return view('UserConfiguration.password');
    }

    public function updatePassword(Request $request){
        $error = array(
            'oldPassword.required' => 'Password Lama tidak boleh kosong!',
            'newPassword.required' => 'Password Baru tidak boleh kosong!',
            'newPassword.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'confirmPassword.min' => 'Password tidak boleh kurang dari 8 karakter!',
            'confirmPassword.same' => 'Konfirmasi password baru anda tidak cocok !'
        );

        $validator = Validator::make($request->all(),[
            'oldPassword' => ['required', new MatchOldPassword],
            'newPassword' => ['required|min:8'],
            'confirmPassword' => ['min:8|same:newPassword'],
        ],$error);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->newPassword)]);

        // Writing History
        $history = new History;
        $history->user_id = auth()->user()->id;
        $history->nama = auth()->user()->name;
        $history->aksi = "Edit";
        $history->keterangan = "Akun '".auth()->user()->username."' merubah passwordnya.";
        $history->save();

        return redirect('/dashboard')->with('success','Password berhasil diperbarui !');
    }

    public function activity(){
        $activity = History::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();

        if(session('success')){
            Alert::success(session('success'));
        }elseif(session('error')){
            Alert::error(session('error'));
        }

        return view('UserConfiguration.activity', compact('activity'));
    }
}
