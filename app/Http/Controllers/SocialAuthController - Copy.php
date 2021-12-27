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


//use App\Providers\SocialFacebookAuthService AS PROVIDER;




class SocialAuthController extends Controller {
	 use Authenticatable;
	public function redirect($service) {
		return Socialite::driver ( $service )->redirect ();
	}
	public function callback(Request $request,$service) {
		$user = Socialite::with ( $service )->user();
		
		
		// $authUser = SfGuardUser::where('email', $facebookUser->email)->first();
		 $qb = DB::table('socialusers as u')->where('u.email',$user->user['email'])->get()->first();
		// $qb = DB::table('socialusers as u')->where('u.email','haroonur631@yahoo.com')->get()->first();
		 print_r($qb->id); 
		 //echo $qb[0]->name;
		 $request->session()->put('user',$qb->email);
		
echo 321;
echo '+++++'.$request->session()->get('user');

		//print_r($user->user['name']);
		//$username 	= $user->user['name'];
		$email 		= 'haroonur631@yahoo.com';
		//$sid 		= $user->user['id'];
		$updateDate = date('Y-m-d H:i:s');
		
		
		$chkUser = DB::select('select u.email,u.id from socialusers AS u WHERE u.email = "'.$email.'"');
		print_r($chkUser);
		echo 'ID: '.$chkUser[0]->id;
		if(sizeof($chkUser) == 1){
		
		/*DB::table('socialusers')->update([
        [
            'updated_at'      => $updateDate,
        ]
])->where('email', $email);*/
		}else{
			 $insert =DB::insert("insert into socialusers (username,email,phone,socialid,is_active,created_at,updated_at)values('$username','$email','','$sid',1,'$updateDate','$updateDate')");
		}
		//print_r($chkUser);
		//echo sizeof($chkUser);
	//echo sizeof($users);
	$data = array();
	
	
	
	
	//Auth::login(110,true);
	$a = Auth::loginUsingId(110);
	
	
	 dump(Auth::check());
	//print_r($a);
		//  echo 'a'.$a;
		  //return redirect('home');
		  if (Auth::check()) {
    echo 1;
}else{
	echo 2;
}


	
		
		
		

			//$contest = DB::table('users as u')->where('u.id',1)->first();
			//print_r($contest);
			
//			$item = socialusers::firstOrNew(array('username' => $username,'email' => $email));
//$item->save();


		//return view ( 'home' )->withDetails ( $user )->withService ( $service );
	}
	
	public function userslist()
	{
		return view ( 'userslist' );
	}
	
