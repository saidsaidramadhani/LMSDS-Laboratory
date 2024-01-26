<?php

namespace App\Controllers\Admin;


use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;


class Users extends BaseController
{
    protected $Multi_model;
    protected $Common_model;
  
    public function __construct(){
    
        helper(['url','form']);
        $this->Multi_model = new Multi_model;
        $this->Common_model = new Common_model;  
 
    }	
	
	public function index()
	{	

		$msg='';
		$update='Save';
		$id_value 	= service('uri')->getSegment(2, -99);
		$data['page_title'] 	= 'Manage Users';	
		$data['system_name'] 		=	$this->Common_model->get_field_val('settings',array('key'=>'system_name'),'value');
		$data['short_name'] 		=	$this->Common_model->get_field_val('settings',array('key'=>'short_name'),'value');

		if ($this->request->getPost('show')=='Show') {

			$data	=	$this->showrec($data);
			//$data['frm'] 		= $form->get(); // this returns the validated form as a string		
			echo view('admin/Add', $data);
		}elseif (($this->request->getPost('update')=='Update') || ($this->request->getPost('update')=='Save')) { 
				$this->process();
			$data	=	$this->showrec($data);
			echo view('admin/Add', $data);
		} else {
			$data	=	$this->showrec($data);			
			echo view('admin/Add', $data);
			echo view('admin/modals/md_users');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM users
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['firstname'] 		= 	$rowz->firstname;	
				$data['midname'] 	= 	$rowz->midname;	
				$data['surname'] 	= 	$rowz->surname;	
				$data['gender'] 	= 	$rowz->gender;	
				$data['status'] 	= 	$rowz->status;	
				$data['phone'] 		= 	$rowz->phone;	
				$data['user_type_id'] 	= 	$rowz->user_type_id;	
				$data['user_id'] 	= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}
		$data['email'] 		=	$this->Common_model->get_field_val('login',array('user_id'=>$id),'email');
		

		$sql = "SELECT id, name
				FROM user_types
				order by name
				";
		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$userTypesArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['userTypes'] 	=	$userTypesArray;

		echo json_encode($data);
		//echo $data;
	}
	
	public function ajax_update()
	{
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('user_id');
		$email					=	$this->request->getPost('email');
		$phone					=	$this->request->getPost('phone');
		$phone 					= 	str_replace('-','',$phone);
		

		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('users',$fields,$value)) {
			
			$user_id 		=	$this->Common_model->returnAutoid('users','id');
			$datas = array(
					'firstname' 	=> $this->request->getPost('firstname'),
					'midname' 		=> $this->request->getPost('midname'),
					'surname' 		=> $this->request->getPost('surname'),
					'gender' 		=> $this->request->getPost('gender'),
					'user_type_id' 	=> $this->request->getPost('user_type_id'),
					'status' 		=> $this->request->getPost('status'),
					'phone' 		=> $phone,
					'id' 		=> $user_id,
					'created_by' 	=> session()->get('USER_NAME'),
					'created_at' 	=> $rdate,
					'updated_at' 	=> $rdate
			);			

			$fieldUser				=	array('email');	
			$valueUser				=	array($email);
			if (!$this->Common_model->isDuplicate('login',$fieldUser,$valueUser)) {
				if ($this->Common_model->addRecord('users', $datas)) {
					
					$password = password_hash('123456', PASSWORD_DEFAULT);
					$dataLogin = array(
						'email' 		=> $this->request->getPost('email'),
						'username' 		=> $this->request->getPost('email'),
						'user_id' 		=> $user_id,
						'password' 		=> $password,
						'created_by' 	=> session()->get('USER_NAME'),
						'created_at' 	=> $rdate,
						'updated_at' 	=> $rdate
					);
					if ($this->Common_model->addRecord('login', $dataLogin)) {
					}
					session()->setFlashData('msg', 'Users added successfully');
					echo json_encode(array("status" => TRUE,"msg"=>"Users added successfully, Username : ".$this->request->getPost('email')));
				} else {
					echo json_encode(array("status" => FALSE,"msg"=>"No users Added"));
				}
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"User with the same email already exist : ".$this->request->getPost('email')));
			}
			
		} else {
			$datas = array(
					'firstname' 	=> $this->request->getPost('firstname'),
					'midname' 		=> $this->request->getPost('midname'),
					'surname' 		=> $this->request->getPost('surname'),
					'gender' 		=> $this->request->getPost('gender'),
					'status' 		=> $this->request->getPost('status'),
					'phone' 		=> $phone,
					'user_type_id' 	=> $this->request->getPost('user_type_id'),
					'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('users',$datas,$where)) {
				//session()->setFlashData('msg', 'Users Changed successfully');
				$response	=	"Users Changed successfully";
			} else {
				$response	=	"No Changes on Users";
			}
			
			$dataLogin = array(
				'email' 		=> $this->request->getPost('email'),
				'updated_at' 	=> $rdate
			);
			$whereLogin 		=	array('user_id'=>$id);
			if ($this->Common_model->updateRecord('login',$dataLogin,$whereLogin)) {
				
				$response	=	"Users Changed successfully";
			}	
			
			//session()->setFlashData('msg', 'Users Changed successfully');
			echo json_encode(array("status" => TRUE,"msg"=>$response));		
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='users'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Firstname','Midname','Surname','Gender','User Type','Status');
		$data['mapData'] = array('firstname'=>'L','midname'=>'L','surname'=>'L','gender'=>'L','UserTypeName'=>'L','status'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT users.*,user_types.name as UserTypeName 
		FROM users inner join user_types 
		on user_types.id=user_type_id
			";
		$data['addNew'] = array('do_users','id','delete_user');		
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/mo_dept/users/index','id');
			$data['deleteURI'] = array(site_url().'users/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'Users Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('users',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('users','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"Users deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"Users could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"Users is not found");
		}
		echo json_encode($response);
	}	
}
