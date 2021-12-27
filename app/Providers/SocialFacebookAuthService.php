<?php
namespace App\Services;

use App\libraries\GeoApi;
use App\libraries\SHAHasher;
use App\Models\SfGuardUserProfile;
use App\Models\UserSetting;
use App\SfGuardUser;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SocialFacebookAuthService
{

    public function findOrCreateUser($facebookUser){
        try {
            $result = array('user'=>null, 'country_code'=>null);
            $authUser = SfGuardUser::where('email', $facebookUser->email)->first();
			print_r($authUser);
			exit();
            if ($authUser != null) {
                $result['user'] = $authUser;
                return $result;
            }else {

                $country_code = "";
                $city = "";
                if (App::environment() == 'dev' || App::environment() == 'staging'){
                    if ($country_code == 'PK'){
                        $result['country_code'] = null;
                    }
                }else {
                    try {
                        $maxmind = new GeoApi(request()->ip(), GeoApi::REQUEST_CITY);
                        $maxmind->execute();
                        $maxmindData = $maxmind->getRecord();

                        $country_code = $maxmindData['country_code'];
                        $city = $maxmindData['city'];
                        if ($country_code == 'PK') {
                            $result['country_code'] = $country_code;
                            $result['user'] = null;
                            return $result;
                        }

                    } catch (Exception $e) {
                        $e->getMessage();
                        echo $e->getMessage();
                        Mail::raw($e->getMessage(), function ($message) {
                            $message->to('jawed.islam@logodesignguru.com')->subject('Facebook Login Error');
                        });
                        error_log($e);
                        $result['user'] = null;
                        return $result;
                    }
                }

                $salt = md5(rand(100000, 999999) . trim($facebookUser->name));
                $sha1 = new SHAHasher();
                $name = $facebookUser->name;
                if ($name != "") {
                    $text = strtolower($name);
                    $text = str_replace(".", '-', $text);
                    $text = str_replace(" ", '-', $text);
                    $names = explode('-', $text);
                }
                $registeredUser = SfGuardUser::where(['username'=>$text])->first();
                if ($registeredUser != null){
                    $text = $text.'-'.rand(1, 1000);
                    $registeredUser = null;
                }
                if (preg_match("/creativebrief/", $_SERVER['HTTP_REFERER'])) {
                    $type = 2;
                } else {
                    $type = 1;
                }

                $pass = rand(100000, 100000000);
                $userProfile = new SfGuardUserProfile;
                $userSettings = new UserSetting;
                $sfUser = new SfGuardUser();
                $sfUser->salt = $salt;
                $sfUser->username = $text;
                $sfUser->firstname = $names[0];
                $sfUser->lastname = $names[1];
                $sfUser->email = $facebookUser->email;
                $sfUser->password = $sha1->make($salt.$pass);
                $sfUser->ip = request()->ip();
                $sfUser->city = $city;
                $sfUser->country = $country_code;
                $sfUser->type = $type;
                $sfUser->site_id = 8;
                $sfUser->wl_id = 8;
                $sfUser->is_active = '1';
                $sfUser->source = 'facebook';
                $sfUser->save();
                $sfUser->sfGuardUserProfile()->save($userProfile);
                $sfUser->userSettings()->save($userSettings);

                $mailData = array('username' => $text, 'password' => $pass, 'email' => $sfUser->email, 'usertype' => $sfUser->type);
                Mail::send('mail.templates._registration', $mailData, function ($message) use ($sfUser) {
                    $message->to($sfUser->email)->subject('Registration Successful');
                });

                $result['user'] = $sfUser;
                return $result;

            }
        }catch(Exception $ex){
           // echo $ex->getMessage();
            Mail::raw($ex->getMessage(). ".  Invalid User", function ($message){
                $message->to('jawed.islam@logodesignguru.com')->subject('Facebook Login Error');
            });
            error_log($ex);
            $result['user'] = null;
            return $result;

        }
    }
}