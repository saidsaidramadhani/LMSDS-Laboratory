<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UsersModel;
use App\Models\Login_model as Login_model;


class Auth extends BaseController
{

  protected $Login_model;
  protected $Admission_model;

    public function __construct(){
      
          helper(['url','form']);
          $this->usersModel = new usersModel();
          $this->Login_model = new Login_model;

    }

    public function index()
    {
      // return view('Auth/login');
      $data = array();
      $data['page'] = 'Auth';
      echo view('admin/login', $data);
    }

 /****************Function login**********************************
     * @type            : Function
     * @function name   : log
     * @description     : Authenticatte when uset try lo login. 
     *                    if autheticated redirected to logged in user dashboard.
     *                    Also set some session date for logged in user.   
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
    public function log(){

      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');
      //$username 		= $this->security->xss_clean($username);		
      //$password 		= $this->security->xss_clean($password);		
      if(isset($_SESSION['num_login_fail']))
      {
        if($_SESSION['num_login_fail'] == 3)
         {
         if(time() - $_SESSION['last_login_time'] < 3*60 ) 
          {
           // alert to user wait for 10 minutes afer
          $data = array();
          $data['page'] = 'waitlogin';
          $data['timing']='';
          $this->load->view('admin/login', $data);
          return; 
          }
          else
          {
          //after 10 minutes
           $_SESSION['num_login_fail'] = 0;
          }
         }      
      } else {
        $_SESSION['num_login_fail'] = 0;
      }
  
      $con['username'] = $username;
      
         if($_POST){ 
              $querys = $this->Login_model->login($username, $password);
  
        if ($querys) {
          
          //$passwords		=	'Lst@1234';
          //$passwords		=	$this->input->post('password',true);
		  $passwords 		= $this->request->getPost('password');
		  $passwords 		=  password_hash($passwords,PASSWORD_DEFAULT);
          //$this->Login_model->uplogin($username, $passwords);
          //$password 		=	'Lst@1234';
        } 
  
          $data = array();
        
              $query = $this->Login_model->getRows($con);
        // change password
        
        
              
              //-- if valid
              if($query){
                  $data = array();
                  foreach($query as $row){
				//$password 		=  password_hash($password,PASSWORD_DEFAULT);
				//if (password_verify($password,$row->passwd))
				//{					
				   $data = array(
						  'user_id' 		      => 	$row->user_id,
						  'USERNO' 		  => 	$row->user_id,
						  'USERNAME'    => 	$row->username,
						  'USER_NAME'   => 	$row->username,
/* 						  'USER_PRIV'   =>	$row->priv_id,
						  'USER_MENUS'  =>	$row->mod_dir,
						  'USER_MENU'   =>	$row->mod_lib,
						  'MOD_NAME'    =>	$row->mod_name,
						  'MOD_ID' 	    => 	$row->mod_id,
						  'USER_MOD' 	  => 	$row->usermod,  
						  'role' 		    =>	$row->mod_id, */
						  'is_login' 	  => 	TRUE
				  );
				//session()->set_flashdata('USER_MOD', $row->usermod);		
				//session()->set('loggedUser',$user_id);			
				session()->set($data);
				//session()->set('USER_MENU',$row->mod_lib);
				//****************check if the User is an applicant *************************************//
				  $_SESSION['num_login_fail'] = 0;
				  
				  $url = base_url('admin/dashboard');
				  return redirect()->to($url);
	  
			  //}
			  //else
			  //{
			  //	$data['error_msg'] = 'Wrong password, please try again.';
				//$_SESSION['num_login_fail'] ++;
			  //	$_SESSION['last_login_time'] = time();
			  //	$data = array();
			  //	$data['page'] = 'invalid';
			  //	$this->load->view('admin/login', $data);
			  //}			
				
				 }
          
    
              } else {
				  $_SESSION['num_login_fail'] ++;
				  $_SESSION['last_login_time'] = time();
				  //redirect(base_url() . 'auth', 'refresh');
				  $data = array();
				  $data['page'] = 'invalid';
				  echo view('admin/login', $data);
              }
              
          }	else	{
				$data = array();
				echo view('admin/login',$data);
          }
      }
  
   /*     * ***************Function logout**********************************
       * @type            : Function
       * @function name   : logout
       * @description     : Log Out the logged in user and redirected to Login page  
       * @param           : null 
       * @return          : null 
       * ********************************************************** */
      
      function logout(){
          //session()->unset_userdata('logged_in');	
      //session()->destroy();	
      
          session()->destroy();
          $data = array();
          $data['page'] = 'logout';
          echo view('admin/login', $data);
      }

    public function save(){
      //lets validate
     /* $validation = $this->validate([
         'fname'=> 'required',
         'email'=> 'required|valid_email|is_unique[users.email]',
         'password'=> 'required|min_length[5]|max_length[12]',
         'cpassword'=>'required|min_length[5]|max_length[12]|matches[password]'
          ]);*/

          $validation = $this->validate([
               'fname'=>[
                  'rules'=>'required',
                  'errors'=>[
                    'required'=>'Your First name is required'
                  ]
               ],

                'lname'=>[
                  'rules'=>'required',
                  'errors'=>[
                    'required'=>'Your Last name is required'
                  ]
               ],

               'email'=>[
                  'rules'=>'required|valid_email|is_unique[users.email]',
                  'errors'=>[
                    'required'=>'Email is required',
                    'valid_email'=>'You must Enter a Valid Email',
                    'is_unique'=>'Email is already taken'
                  ]
               ],

                  'phone'=>[
                  'rules'=>'required|is_unique[users.phone]',
                  'errors'=>[
                    'required'=>'Phone number is required',
                    'is_unique'=>'Phone number is already taken'
                  ]
               ],

                'pnum'=>[
                  'rules'=>'required|is_unique[users.pnum]',
                  'errors'=>[
                    'required'=>'PF  number is required',
                    'is_unique'=>'PF number is already taken'
                  ]
               ],

                'snum'=>[
                  'rules'=>'required|is_unique[users.snum]',
                  'errors'=>[
                    'required'=>'Salary number is required',
                    'is_unique'=>'Salary  number is already taken'
                  ]
               ],

               /* 'password'=>[
                  'rules'=>'required|min_length[5]|max_length[12]',
                  'errors'=>[
                    'required'=>'Password  is required',
                    'min_length'=>'Confirm Password must have at least 5 characters in length',
                    'max_length'=>'Confirm Password must not have characters more than 12 in length'
                  ]
               ],

               'cpassword'=>[
                  'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                  'errors'=>[
                    'required'=>'Confirm Password  is required',
                    'min_length'=>'Password must have at least 5 characters in length',
                    'max_length'=>'Password must not have characters more than 12 in length',
                    'matches'=>'Confirm Password not matches to Password'
                  ]
               ],*/
          ]);

         if (!$validation) {

        $usersModel = new \App\Models\UsersModel();
        $logedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($logedUserID);
        $data= [
           'title'=>'Registration of new Staff',
           'userInfo'=>$userInfo,
           'gender'=>$this->usersModel->gender(),
           'scategory'=>$this->usersModel->scategory(),
           'branch'=>$this->usersModel->branch(),   
        ];
        echo  view('layout/v_head');
        echo  view('layout/v_header',$data);
        echo  view('layout/v_side_menu');
        echo  view('Staff/v_register',['validation'=>$this->validator]);
        echo  view('layout/v_footer');
         //  return view('auth/register',['validation'=>$this->validator]);
         } else {
          //lets register in db
            $fname = $this->request->getPost('fname');
            $mname = $this->request->getPost('mname');
            $lname = $this->request->getPost('lname');
            $email = $this->request->getPost('email');
            $g_id = $this->request->getPost('g_id');
            $b_id = $this->request->getPost('b_id');
            $c_id = $this->request->getPost('c_id');
            /*$password = $this->request->getPost('password');*/
            $password = '123456';
            $level     = '3';
            $phone = $this->request->getPost('phone');
            $pnum = $this->request->getPost('pnum');
            $snum = $this->request->getPost('snum');

           $values = [
               'email'=> $email,
               'fname'=> $fname,
               'mname'=> $mname,
               'lname'=> $lname,
               'password'=>Hash::make($password),
               'level'=>$level,
               'g_id'=>$g_id,
               'b_id'=>$b_id,
               'c_id'=>$c_id,
               'phone'=>$phone,
               'pnum'=>$pnum,
               'snum'=>$snum,
            ];
         $usersModel = new \App\Models\UsersModel();
          $query = $usersModel->insert($values); 

           if (!$query) {
                return redirect()-> back()->with('fail','something went wrong');
            } else {

               //return redirect()->to('register')->with('success','user registered successfully');
             // $last_id = $usersModel->insertID();
             // session()->set('loggedUser',$last_id);
                
              return redirect()->to('/register')->with('success','user registered successfully');
            }
         }
    }

    function check(){
      $validation = $this->validate([
        'email'=>[
             'rules'=>'required|valid_email|is_not_unique[users.email]',
             'errors'=>[
               'required'=>'Email is required',
               'valid_email'=>'Enter a Valid Email address',
               'is_not_unique'=>'This email is not registered on our services'
             ]
        ],
        'password'=>[
           'rules'=>'required|min_length[5]|max_length[12]',
           'errors'=>[
                    'required'=>'Password  is required',
                    'min_length'=>'Password must have at least 5 characters in length',
                    'max_length'=>'Password must not have characters more than 12 in length',
                  ]
        ]
      ]);

      if (!$validation) {
       return view('Auth/login',['validation'=>$this->validator]);
      } else {
             //lets check users
             $email = $this->request->getPost('email');
             $password = $this->request->getPost('password');
             $usersModel = new \App\Models\UsersModel();
             $user_info = $usersModel->where('email',$email)->first();
             $check_password = Hash::check($password,$user_info['password']);

             if (!$check_password) {
               session()->setFlashdata('fail','Incorrect Password');
               return redirect()->to('/')->withInput();
             } else {

                $user_id = $user_info['id'];
                session()->set('loggedUser',$user_id);
                return redirect()->to(base_url('/dashboard'));
             }
      }
    }


    function logouts(){
      if (session()->has('loggedUser')) {
        session()->remove('loggedUser');
        return redirect()->to('/?access=out')->with('fail','You are logged out');
      }
    }
}
