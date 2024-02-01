<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\DamageReport;
use App\Models\History;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function fetchRooms($id)
    {
        $rooms = Room::where('building_id', $id)->get();
        return response()->json($rooms);
    }

    public function getReport($id)
    {
        $report = DamageReport::where('id', $id)->get();
        return response()->json($report);
    }

    public function editReport($id, Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required'
        ]);


        $reports = DamageReport::find($id);

        $reports->updateStatus($validatedData);

        $validatedData['damage_report_id'] = $reports->id;
        $validatedData['notes'] = $request->notes;
        $validatedData['officer'] = $request->officer;

        $history = History::create($validatedData);
        $reports = DamageReport::find($id);

        if ($reports && $history) {
            $this->sendNotification($reports);
            return redirect('/dashboard')->with('success', 'Data laporan kerusakan berhasil diperbarui');
        }
    }

    public function sendNotification($data)
    {
        $token = env('FONNTE_TOKEN');
        $target = [
            'number' => $data->user->whatsapp_no,
            'id' => $data->id,
            'name' => $data->user->name,
            'room' => $data->room->name,
            'title' => $data->title,
            'status' => '',
            'note' => $data->histories[count($data->histories) - 1]->notes
        ];

        $message = '';
        $templateMessage = "\n\nNama Pelapor: *{name}*\nNomor Laporan: *#{var1}*\nNomor Kamar: *{var2}*\nJudul Kerusakan: *{var3}*\nStatus Laporan: *{var4}*\n";

        if ($data->status == 'success') {
            $message = "*-- Info Laporan Kerusakan Fasilitas Selesai --*" . $templateMessage;
            $target['status'] = 'Selesai';
        } elseif ($data->status == 'pending') {
            $message = "*-- Info Laporan Kerusakan Fasilitas Pending --*" . $templateMessage . "Alasan: *{var5}*\n";
            $target['status'] = 'Pending';
        } else {
            $message = "*-- Info Laporan Kerusakan Fasilitas Ditutup --*" . $templateMessage . "Alasan: *{var5}*\n";
            $target['status'] = 'Ditutup';
        }

        $message = $message . "\nInformasi lebih lengkap kunjungi: https://rusunawa-ub.my.id\n";

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
                'target' => '' . $target['number'] . '|' . $target['name'] . '|' . $target['id'] . '|' . $target['room'] . '|' . $target['title'] . '|' . $target['status'] . '|' . $target['note'] . '',
                'message' => $message,
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token" //change TOKEN to your actual token
            ),
        ));

        curl_exec($curl);

        curl_close($curl);
    }

    public function createBuilding(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $building = Building::create($validatedData);

        if ($building) {
            return redirect('/admin/buildings');
        }
    }

    public function destroyBuilding($id)
    {
        $building = Building::where('id', $id)->delete();

        if ($building) {
            return redirect('/admin/buildings');
        }
    }

    public function createRoom(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'building_id' => 'required'
        ]);

        $room = Room::create($validatedData);

        if ($room) {
            return redirect('/admin/rooms');
        }
    }

    public function destroyRoom($id)
    {
        $room = Room::where('id', $id)->delete();

        if ($room) {
            return redirect('/admin/rooms');
        }
    }

    public function destroyUser($id)
    {
        $user = User::where('id', $id)->delete();

        if ($user) {
            return redirect('/admin/users');
        }
    }
}
