<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;

class ItemTypes extends BaseController
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
		$data['page_title'] 	= 'Item Types';	
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
			echo view('admin/modals/md_item_types');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM item_types
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 		= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				$data['item_type_id'] 	= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}

		echo json_encode($data);
		//echo $data;
	}
	
	public function ajax_update()
	{
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('item_type_id');
		$datas = array(
				'name' 	=> $this->request->getPost('name'),
				'description' 	=> $this->request->getPost('description'),
				'created_by' 	=> session()->get('USER_NAME'),
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('item_types',$fields,$value)) {			
			if ($this->Common_model->addRecord('item_types', $datas)) {
				session()->setFlashData('msg', 'item type added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"item types added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Settings Added"));
			}
		} else {
			$datas = array(
					'name' 	=> $this->request->getPost('name'),
					'description' 	=> $this->request->getPost('description'),
					'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('item_types',$datas,$where)) {
				session()->setFlashData('msg', 'item types Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"item types Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on item type"));
			}
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='item_types'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Type Name','Description');
		$data['mapData'] = array('name'=>'L','description'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT * FROM item_types 
			";
		$data['addNew'] = array('do_item_types','id','delete_item_type');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/mo_dept/item_types/index','id');
			$data['deleteURI'] = array(site_url().'item_types/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'item types Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('item_types',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('item_types','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"item types deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"item types could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"item types is not found");
		}
		echo json_encode($response);
	}	
}

