<?php
namespace App\Controllers\Manager;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;

class Equipments extends BaseController
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
		$data['page_title'] 	= 'Equipments';	
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
			echo view('admin/modals/md_equipments');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM equipments
				where id='".$id."'";
								
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 			= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				$data['equipment_type_id'] 	= 	$rowz->equipment_type_id;	
				$data['location_id'] 	= 	$rowz->location_id;	
				$data['rent_amount'] 	= 	$rowz->rent_amount;	
				$data['serial_number'] 	= 	$rowz->serial_number;	
				$data['functional_condition'] 	= 	$rowz->functional_condition;	
				$data['expriment_no_before_service'] 	= 	$rowz->expriment_no_before_service;	
				$data['equipment_type_id'] 	= 	$rowz->equipment_type_id;	
				$data['status'] 	= 	$rowz->status;	
				$data['borrowing'] 	= 	$rowz->is_for_borrowing;	
				$data['equipment_id'] 		= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}
		$itemsArray		=	array();
		$itemTypeArray	=	array();
		$itemTypeArray	=	array();
		
		$sql = "SELECT id, name
				FROM items
				where item_type_id in (select id from item_types where name like '%equipment%')
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$itemsArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['items'] 	=	$itemsArray;


		$sql = "SELECT id, name
				FROM equipment_types
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$itemTypeArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['equipmentType'] 	=	$itemTypeArray;
		
		$sql = "SELECT id, name
				FROM item_locations
				order by name
				";		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$locationArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['locations'] 	=	$locationArray;

		echo json_encode($data);
		//echo $data;
	}
	
	public function ajax_update()
	{
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('equipment_id');
		$item_id				=	$this->request->getPost('name');
		$name 					= 	$this->Common_model->get_field_val('items',array('id'=>$item_id),'name');
		$datas = array(
				'name' 	=> $this->request->getPost('name'),
				'description' 	=> $this->request->getPost('description'),
				'location_id' 	=> $this->request->getPost('location_id'),
				'equipment_type_id' 	=> $this->request->getPost('equipment_type_id'),
				'rent_amount' 	=> $this->request->getPost('rent_amount'),
				'serial_number' 	=> $this->request->getPost('serial_number'),
				'functional_condition' 	=> $this->request->getPost('functional_condition'),
				'expriment_no_before_service' 	=> $this->request->getPost('expriment_no_before_service'),
				'status' 	=> $this->request->getPost('status'),
				'is_for_borrowing' 	=> $this->request->getPost('borrowing'),
				'created_by' 	=> session()->get('USER_NAME'),
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('equipments',$fields,$value)) {			
			if ($this->Common_model->addRecord('equipments', $datas)) {
				session()->setFlashData('msg', 'Equipment added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"equipments  added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No equipments Added"));
			}
		} else {
			$datas = array(
					'name' 	=> $name,
					'description' 	=> $this->request->getPost('description'),
					'location_id' 	=> $this->request->getPost('location_id'),
					'equipment_type_id' 	=> $this->request->getPost('equipment_type_id'),
					'rent_amount' 	=> $this->request->getPost('rent_amount'),
					'serial_number' 	=> $this->request->getPost('serial_number'),
					'functional_condition' 	=> $this->request->getPost('functional_condition'),
					'expriment_no_before_service' 	=> $this->request->getPost('expriment_no_before_service'),
					'status' 	=> $this->request->getPost('status'),
					'is_for_borrowing' 	=> $this->request->getPost('borrowing'),
					'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('equipments',$datas,$where)) {
				session()->setFlashData('msg', 'equipments Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"equipments Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on item locations"));
			}
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='equipments'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Name','Description','Type','Location','Cost','Can be borrow','Availability');
		$data['mapData'] = array('name'=>'L','description'=>'L','itemTypeName'=>'L','locationName'=>'L','rent_amount'=>'L','is_for_borrowing'=>'L','status'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT equipments.*,item_locations.name as locationName,
						equipment_types.name as itemTypeName
						FROM equipments inner join item_locations on item_locations.id=location_id
						inner join equipment_types on equipment_types.id=equipment_type_id
			";
		$data['addNew'] = array('do_equipments','id','delete_equipment');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/Admin/items/index','id');
			$data['deleteURI'] = array(site_url().'items/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'equipments Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('equipments',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('equipments','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"equipment deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"equipment could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"equipment locations is not found");
		}
		echo json_encode($response);
	}	
}
