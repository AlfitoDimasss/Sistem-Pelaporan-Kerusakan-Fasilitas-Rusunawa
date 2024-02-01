<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\DamageReport;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.pages.home');
    }

    public function create()
    {
        $buildings = Building::all();
        return view('public.pages.create', [
            'buildings' => $buildings
        ]);
    }

    public function validateRequest($request, $rules)
    {
        return $request->validate($rules);
    }

    public function sendNotification($data)
    {
        $token = env('FONNTE_TOKEN');
        $group_id = env('FONNTE_GROUP_ID');
        $target = [
            'number' => $data->user->whatsapp_no,
            'id' => $data->id,
            'name' => $data->user->name,
            'room' => $data->room->name,
            'title' => $data->title,
            'status' => 'Diterima'
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => '' . $target['number'] . '|' . $target['name'] . '|' . $target['id'] . '|' . $target['room'] . '|' . $target['title'] . '|' . $target['status'] . ',' . $group_id . '|' . $target['name'] . '|' . $target['id'] . '|' . $target['room'] . '|' . $target['title'] . '|' . $target['status'] . '',
                'message' => "*-- Info Laporan Kerusakan Fasilitas Masuk --*\n\nNama Pelapor: *{name}*\nNomor Laporan: *#{var1}*\nNomor Kamar: *{var2}*\nJudul Kerusakan: *{var3}*\nStatus Laporan: *{var4}*\n\nInformasi lebih lengkap kunjungi: https://rusunawa-ub.my.id\n",
                'delay' => 2,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token" //change TOKEN to your actual token
            ),
        ));

        curl_exec($curl);

        curl_close($curl);
    }

    public function store(Request $request)
    {
        $rules = [
            'room_id' => 'required|numeric',
            'title' => 'required|max:55',
            'image' => 'required|image',
            'description' => 'required|max:255'
        ];

        $validatedData = $this->validateRequest($request, $rules);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('report-images');
        }

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['status'] = 'received';

        $report = DamageReport::create($validatedData);

        $history = History::create([
            'damage_report_id' => $report->id,
            'notes' => '-'
        ]);

        if ($report && $history) {
            $this->sendNotification($report);
            return redirect('/')->withInput()->with('success', 'Laporan kerusakan berhasil ditambahkan.');
        }
    }

    public function search(Request $request)
    {
        $reports = DamageReport::latest()->where('id', $request['search'])->get();
        return view('public.pages.result', [
            'reports' => $reports
        ]);
    }
}
