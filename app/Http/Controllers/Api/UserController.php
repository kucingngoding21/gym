<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Member;
use App\Models\BookingGym;
use App\Models\BookingKelas;
use App\Models\DaftarIjin;
use App\Models\Depositkelas;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $member = User::where('id',$user->id)->first();

            $success['token'] = $user->createToken('nApp')->accessToken;
            $user_encrypt['token'] = $user->createToken('token-name')->plainTextToken;
            $user_encrypt['data'] = $member;

            $member->save();

            return response()->json(['statusCode' => 200,'success' => true, 'message' => 'sudah masuk', 'data' => $user_encrypt], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function dataIjinInstrukturPribadi()
    {
        $data = DaftarIjin::where('instruktur_id', Auth::id())->get();

        return response()->json(['success' => $data]);
    }

    public function storeIjinInstruktur(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_pengajuan' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'error!'], 401);
        }

        $ijin = new DaftarIjin();
        $ijin->instruktur_id = $request->user_id;
        $ijin->tanggal_pengajuan = $request->tanggal_pengajuan;
        $ijin->status = 'Menunggu Persetujuan';
        $ijin->save();

        return response()->json(['success' => true, 'data' => $ijin],$this->successStatus);
    }

    public function tampilKelas()
    {
        $kelas = Kelas::all();

        return response()->json(['success' => true, 'data' => $kelas]);
    }

    public function jadwal()
    {
        $data = Jadwal::join('instrukturs','instrukturs.id_user','=','jadwal.id_instruktur')
            ->join('users','users.id','=','jadwal.id_instruktur')
            ->select('jadwal.*', 'users.id as id_user', 'users.first_name','users.middle_name','users.photo','instrukturs.no_telpon','instrukturs.alamat','instrukturs.no_telpon','users.last_name','instrukturs.id as instruktur_id')
            ->get();

        return response()->json(['success' => true, 'data' => $data]);

    }

    public function storeBookingKelas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jadwal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'error!'], 401);
        }

        $tahunIni = date('Y');
        $tanggalIni = date('m');
        $lastInvoice = BookingKelas::orderBy('id', 'desc')->first();
        $lastInvoiceId = $lastInvoice ? intval(substr($lastInvoice->nomor_struk, -2)) : 0;
        $invoiceId = str_pad($lastInvoiceId + 1, 2, '0', STR_PAD_LEFT);
        $invoiceNumber = substr($tahunIni, -2) . '.' . $tanggalIni . '.' . $invoiceId;

        $booking = new BookingKelas();
        $booking->id_jadwal  = $request->id_jadwal;
        $booking->id_user = Auth::id();
        $booking->nomor_booking_kelas = $invoiceNumber;
        $booking->status = 'proses';
        $booking->save();

        return response()->json(['success' => true, 'data' => $booking]);

    }

    public function storeBookingGym(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jadwal' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'error!'], 401);
        }

        $tahunIni = date('Y');
        $tanggalIni = date('m');
        $lastInvoice = BookingGym::orderBy('id', 'desc')->first();
        $lastInvoiceId = $lastInvoice ? intval(substr($lastInvoice->nomor_struk, -2)) : 0;
        $invoiceId = str_pad($lastInvoiceId + 1, 2, '0', STR_PAD_LEFT);
        $invoiceNumber = substr($tahunIni, -2) . '.' . $tanggalIni . '.' . $invoiceId;

        $booking = new BookingGym();
        $booking->id_jadwal  = $request->id_jadwal;
        $booking->id_user = Auth::id();
        $booking->nomor_booking_kelas = $invoiceNumber;
        $booking->status = 'proses';
        $booking->save();

        return response()->json(['success' => true, 'data' => $booking]);

    }

}