	public function getusers(Request $request)
	{
		/*$draw = $request->get('draw');
		if($draw != 1){ $offset = $draw * 10;}else{$offset = 0;}
	$users = DB::select('select u.id,u.username,u.email,u.phone,u.socialid from socialusers AS u LIMIT '.$offset.',10');
	//echo sizeof($users);
	$data = array();
	$data['data'] = $users;
	$data['recordsTotal']	 = sizeof($users);
	$data['draw']			 = $draw;
	$data['recordsFiltered'] = 100;
	//return json_encode($users);
	return response()->json($data);
*/



$draw = $request->query->get( 'draw', 1 );
        $start = $request->query->get( 'start', 0 );
        $length = $request->query->get( 'length', 10 );
        $search = $request->query->get( 'search');
        $columns = $request->query->get( 'columns');

        $sortname = 'u.id'; // Sort column
        $sortorder = 'desc'; // Sort order
        $startDate = '';
        $endDate = '';

        // Get posted data
        if ($request->query->get('sortname')) {
            $srt = explode("|",$request->query->get('sortname'));
            $sortname = $srt[0].".".$srt[1];
        }
        if ($request->query->get('order')) {
            $sortorder=$request->query->get('order');
            $sortorder=isset($sortorder[0]['dir'])?$sortorder[0]['dir']:'desc';
        }
/*
        if ($request->query->get('startDate')!='') {
            $startDate=$request->query->get('startDate');
            $startDate = new DateTime($startDate);
            $startDate= $startDate->format('y-m-d 00:00:00');
        }

        if ($request->query->get('endDate')!='') {
            $endDate=$request->query->get('endDate');
            $endDate = new DateTime($endDate);
            $endDate= $endDate->format('y-m-d 23:59:59.999');
        }

*/
  
		//$em = $this->getDoctrine()->getManager();
        //$qb = $em->createQueryBuilder();
$qb = DB::select('select u.id,u.username,u.email,u.phone,u.socialid from socialusers AS u');
       // $qb = $qb->select('COUNT(l.id)')
         //   ->from('AppBundle:Logs', 'l');

       /* if($columns[0]['search']['value']!=''){
            $qb->andWhere(
                $qb->expr()->eq('l.id', ':Id')
            );
            $qb =  $qb->setParameter('Id', intval($columns[0]['search']['value']));
        }
        if($columns[1]['search']['value']!=''){
            $qb->andWhere(
                $qb->expr()->eq('o.id', ':oId')
            );
            $qb =  $qb->setParameter('oId', $columns[1]['search']['value']);
        }
        if($columns[2]['search']['value']!='') {
            $qb->andWhere(
                $qb->expr()->orx(
                    $qb->expr()->like('u.firstName', ':firstName')
                ));
            $qb = $qb->setParameter('firstName', '%'.$columns[2]['search']['value'].'%');
        }

        if($columns[3]['search']['value']!='') {
            $qb->andWhere(
                $qb->expr()->orx(
                    $qb->expr()->like('l.action', ':action')
                ));
            $qb = $qb->setParameter('action', '%'.$columns[3]['search']['value'].'%');
        }

        if($startDate!=''){
            $qb = $qb->andWhere('l.createdAt>=:startDate');
            $qb =  $qb->setParameter('startDate', $startDate);
        }

        if($endDate!=''){
            $qb = $qb->andWhere('l.createdAt<=:endDate');
            $qb =  $qb->setParameter('endDate', $endDate);
        }

        if ($search['value'] != '')
        {
            $qb->andWhere(
                $qb->expr()->orx(
                    $qb->expr()->like('l.id', ':param'),
                    $qb->expr()->like('o.id', ':param'),
                    $qb->expr()->like('u.firstName', ':param'),
                    $qb->expr()->like('l.action', ':param')
                ));
            $qb =  $qb->setParameter('param', '%'.$search['value'].'%');
        }
*/
        //$count = $qb->getQuery()->getSingleScalarResult();
		$count	=	sizeof($qb);


	//$qb = DB::select('select u.id,u.username,u.email,u.phone,u.socialid from socialusers AS u');
	$qb = DB::table('socialusers as u')->orderBy($sortname,$sortorder)->skip($start)->take($length);
		
        if($columns[0]['search']['value']!=''){
            $qb->where('u.id',intval($columns[0]['search']['value']));	
        }
		
		  if($columns[1]['search']['value']!=''){
            $qb->where('u.username',$columns[1]['search']['value']);	
        }
		
		 if($columns[2]['search']['value']!='') {
           $qb->where('u.email',$columns[2]['search']['value']);
        }
		
		 if($columns[3]['search']['value']!='') {
           $qb->where('u.phone',$columns[3]['search']['value']);
        }
		
		if($columns[4]['search']['value']!='') {
           $qb->where('u.socialid',$columns[4]['search']['value']);
        }

/*		
      
       

       
        if($startDate!=''){
            $qb = $qb->andWhere('l.createdAt>=:startDate');
            $qb =  $qb->setParameter('startDate', $startDate);
        }

        if($endDate!=''){
            $qb = $qb->andWhere('l.createdAt<=:endDate');
            $qb =  $qb->setParameter('endDate', $endDate);
        }

        if ($search['value'] != '')
        {
            $qb->andWhere(
                $qb->expr()->orx(
                    $qb->expr()->like('l.id', ':param'),
                    $qb->expr()->like('o.id', ':param'),
                    $qb->expr()->like('u.firstName', ':param'),
                    $qb->expr()->like('l.action', ':param')
                ));
            $qb =  $qb->setParameter('param', '%'.$search['value'].'%');
        }

        $result = $qb->getQuery()->getArrayResult();
		
		*/
		
		$result = $qb->get();

        $data=array();
        foreach($result as $row) {

           /* $email = $user->user['email'];
            $performedBy = '<a title="'.$email.'" href="">'.ucfirst($user->user['name']).'</a>';
            //$performedBy =  '<a href="'.$this->get('router')->generate('showUserInfo').'?id='.$row['performedBy']['id'].'">'.$row['performedBy']['id'].'</a>';
            $order_id =  is_null($row['order'])?"N/A":$row['order']['id'];
            if ($order_id != 'N/A')
            {
                $url_order = $this->get('router')->generate('orderDetails',array('id' => $order_id));
                $order_id ="<a id='order_".$order_id."' class='order_link' title='".$order_id."' href=".$url_order.">".$order_id."</a>";
            }

            //$act = str_replace("<a","<em",$row['action']);
            //$act = str_replace("/a","/em",$act);

            $loop++;
			*/
			
            $data[] = array(
                $row->id,
                $row->username,
                $row->email,
                $row->phone,
				$row->socialid
            );
        }

        $temp=array();
        $temp['draw']=$draw;
        $temp['recordsTotal']=$count;
        $temp['recordsFiltered']=$count;
        $temp['data']=$data;
		
		return response()->json($temp);
        //return new Response(json_encode($temp));
	//return '{"draw":"1","recordsTotal":"1317","recordsFiltered":"1317","data":[["1808<\/a>","Albert<\/a>","custom Order","$805","$805",1,"new","Details<\/a>","17 Jun 21 05:34:22am"],["1807<\/a>","Albert<\/a>","Website(Package)","$599","$599",1,"new","Details<\/a>","17 Jun 21 05:31:18am"],["1806<\/a>","Albert<\/a>","Logo design(Package)","$47","$47",1,"new","Details<\/a>","17 Jun 21 05:10:49am"],["1805<\/a>","Haroon<\/a>","Logo design(Package)","$999","$999",1,"new","Details<\/a>","06 May 21 05:01:10am"],["1804<\/a>","Haroon<\/a>","Logo design(Package)","$999","$999",1,"new","Details<\/a>","06 May 21 04:10:18am"],["1803<\/a>","Haroon<\/a>","Logo design(Package)","$599","$599",1,"new","Details<\/a>","06 May 21 03:56:47am"],["1802<\/a>","Haroon<\/a>","Logo design(Package)","$249","$249",1,"new","Details<\/a>","06 May 21 03:50:09am"],["1801<\/a>","Haroon<\/a>","Logo design(Package)","$638","$638",1,"new","Details<\/a>","06 May 21 03:14:48am"],["1800<\/a>","Haroon<\/a>","Logo design(Package)","$999","$999",1,"new","Details<\/a>","06 May 21 03:12:27am"],["1799<\/a>","Haroon<\/a>","Logo design(Package)","$999","$999",1,"new","Details<\/a>","05 May 21 06:54:27am"]]}';
	}
	public function insertuser(Request $request){
		// $name = $request->input('stud_name');
      //DB::insert('insert into student (name) values(?)',[$name]);
      //echo "Record inserted successfully.<br/>";
      //echo '<a href = "/insert">Click Here</a> to go back.';
	}
	
	public function sociallogins()
	{
		//Auth::loginUsingId(1);
		
//echo Auth::user()->getId();
if (Auth::check()) {
    echo 1;
}else{
	echo 2;
}
		return view ( 'home' );
	}
}
