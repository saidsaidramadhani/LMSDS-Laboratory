<?php

namespace App\Controllers\Client;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;

class Samples extends BaseController
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
		$data['page_title'] 	= 'Samples ';	
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
			echo view('admin/modals/md_samples');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM samples
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 			= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				$data['location_id'] 	= 	$rowz->location_id;	
				$data['storage_condition'] 	= 	$rowz->storage_condition;	
				$data['status'] 	= 	$rowz->status;	
				$data['expire_at'] 	= 	$rowz->expire_at;	
				$data['user_id'] 	= 	$rowz->user_id;	
				$data['sample_id'] 		= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}

		$sql = "SELECT id, name
				FROM item_locations
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$sectionArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['locations'] 	=	$sectionArray;
		
		echo json_encode($data);
		//echo $data;
	}
	
	public function ajax_update()
	{
		
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('sample_id');
		$datas = array(
				'name' 	=> $this->request->getPost('name'),
				'description' 	=> $this->request->getPost('description'),
				'location_id' 	=> $this->request->getPost('location_id'),
				'storage_condition' => $this->request->getPost('storage_condition'),
				'status' 		=> $this->request->getPost('status'),
				'expire_at' 	=> $this->request->getPost('expire_at'),
				'user_id' 		=> session()->get('user_id'),
				'created_by' 	=> session()->get('USER_NAME'),
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('samples',$fields,$value)) {			
			if ($this->Common_model->addRecord('samples', $datas)) {
				session()->setFlashData('msg', 'samples added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"samples  added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No samples Added"));
			}
		} else {
			$datas = array(
				'name' 	=> $this->request->getPost('name'),
				'description' 	=> $this->request->getPost('description'),
				'location_id' 	=> $this->request->getPost('location_id'),
				'storage_condition' => $this->request->getPost('storage_condition'),
				'status' 		=> $this->request->getPost('status'),
				'expire_at' 	=> $this->request->getPost('expire_at'),
				'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('samples',$datas,$where)) {
				session()->setFlashData('msg', 'Samples Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"Samples Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on services locations"));
			}
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='samples'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Name','Description','Owner','Location','Storage');
		$data['mapData'] = array('name'=>'L','description'=>'L','fullname'=>'L','LocationName'=>'L','storage_condition'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT samples.*,item_locations.name as LocationName,CONCAT(CONCAT(IF(users.firstname='','',CONCAT(UPPER(users.firstname),' ')),
						users.midname),' ', users.surname) AS fullname
						FROM samples 
						inner join users on users.id=user_id
						left join item_locations on item_locations.id=location_id
						
			";
		$data['addNew'] = array('do_samples','id','delete_sample');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/Client/samples/index','id');
			$data['deleteURI'] = array(site_url().'samples/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'Sample Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('samples',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('samples','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"samples deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"samples could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"samples is not found");
		}
		echo json_encode($response);
	}	
}

