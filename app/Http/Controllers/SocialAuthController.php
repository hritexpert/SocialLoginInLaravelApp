<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Redirect;

use Illuminate\Support\Facades\DB;
use App\socialusers;
use Illuminate\Support\Facades\Auth;


use App\libraries\Toolkit;
use App\Models\SfGuardUser;
use App\Models\SfGuardUserGroup;
use App\Models\WebNotification;
use App\Services\SocialFacebookAuthService;
use Exception;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\App;

class SocialAuthController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback(Request $request, $service)
    {
        $user = Socialite::with($service)->user();
        $chkUser = DB::table('socialusers as u')->where('u.email', $user->user['email'])->get()->first();
        $updateDate = date('Y-m-d H:i:s');
        if (isset($chkUser)) {
            $request->session()->put('user', $chkUser);
            $request->session()->put('social_user', $user);
            $data = ['updated_at' => $updateDate];
            DB::table('socialusers')->where('email', $chkUser->email)->update($data);
        } else {
            $username = $user->user['name'];
            $email = $user->user['email'];
            $sid = $user->user['id'];
            $insert = DB::insert("insert into socialusers (username,email,phone,socialid,is_active,created_at,updated_at)values('$username','$email','92321929292','$sid','$service','$updateDate','$updateDate')");
            $request->session()->put('user', $insert);
            $request->session()->put('social_user', $user);
        }
        session()->flash('success', 'You have successfully login!');
        return redirect('/profile');
    }

    public function userslist()
    {
        return view('userslist');
    }

    public function profile()
    {
        if (session()->has('user')) {
            return view('profile');
        } else {
            return redirect('/home2');
        }
    }

    public function getusers(Request $request)
    {
        $draw = $request->query->get('draw', 1);
        $start = $request->query->get('start', 0);
        $length = $request->query->get('length', 10);
        $search = $request->query->get('search');
        $columns = $request->query->get('columns');

        $sortname = 'u.id'; // Sort column
        $sortorder = 'desc'; // Sort order
        $startDate = '';
        $endDate = '';

        // Get posted data
        if ($request->query->get('sortname')) {
            $srt = explode("|", $request->query->get('sortname'));
            $sortname = $srt[0] . "." . $srt[1];
        }
        if ($request->query->get('order')) {
            $sortorder = $request->query->get('order');
            $sortorder = isset($sortorder[0]['dir']) ? $sortorder[0]['dir'] : 'desc';
        }

        $qb = DB::select('select u.id,u.username,u.email,u.phone,u.socialid from socialusers AS u');

        $count = sizeof($qb);
        $qb = DB::table('socialusers as u')->orderBy($sortname, $sortorder)->skip($start)->take($length);

        if ($columns[0]['search']['value'] != '') {
            $qb->where('u.id', intval($columns[0]['search']['value']));
        }

        if ($columns[1]['search']['value'] != '') {
            $qb->where('u.username', $columns[1]['search']['value']);
        }

        if ($columns[2]['search']['value'] != '') {
            $qb->where('u.email', $columns[2]['search']['value']);
        }

        if ($columns[3]['search']['value'] != '') {
            $qb->where('u.phone', $columns[3]['search']['value']);
        }

        if ($columns[4]['search']['value'] != '') {
            $qb->where('u.socialid', $columns[4]['search']['value']);
        }


        $result = $qb->get();

        $data = array();
        foreach ($result as $row) {

            $data[] = array(
                $row->id,
                $row->username,
                $row->email,
                $row->phone,
                $row->socialid
            );
        }

        $temp = array();
        $temp['draw'] = $draw;
        $temp['recordsTotal'] = $count;
        $temp['recordsFiltered'] = $count;
        $temp['data'] = $data;

        return response()->json($temp);
    }

    public function sociallogins()
    {
        return view('home2');
    }

    public function logout()
    {
        if (session()->has('user')) {
            session()->pull('user');
            session()->pull('social_user');
            session()->flash('success', 'You have successfully logout!');
        }
        return redirect('/home2');
    }
}
