<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;

class Dashboard extends BaseController
{

    protected $usersModel;

    public function __construct(){

    $this->usersModel = new usersModel();

    }

    public function index()
    {
       // $usersModel = new \App\Models\UsersModel();
        $logedUserID = session()->get('loggedUser');
       $userInfo = $this->usersModel->find($logedUserID);
        $data= [
           'title'=>'Home',
         'userInfo'=>$userInfo,
           'staff'=>$this->usersModel->list_staff()
        ];
        echo  view('layout/v_head');
        echo  view('layout/v_header',$data);
        echo  view('layout/v_side_menu');
        echo  view('Dashboard/v_home');
        echo  view('layout/v_footer');
     }

     function hr_dashboard(){

        $logedUserID = session()->get('loggedUser');
        $userInfo = $this->usersModel->find($logedUserID);
        $data= [
           'title'=>'Human Resources Dashboard',
           'userInfo'=>$userInfo,
           'staff'=>$this->usersModel->list_staff()
        ];
        echo  view('layout/v_head');
        echo  view('layout/v_header',$data);
        echo  view('layout/v_side_menu');
        echo  view('Dashboard/v_dashboard');
        echo  view('layout/v_footer');
     }
}

