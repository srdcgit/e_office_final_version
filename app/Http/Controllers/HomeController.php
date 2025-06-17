<?php

namespace App\Http\Controllers;

use App\Facades\UtilityFacades;
use App\Models\Fileshare;
use App\Models\Modual;
use App\Models\Receiptshare;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTeams(Request $request)
    {
        // Query for users in the authenticated user's department
        $qry = User::where('department_id', Auth::user()->department_id);
        if (!empty($request->search_text)) {
            $qry->where('name', 'like', '%' . $request->search_text . '%');
        }
        $teams = $qry->with('departments')->get()->map(function ($item) {
            // Add department_name and status_name to each user
            $item->department_name = optional($item->departments)->name;
            $item->status_name = User::get_status((string) $item->status);
            return $item;
        });

        // Return response as JSON
        return response()->json([
            'data' => $teams,
            'status' => 200
        ]);
    }

    public function change_status(Request $request)
    {
        $user = Auth::user();
        $user->status = $request->status_type;
        $result = $user->save();
        $status_name = User::get_status($request->status_type);
        if ($result) {
            return response()->json([
                'message' => "Status updated to {$status_name}!",
                'code' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'User not authenticated',
                'code' => 401
            ], 200);
        }
    }
    public function index()
    {
        if (!file_exists(storage_path() . "/installed")) {
            header('location:install');
            die;
        } else {
            $user = User::count();
            $modual = Modual::count();
            $role = Role::count();
            $user_details = Auth::user();
            $languages = count(UtilityFacades::languages());
            $file_inbox = Fileshare::where('recever_id', Auth::user()->id)->with(['files', 'user'])->orderBy('id', 'DESC')->get();
            $file_revert = Fileshare::where('recever_id', Auth::user()->id)->where('status', '1')->with('files')->orderBy('id', 'DESC')->get();
            $file_forward = Fileshare::where('sender_id', Auth::user()->id)->where('status', '2')->with('files')->orderBy('id', 'DESC')->get();
            $receipt_inbox = Receiptshare::where('recever_id', Auth::user()->id)->with(['user', 'receipts'])->orderBy('id', 'DESC')->get();
            // $teams = self::getTeams();
            if (\Auth::user()->hasRole('admin')) {
                return view('dashboard.homepage', compact('user', 'modual', 'role', 'languages', 'receipt_inbox', 'file_inbox', 'file_revert', 'file_forward'));
            } else {
                return view('dashboard.updatedhomepage', compact('user_details', 'user', 'modual', 'role', 'languages', 'receipt_inbox', 'file_inbox', 'file_revert', 'file_forward'));
            }
        }
    }

    public function file_inbox(Request $request)
    {
        if ($request->type == "file_inbox") {
            $file_inbox = Fileshare::where('recever_id', Auth::user()->id)
                ->with(['files', 'user'])
                ->orderBy('id', 'DESC')
                ->get()
                ->take(4)
                ->map(function ($item) {
                    $item->duedate = date('d/m/Y', strtotime($item->duedate));
                    $item->send_date = date('d/m/Y', strtotime($item->created_at));
                    return $item;
                });
            return response()->json([
                'data' => $file_inbox->isEmpty() ? null : $file_inbox,
                'code' => 200
            ]);
        } else {
            $receipt_inbox = Receiptshare::where('recever_id', Auth::user()->id)
                ->with(['user', 'receipts', 'departments'])
                ->orderBy('id', 'DESC')
                ->get()
                ->take(4)
                ->map(function ($item) {
                    $item->receipts->dairy_date = date('d/m/Y', strtotime($item->receipts->dairy_date));
                    return $item;
                });
            return response()->json([
                'data' => $receipt_inbox->isEmpty() ? null : $receipt_inbox,
                'code' => 200
            ]);
        }
    }

    public function chart(Request $request)
    {
        if ($request->type == 'year') {

            $arrLable = [];
            $arrValue = [];

            for ($i = 0; $i < 12; $i++) {
                $arrLable[] = Carbon::now()->subMonth($i)->format('F');
                $arrValue[Carbon::now()->subMonth($i)->format('M')] = 0;
            }
            $arrLable = array_reverse($arrLable);
            $arrValue = array_reverse($arrValue);

            $t = User::select(DB::raw('DATE_FORMAT(created_at,"%b") AS user_month,COUNT(id) AS usr_cnt'))
                ->where('created_at', '>=', Carbon::now()->subDays(365)->toDateString())
                ->where('created_at', '<=', Carbon::now()->toDateString())
                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%b") '))
                ->get()
                ->pluck('usr_cnt', 'user_month')
                ->toArray();

            foreach ($t as $key => $val) {
                $arrValue[$key] = $val;
            }
            $arrValue = array_values($arrValue);
            return response()->json(['lable' => $arrLable, 'value' => $arrValue], 200);
        }

        if ($request->type == 'month') {

            $arrLable = [];
            $arrValue = [];

            for ($i = 0; $i < 30; $i++) {
                $arrLable[] = date("d M", strtotime('-' . $i . ' days'));

                $arrValue[date("d-m", strtotime('-' . $i . ' days'))] = 0;
            }
            $arrLable = array_reverse($arrLable);
            $arrValue = array_reverse($arrValue);

            $t = User::select(DB::raw('DATE_FORMAT(created_at,"%d-%m") AS user_month,COUNT(id) AS usr_cnt'))
                ->where('created_at', '>=', Carbon::now()->subDays(365)->toDateString())
                ->where('created_at', '<=', Carbon::now()->toDateString())
                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%d-%m") '))
                ->get()
                ->pluck('usr_cnt', 'user_month')
                ->toArray();

            foreach ($t as $key => $val) {
                $arrValue[$key] = $val;
            }
            $arrValue = array_values($arrValue);

            return response()->json(['lable' => $arrLable, 'value' => $arrValue], 200);
        }
    }
}
