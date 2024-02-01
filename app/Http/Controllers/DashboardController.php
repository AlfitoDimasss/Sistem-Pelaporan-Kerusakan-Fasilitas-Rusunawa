<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\DamageReport;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $reports = '';
        $receivedReports = '';
        $pendingReports = '';
        $successReports = '';
        $userId = Auth::user()->id;
        if (Auth::user()->admin_status != 0) {
            $reports = DamageReport::latest()->filter($request->all())->paginate(6)->withQueryString();
            $receivedReports = DamageReport::filter($request->all())->where('status', 'received')->get()->count();
            $pendingReports = DamageReport::filter($request->all())->where('status', 'pending')->get()->count();
            $successReports = DamageReport::filter($request->all())->where('status', 'success')->get()->count();
        } else {
            $reports = DamageReport::latest()->filter($request->all())->where('user_id', $userId)->paginate(6)->withQueryString();
            $receivedReports = DamageReport::filter($request->all())->where('user_id', $userId)->where('status', 'received')->get()->count();
            $pendingReports = DamageReport::filter($request->all())->where('user_id', $userId)->where('status', 'pending')->get()->count();
            $successReports = DamageReport::filter($request->all())->where('user_id', $userId)->where('status', 'success')->get()->count();
        }
        return view('admin.dashboard', [
            'reports' => $reports,
            'receivedReports' => $receivedReports,
            'pendingReports' => $pendingReports,
            'successReports' => $successReports
        ]);
    }

    public function download(Request $request)
    {
        $reports = DamageReport::filter($request->all())->get();
        // dd($request['year']);
        $pdf = $this->generatePDF($reports, $request);
        return $pdf->download('report.pdf');
    }

    public function generatePDF($data, $request)
    {
        return Pdf::loadView('pdf.template', array(
            'reports' => $data,
            'months' => $request['months'] ? $request['months'] : [],
            'year' => $request['year'] ? $request['year'] : '2023',
        ));
    }

    public function buildingIndex()
    {
        $buildings = Building::paginate(6);
        $rooms = Room::all()->count();
        $users = User::where('admin_status', 0)->get()->count();

        return view('admin.buildingIndex', [
           'buildings' => $buildings,
            'rooms' => $rooms,
            'users' => $users
        ]);
    }

    public function roomIndex()
    {
        $buildings = Building::all();
        $rooms = Room::paginate(12);
        $users = User::where('admin_status', 0)->get()->count();

        return view('admin.roomIndex', [
            'buildings' => $buildings,
            'rooms' => $rooms,
            'users' => $users
        ]);
    }

    public function userIndex()
    {
        $buildings = Building::all()->count();
        $rooms = Room::all()->count();
        $users = User::where('admin_status', 0)->paginate(6);

        return view('admin.userIndex', [
            'buildings' => $buildings,
            'rooms' => $rooms,
            'users' => $users
        ]);
    }
}
