<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;

use CodeIgniter\HTTP\ResponseInterface;

class Laboratories extends BaseController
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


		//courses.inst_unitid='".session()->get('USER_DEPT')."'
		
		// $id_value 	= $this->uri->segment(4,-99);
		$id_value 	= service('uri')->getSegment(2, -99);
		//$program 	=   $this->Common_model->fill_combo('program_cats','programcatid','sname');
		//$where		=	array('inst_unitid'=>session()->get('USER_DEPT'));
		//$units	 	=   $this->Common_model->fill_combo_where('inst_units','inst_unitid','usname',$where);
		$data['page_title'] 	= 'Laboratories';	
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
			echo view('admin/modals/md_laboratories');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM laboratories
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['name'] 		= 	$rowz->name;	
				$data['description'] 	= 	$rowz->description;	
				//$data['school_id'] 	= 	$rowz->school_id;	
				$data['laboratory_id'] 	= 	$id;	
				
			}
		} else {
			$data =	array(
			);
			
		}

/* 		$sql = "SELECT id, name
				FROM schools
				order by name
				";
		
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$schoolArray[] = array("id" => $rowz->id, "name" => $rowz->name);
			}
		}
		$data['schools'] 	=	$schoolArray; */

		echo json_encode($data);
		//echo $data;
	}
	
	public function ajax_update()
	{
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('laboratory_id');
		$datas = array(
				'name' 	=> $this->request->getPost('name'),
				'description' 	=> $this->request->getPost('description'),
				//'school_id' 	=> $this->request->getPost('school_id'),
				'created_by' 	=> session()->get('USER_NAME'),
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('laboratories',$fields,$value)) {			
			if ($this->Common_model->addRecord('laboratories', $datas)) {
				session()->setFlashData('msg', 'laboratories added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"laboratory added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No laboratory Added"));
			}
		} else {
			$datas = array(
					'name' 	=> $this->request->getPost('name'),
					'description' 	=> $this->request->getPost('description'),
					//'school_id' 	=> $this->request->getPost('school_id'),
					'updated_at' 	=> $rdate
			);		
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('laboratories',$datas,$where)) {
				session()->setFlashData('msg', 'laboratories Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"laboratory Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on Schools"));
			}
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='laboratories'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Lab Name','Description');
		$data['mapData'] = array('name'=>'L','description'=>'L');
		$data['addTags'] = array('created_by'=>session()->get('USER_NAME'),'created_at'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array('id|laboratory_id'=>'sections'); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT laboratories.* 
		FROM laboratories 
			";
		$data['addNew'] = array('do_laboratories','id','delete_laboratory');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecord($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/mo_dept/laboratories/index','id');
			$data['deleteURI'] = array(site_url().'laboratories/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'Laboratories Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('laboratories',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('laboratories','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"laboratory deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"laboratory could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"schools is not found");
		}
		echo json_encode($response);
	}	
}
