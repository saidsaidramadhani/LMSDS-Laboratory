<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;

class Roles extends BaseController
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

		$ar=array(
			'class'			=>	'autosuggest_input',
			'onkeyup'		=>	"autosuggest(this.value,'".base_url()."');",
			'id'			=>	'autosuggest_list'		
		);
		$lar=array(
			'class'=>'left'
		);
		$id_value 	= service('uri')->getSegment(2, -99);
		$data['page_title'] 	= 'Roles';	
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
			echo view('admin/modals/md_role_permission');
			echo view('admin/modals/md_roles');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM roles
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 			= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				$data['display_name'] 	= 	$rowz->display_name;	
				$data['status'] 		= 	$rowz->status;	
				$data['role_id'] 		= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}

		echo json_encode($data);
		//echo $data;
	}

	
	public function edit_role($id)
	{
		$sql = "SELECT *
				FROM roles
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 			= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				$data['display_name'] 	= 	$rowz->display_name;	
				$data['status'] 		= 	$rowz->status;	
				$data['role_id'] 		= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}
		$permissionArray	=	array();
		$AssignpermissionArray	=	array();
		$sql = "SELECT id, name
				FROM permissions
				where id not in (select permission_id from permission_roles 
				where role_id='".$id."')
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$permissionArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['permission'] 	=	$permissionArray;

		$sql = "SELECT id, name
				FROM permissions
				where id in (select permission_id from permission_roles 
				where role_id='".$id."')
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$AssignpermissionArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['AssignedPermission'] 	=	$AssignpermissionArray;

		echo json_encode($data);
		//echo $data;
	}	
	public function ajax_update()
	{
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('role_id');
		$isChecked = $this->request->getPost('status') === '1';

		if ($isChecked) {
			// Checkbox is checked
			$status=1;
		} else {
			// Checkbox is not checked
			$status=0;
		}

		$datas = array(
				'name' 	=> $this->request->getPost('name'),
				'description' 	=> $this->request->getPost('description'),
				'display_name' 	=> $this->request->getPost('display_name'),
				'status' 		=> $status,
				'created_by' 	=> session()->get('USER_NAME'),
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('roles',$fields,$value)) {			
			if ($this->Common_model->addRecord('roles', $datas)) {
				session()->setFlashData('msg', 'user Role added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"user Role added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Settings Added"));
			}
		} else {
			$datas = array(
					'name' 	=> $this->request->getPost('name'),
					'description' 	=> $this->request->getPost('description'),
					'display_name' 	=> $this->request->getPost('display_name'),
					'status' 		=> $this->request->getPost('status'),
					'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('roles',$datas,$where)) {
				session()->setFlashData('msg', 'User roles Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"User roles Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on roles type"));
			}
		}
		
	}	

	public function role_update()
	{
		$rdate		=	date('Y-m-d H:i:s');
		$role_id	=	$this->request->getPost('role_id');

		$wheres			=	array('role_id'	=>	$role_id);							
		$aff_rows = $this->Common_model->deleteRecord('permission_roles','role_id', $role_id);
		if ($aff_rows) {
			
		}


		// Get selected values from the AJAX request
		$selectedValues = $this->request->getPost('selectedValues');
		$selectedValues = explode(',', $selectedValues);
		
		foreach ($selectedValues as $values) {
			
			$datas = array(
					'role_id' 	=> $this->request->getPost('role_id'),
					'permission_id' 	=> $values,
					'created_by' 	=> session()->get('USER_NAME'),
					'created_at' 	=> $rdate,
					'updated_at' 	=> $rdate
			);
			
			$fields				=	array('role_id','permission_id');	
			$value				=	array($this->request->getPost('role_id'),$values);
			
			$response= array("status" => FALSE,"msg"=>"Nothing was selected");

			$perFields				=	array('id');	
			$perValue				=	array($values);
			
			if ($this->Common_model->isDuplicate('permissions',$perFields,$perValue))
			if (!$this->Common_model->isDuplicate('permission_roles',$fields,$value)) {			
				if ($this->Common_model->addRecord('permission_roles', $datas)) {
					session()->setFlashData('msg', 'user Role added successfully');
					$response=array("status" => TRUE,"msg"=>"Permission Role added successfully");
				} else {
					$response=array("status" => FALSE,"msg"=>"No Permission Added");
				}
			} else {
				$response= array("status" => FALSE,"msg"=>"Permission Already exists");
			}				
		}
		
		echo json_encode($response);
		
	}
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='roles'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Name','Description','Display name','Status');
		$data['mapData'] = array('name'=>'L','description'=>'L','display_name'=>'L','status'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE,'col_details'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT * FROM roles 
			";
		$data['addNew'] = array('do_roles','id','delete_role');		
		$data['addDetails'] = array('do_role_permission','id','delete_role_permission');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/Admin/roles/index','id');
			$data['deleteURI'] = array(site_url().'roles/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'user roles Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('roles',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('roles','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"User roles deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"User roles could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"User roles is not found");
		}
		echo json_encode($response);
	}	
}

