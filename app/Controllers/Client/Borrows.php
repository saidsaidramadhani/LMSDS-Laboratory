<?php

namespace App\Controllers\Client;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;

class Borrows extends BaseController
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
		$data['page_title'] 	= 'Borrow Equipments ';	
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
			echo view('admin/modals/md_borrows');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM borrow
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 			= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				$data['equipment_id'] 	= 	$rowz->equipment_id;	
				$data['start_at'] 	= 	$rowz->start_at;	
				$data['end_at'] 	= 	$rowz->end_at;	
				$data['status'] 	= 	$rowz->status;		
				$data['user_id'] 	= 	$rowz->user_id;	
				$data['borrow_id'] 		= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}
		$sectionArray	=	array();
		
		$sql = "SELECT id, name
				FROM equipments
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$sectionArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['equipments'] 	=	$sectionArray;
		
		echo json_encode($data);
		//echo $data;
	}
	
	public function ajax_update()
	{
		
		$rdate				=	date('Y-m-d H:i:s');
		$id					=	$this->request->getPost('borrow_id');
		$equipment_id					=	$this->request->getPost('equipment_id');
		$name 				= 	$this->Common_model->get_field_val('equipments',array('id'=>$equipment_id),'name');
		if ($this->request->getPost('status'))
			$status	=	$this->request->getPost('status');
		else
			$status	=	0;
		
		$datas = array(
				'name' 	=> $name,
				'description' 	=> $this->request->getPost('description'),
				'equipment_id' 	=> $this->request->getPost('equipment_id'),
				'start_at' 		=> $this->request->getPost('start_at'),
				'end_at' 		=> $this->request->getPost('end_at'),
				'status' 		=> $status,
				'user_id' 		=> session()->get('user_id'),
				'created_by' 	=> session()->get('USER_NAME'),
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('borrow',$fields,$value)) {			
			if ($this->Common_model->addRecord('borrow', $datas)) {
				session()->setFlashData('msg', 'Borrowing added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"Borrows  added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Borrows Added"));
			}
		} else {
			if ($this->request->getPost('status')) {
				$status = $this->request->getPost('status');
				// Your code here
			} else {
				$status 	= 	$this->Common_model->get_field_val('borrow',array('id'=>$borrow_id),'status');
				
				$status	=	0;
			}
			$datas = array(
				'name' 	=> $name,
				'description' 	=> $this->request->getPost('description'),
				'equipment_id' 	=> $this->request->getPost('equipment_id'),
				'start_at' 		=> $this->request->getPost('start_at'),
				'end_at' 		=> $this->request->getPost('end_at'),
				'status' 		=> $this->request->getPost('status'),
				'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('borrow',$datas,$where)) {
				session()->setFlashData('msg', 'Borrowing Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"Borrowing Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on Borrowing"));
			}
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='borrows'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Name','Description','Borrower','From','To','Status');
		$data['mapData'] = array('ItemName'=>'L','description'=>'L','fullname'=>'L','start_at'=>'L','end_at'=>'L','borrow_status'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT borrow.*,equipments.name as ItemName,CONCAT(CONCAT(IF(users.firstname='','',CONCAT(UPPER(users.firstname),' ')),
						users.midname),' ', users.surname) AS fullname,borrow.status as borrow_status
						FROM borrow 
						inner join users on users.id=user_id
						inner join equipments on equipments.id=equipment_id
						
						
			";
		$data['addNew'] = array('do_borrows','id','delete_borrow');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/Client/borrows/index','id');
			$data['deleteURI'] = array(site_url().'borrows/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'Borrowing Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('borrow',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('borrow','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"Borrowing deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"Borrowing could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"Borrowing is not found");
		}
		echo json_encode($response);
	}	
}

