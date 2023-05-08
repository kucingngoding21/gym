<?php

namespace App\Http\Controllers;

use App\Models\Instruktur;
use App\Models\Member;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Member::join('users','users.id','=','members.id_user')->get();
        return view('backend.member.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'email|required|min:4|max:50|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data = new User();
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->last_name = $request->last_name;
        $data->gender = $request->gender;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->role_name = $request->role_name;
        $data->active_status = $request->active_status;

        if ($request->photo) {
            $this->validate($request, [
                'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('photo');
            $image_name = time() . '_' . $file->getClientOriginalName();

            $img = Image::make($file->getRealPath());
            $img->resize(550, 550, function ($constraint) {
                $constraint->aspectRatio();
            })->save('img/thumbnail/' . $image_name);

            $file->move('users', $image_name);

            $data->photo = $image_name;
        }
        $data->save();
        $data->roles()->attach(Role::where('name', $request->role_name)->first());

        $date = \Carbon\Carbon::parse($data->created_at);
        $year = $date->format('y');
        $month = $date->format('m');

        $member = new Member();
        $member->id_user = $data->id;
        $member->format_id_member =$year.$month.$data->id;
        $member->alamat = $request->alamat;
        $member->no_telpon = $request->no_telpon;
        $member->save();
        return redirect(route('index.member'))->with('message','Data member Telah Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Member::join('users','users.id','=','members.id_user')->where('members.id_user', $id)->first();
//        dd($data);
        return view('backend.member.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Member::join('users','users.id','=','members.id_user')->where('members.id_user', $id)->first();
        return view('backend.member.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->email = $request->email;
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->last_name = $request->last_name;
        $data->gender = $request->gender;
        $data->active_status = $request->active_status;
        if($request->password)
        {
            $data->password = bcrypt($request->password);
        }
        $data->role_name = $request->role_name;
        if ($request->photo) {
            $this->validate($request, [
                'photo' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('photo');
            $image_name = time() . '_' . $file->getClientOriginalName();

            if ($data->photo) {
                if (File::exists(public_path() .'/users/' . $data->photo)) {
                    unlink(public_path() . '/users/' . $data->photo);
                }

                if (File::exists('/users/thumbnail/' . $data->photo)) {
                    unlink(public_path() . '/users/thumbnail/' . $data->photo);
                }
            }

            $img = Image::make($file->getRealPath());
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save('users/thumbnail/' . $image_name);

            $file->move('users', $image_name);

            $data->photo = $image_name;
        }
        $data->save();

        $member = Member::where('id_user', $id)->first();
        $member->id_user = $data->id;
        $member->alamat = $request->alamat;
        $member->no_telpon = $request->no_telpon;
        $member->save();

        return redirect(route('index.member'))->with('message','Data member Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();

        $member = Member::where('id_user', $id)->first();
        $member->delete();

        return redirect(route('index.member'))->with('message','Data Member Telah Dihapus');
    }
}
