<?php 

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\inc\Multi_model as Multi_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;
use App\Libraries\Form as MyForm;

use App\Libraries\CI4FormBuilder\Form;
use App\Libraries\CI4FormBuilder\Input;
use App\Libraries\CI4FormBuilder\Label;
use App\Libraries\CI4FormBuilder\Submit;
use App\Libraries\CI4FormBuilder\AbstractComponent;

class Systems extends BaseController {

    protected $Multi_model;
    protected $Common_model;
  
    public function __construct(){
    
        helper(['url','form']);
        $this->Multi_model = new Multi_model;
        $this->Common_model = new Common_model;  
 
    }	
	
	public function index()
	{	

		$mymenu=session()->get('USER_MENU');
        $menu = new Department_menu();
        $data['menu'] = $menu->menu(); 
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

		//courses.inst_unitid='".session()->get('USER_DEPT')."'
		
		// $id_value 	= $this->uri->segment(4,-99);
		$id_value 	= service('uri')->getSegment(2, -99);
		//$program 	=   $this->Common_model->fill_combo('program_cats','programcatid','sname');
		//$where		=	array('inst_unitid'=>session()->get('USER_DEPT'));
		//$units	 	=   $this->Common_model->fill_combo_where('inst_units','inst_unitid','usname',$where);
		$data['page_title'] 	= 'System Settings';	
		$data['system_name'] 		=	$this->Common_model->get_field_val('settings',array('key'=>'system_name'),'value');
		$data['short_name'] 		=	$this->Common_model->get_field_val('settings',array('key'=>'short_name'),'value');

		if ($this->request->getPost('show')=='Show') {

			$data	=	$this->showrec($data);
			//$data['frm'] 		= $form->get(); // this returns the validated form as a string		
			echo view('admin/Add', $data);
		}elseif (($this->request->getPost('update')=='Update') || ($this->request->getPost('update')=='Save')) {
			//$form->validate();
			//if ($form->valid)  
				$this->process();
			$data	=	$this->showrec($data);
			echo view('admin/Add', $data);
		} else {
			//$data['frm'] 		= $form->get(); // this returns the validated form as a string		

			$data	=	$this->showrec($data);
			
			echo view('admin/Add', $data);
			echo view('admin/modals/md_settings');

		}

	}
	
	public function ajax_edit($id)
	{
		$sql = "SELECT *
				FROM settings
				where id='".$id."'";
		$query 	= 	$this->Common_model->run_query($sql);
		if ($query) {
			foreach ($query->getResult() as $rowz) {
				$data['key'] 		= 	$rowz->key;	
				$data['valuez'] 	= 	$rowz->value;	
				$data['context'] 	= 	$rowz->context;	
				$data['settingid'] 	= 	$id;	
				
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
		//'ayearid' 	=> $this->input->post('cohots'),
		//'sdate' 	=> $rdate,
		//				'context' 	=> $_SESSION['USER_NAME'],
		$rdate					=	date('Y-m-d H:i:s');
		$id						=	$this->request->getPost('settingid');
		$datas = array(
				'key' 	=> $this->request->getPost('key'),
				'class' 	=> $this->request->getPost('key'),
				'value' 	=> $this->request->getPost('valuez'),
				'context' 	=> $this->request->getPost('context'),
				'type' 	=> 'string',
				'created_at' 	=> $rdate,
				'updated_at' 	=> $rdate,
				'type' 	=> 'string'
		);
		
		$fields				=	array('id');	
		$value				=	array($id);
		
		if (!$this->Common_model->isDuplicate('settings',$fields,$value)) {			
			if ($this->Common_model->addRecord('settings', $datas)) {
				session()->setFlashData('msg', 'Settings added successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"Settings added successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Settings Added"));
			}
		} else {
			$datas = array(
					'key' 	=> $this->request->getPost('key'),
					'class' 	=> $this->request->getPost('key'),
					'value' 	=> $this->request->getPost('valuez'),
					'context' 	=> $this->request->getPost('context'),
					'type' 	=> 'string',
					'updated_at' 	=> $rdate,
					'type' 	=> 'string'
			);			
			$where 		=	array('id'=>$id);
			if ($this->Common_model->updateRecord('settings',$datas,$where)) {
				session()->setFlashData('msg', 'Setting Changed successfully');
				echo json_encode(array("status" => TRUE,"msg"=>"Settings Changed successfully"));
			} else {
				echo json_encode(array("status" => FALSE,"msg"=>"No Changes on Settings"));
			}
		}
		
	}	
	
	function showrec($data) {
		
		$_SESSION['ROUTE_NO'] ='systems'; //the route configuration in config/routes.php for this controller		
		$data['headData'] = array('S/No','Key','Value','Context');
		$data['mapData'] = array('key'=>'L','value'=>'L','context'=>'L');
		$data['addTags'] = array('recorder'=>session()->get('USER_NAME'),'recordtime'=>date('Y-m-d h:m:s'));
		$action = array('col_edit'=>TRUE,'col_del'=>TRUE); //to show/hide'edit' and'delete' (action) column respectively
		$ref_tables = array(); //fields and tables to check before enable delete link.
		
		$sql		=	"SELECT * FROM settings 
			";
		$data['addNew'] = array('do_settings','id','delete_setting');		
		//$query = $this->my_pay_fee_model->get_Records($where_arr);
		$query		=   $this->Common_model->run_query($sql);		
		if ($query) {
			$data['queryData'] = $this->Multi_model->showRecords($query, $action, $ref_tables);
			$data['editURI'] = array(site_url().'/mo_dept/systems/index','id');
			$data['deleteURI'] = array(site_url().'systems/delete','id');
			$data['dyn_table'] = view('inc/dyn_table', $data);
		} else {
			$data['dyn_table'] = view('inc/dyn_table', $data);
		}
		session()->setFlashData('msg', 'Setting Changed successfully');
		$data['title'] = "LAB";
		return $data;
	}

	public function delete($id)
	{
		$rdate					=	date('Y-m-d H:i:s');
		$fields				=	array('id');	
		$values				=	array($id);	
		
		$response=array("status" => FALSE);

		if ($this->Common_model->isDuplicate('settings',$fields,$values)) {			
			$wheres			=	array('id'	=>	$id);							
			$aff_rows = $this->Common_model->deleteRecord('settings','id', $id);
			if ($aff_rows) {
				$response=array("status" => TRUE,"msg"=>"Setting deleted successfully");
			} else {
				$response=array("status" => FALSE,"msg"=>"Setting could not be deleted");
			}
		} else {
				$response=array("status" => FALSE,"msg"=>"Setting is not found");
		}
		echo json_encode($response);
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */