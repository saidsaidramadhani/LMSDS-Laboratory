<?php 

namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UsersModel;
use App\Models\Login_model as Login_model;
use App\Models\Common_model as Common_model;
use App\Libraries\Department_menu;


class Dashboard extends BaseController {

    protected $Login_model;
    protected $Common_model;
  
    public function __construct(){
    
        helper(['url','form']);
        $this->usersModel = new usersModel();
        $this->Login_model = new Login_model;
        $this->Common_model = new Common_model;  
 
    }


    /****************Function login**********************************
     * @type            : Function
     * @function name   : index
     * @description     : This redirect to dashboard automatically 
     *                    
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
	 
    public function index(){
		
        //$data = array();
		
        

        $mymenu = session()->get('USER_MENU');
        $libraryName = ucfirst($mymenu).'()'; 
        $libraryName = "Department_menu()";        
        $menu = new Department_menu();
        $data['menu'] = $menu->menu();        

		//$ayearid			=	$this->Admission_model->get_field_val('academic_year',array('astatus'=>1),'yearid');		

        $data['page_title']   = 'Dashboard';
		
		$username		=	session()->get('USERNAME');
			
		

			$greet	='<div id="page-wrapper">
            <div class="container-fluid">
						  
						  </div>
					  </div>';
			$greet	='<div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <h3 class="m-b-0 box-title">Headings</h3>
                                    <p class="text-muted">Use tags <code>h1 to h6</code> for get desire heading.</p>
                                    <h1>h1. Bootstrap heading</h1>
                                    <h2>h2. Bootstrap heading</h2>
                                    <h3>h3. Bootstrap heading</h3>
                                    <h4>h4. Bootstrap heading</h4>
                                    <h5>h5. Bootstrap heading</h5>
                                    <h6>h6. Bootstrap heading</h6>
                                </div>
						  </div>
						  </div>
						  </div>
					  </div>';
            $data['system_name']		=	$this->Common_model->get_field_val('settings', ['type' => 'system_name'],'description');	
            $data['system_title']		=	$this->Common_model->get_field_val('settings', ['type' => 'system_title'],'description');	
            $data['count'] 		        = session()->get('user_name');
			$data['main_content']       = view('admin/home2', $data);
			$data['page_title']         = session()->get('user_name');
			$data['dyn_table'] 	        = view('admin/home2', $data);
		//}
		//}		
        echo view('admin/Index', $data);
    }


/****************Function login**********************************
     * @type            : Function
     * @function name   : backup
     * @description     : Force database to be downloaded. 
     *                    if user or admin click on download button.
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
	 
    public function backup($fileName='db_backup.zip'){
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('file');
        write_file(FCPATH.'/downloads/'.$fileName, $backup);
        $this->load->helper('download');
        force_download($fileName, $backup);
    }

}