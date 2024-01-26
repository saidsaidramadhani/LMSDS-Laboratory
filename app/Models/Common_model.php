<?php
namespace App\Models;

use CodeIgniter\Model;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Common_model extends Model {

	function audit($mod, $act,$desc,$recorder, $rectime) {
		
 		$namespace = Uuid::NAMESPACE_DNS; // You can use other namespaces as needed
		$name = $table.'-'.date('Y-m-d H:i:s'); // Replace with your logic for generating a custom string
		$uuid = Uuid::uuid5($namespace, $name)->toString();		
		//$data['uid']=$uuid; 
		
		$data 	=	array('module'		=>	$mod,
						  'uid'		=>	$uuid,	
						  'action'		=>	$act,	
						  'description'	=>	$desc,	
						  'recorder'	=>	$recorder,	
						  'recordtime'	=>	$rectime	
		);
		
		$query = $this->db->insert('audit', $data);		
		if(($this->db->affected_rows() >0)) {
			return true;
		}
		return false;		
		
	}
	
	function trunc($num, $digits = 0) {
	  $shift = pow(10 , $digits);
	  $shift = $digits;
	  return ((floor($num * $shift)) / $shift);
	  //return number_format($num,1);
	}	
	
	function create_time_range($starttime, $duration,$break) {

		$break=$break.' mins';
		$interval=($duration*60).' mins';
		$starttime = strtotime($starttime);
		$start_time = strtotime('+'.$break, $starttime);
		$end_time = strtotime('+'.$interval, $start_time);
		$starttime = date('H:i',$start_time);
		$endtime = date('H:i',$end_time);
		$lecture_hour=$starttime.'-'.$endtime;
		return array($lecture_hour,$endtime);
	}

	function isDuplicate($table_name, $field_name, $where)
	{
		if (is_array($field_name)) {
			$where_arr = array_combine($field_name, $where);
		} else {
			$where_arr = array($field_name => $where);
		}

		$query = $this->db->table($table_name)->where($where_arr)->get();
		//$query = $this->db->table($table_name)->get();
		//$results	=	$query->where($where_arr);
		$resultz	=	$query->getResult();
		if (count($resultz)>0) {
			return true;
		}

		// Handle database error if needed
		return false;
	}

	function is_dublicate($table_name, $field_name,$where) {

		if (is_array($field_name))
			for($fld=0; $fld < sizeof($field_name); $fld++) {
				$field				=	$field_name[$fld];
				$where_arr[$field]	=	$where[$fld];
			}
		else
				$where_arr	=	array($field_name=>"$where");
		$query   = $this->db->table($table_name);
		$query 	= $this->db->where($where_arr);
		$result	=	$query->getResult();
		
		//if($query->result()){
		if(count($result)>0){
 		
				$autoid	= true;

		} else {
			$autoid = false;
		}
		return $autoid;
	}
	
	function run_query($sql) {
		
	  	$bind_params = array();				
		$query = $this->db->query($sql, $bind_params);

		$result = $query->getResult();

		if (count($result) > 0) {
			return $query;
		} else {
			return false;
		}
	}

	function run_query_count($sql) {
	  					
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {		
			return $query->num_rows();
		} else
			return false;	
	}	
	function Convert_bala($stotal) {

		if (isset($stotal)) {
			if ($stotal<0)
				$stotal		=	'('.number_format(-$stotal,2).')';
			else
				$stotal		=    number_format($stotal,2);
		}
		return $stotal;
	}
	
	function GetMax($table_name, $field_name,$where) {

		$this->db->select_max($field_name,'ma');
		$query = $this->db->get_where($table_name,$where);
		
		if($query->result()){
			$row=$query->row();
			$autoid = $row->ma;
		}else{
			$autoid = false;
		}
		return $autoid;
	}

	function GetSum($table_name, $field_name,$where) {

		$this->db->select_sum($field_name,'ma');
		$query = $this->db->get_where($table_name,$where);
		
		if($query->result()){
			$row=$query->row();
			$autoid = $row->ma;
		}else{
			$autoid = 0;
		}
		return $autoid;
	}
	
	//gen_username($regno, $stdname)	
	function gen_username($regno, $stdname)
	{	
		//get the Reg. No part for the username:
		$regno_part = str_replace("/","",$regno);
		$regno_part = trim(str_replace(".","",$regno_part));
		$username = str_replace(",","",strtolower($regno_part));
		$username = str_replace("'","",$username);
		return $username;
	}

	function is_user_exist($username)
	{	
		$userexist=0;
		$sql = "select userno from security where username='$username'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$userexist=1;
		}
		return $userexist;
	}
	
	function getArrVal($str)
	{
		$val='';
		if (is_array($str)) {
		foreach ($str as $keys => $value)
		    $val.=$value;
		} else
			$val=$str;
		return $val;
	}    

	function getArrKey($str)
	{
		$val='';
		if (is_array($str)) {
		foreach ($str as $keys => $value)
		    $val.=$keys;
		} else
			$val=$str;
		return $val;
	}    
	
	function get_displays($tablename,$data,$where){
	
		$this->db->where($where);
		$query = $this->db->get($tablename);
		$display = array();
		$display=$data;
		
		if($query->result()){
			foreach ($query->result() as $row) {
				foreach($data as $key => $value) { 
				   $_POST[$key]=$row->$value;
				}
			}
			
			return true;
		} else {
			return FALSE;
		}
	}

	function con_fields($sql,$fields) {

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
		   $row = $query->row();
		   $field= $row->$fields;
		} else
           $field='';
		return  $field;
	}

	
	function get_field($tablename,$data,$where,$field){
	
		//$this->db->select($where);
		$this->db->where($where);
		$query = $this->db->get($tablename);
		$display = array();
		$display=$data;
		
		if($query->result()){
			foreach ($query->result() as $row) {
				   $fields=$row->$field;
			}
			
			return $fields;
		} else {
			return'';
		}
	}

	function is_odd( $int )
	{
	  return( $int & 1 );
	}
	
	public function get_field_val($tablename, $where, $field)
	{
		// $this->db->where($where);
		// $query = $this->db->get($tablename);
		$query = $this->db->table($tablename);
		$query->where($where);
		$result = $query->get();

		if ($result->getResult()) {
			$row = $result->getRow();
			$fields = $row->$field;
			return $fields;
		} else {
			return '';
		}
	}
	
	public function returnAutoidW($table_name, $field_name, $where)
	{
		$this->db->selectMax($field_name, 'ma');
		$query = $this->db->getWhere($table_name, $where);
	
		if ($query->getResult()) {
			$row = $query->getRow();
			$autoid = $row->ma;
			$autoid = ++$autoid;
		} else {
			$autoid = 1;
		}
		return $autoid;
	}
	
	function returnAutoid($table_name, $field_name) {

		$sql = "SELECT MAX($field_name) as ma FROM $table_name;";
		$query = $this->db->query($sql);
		if($query->getResult()){
			$row=$query->getRow();
			$autoid = $row->ma;
			$autoid	=++$autoid;
		}else{
			$autoid = 1;
		}
		return $autoid;
	}
        function returnAutoLike($table_name, $field_name,$like) {

                $sql = "SELECT MAX($field_name) as ma FROM $table_name where $field_name like '".$like."%';";
                $query = $this->db->query($sql);
                if($query->getResult()){
                        $row=$query->getRow();
                        $autoid = $row->ma;
                        $autoid =++$autoid;
                }else{
                        $autoid = 1;
                }
                return $autoid;
        }	
	function fill_array($table,$id,$name,$where){
	
		$this->db->order_by($name,'desc');
		$this->db->where($where);
		$query = $this->db->get($table);
		$fills = array();
		//$fills['']='--Select--';
		if($query->result()){
			foreach ($query->result() as $fill) {
				$fills[$fill->$id] = $fill->$name;
			}
			return $fills;		
		}else{
			return false;
		}
	}

	
	function fill_combo_lang($table,$id,$name){
	
		$lang		=	$this->session->userdata('language');		
		$this->lang->load($lang, $lang);
		
		$this->db->order_by($id);
		$query = $this->db->get($table);
		$fills = array();
		$fills['']='--Select--';
		if($query->result()){
			foreach ($query->result() as $fill) {
				$tttt	=	$fill->$name;				
				$fills[$fill->$id] = $this->lang->line($tttt);
			}
			return $fills;		
		}else{
			return $fills;
		}
	}
	
	
    public function fill_combo($table, $id, $name)
    {
        $builder = $this->db->table($table);
        $builder->orderBy($name, 'desc');
        $query = $builder->get();
        $fills = ['' => '--Select--'];

        if ($query->getResult()) {
            foreach ($query->getResult() as $fill) {
                $fills[$fill->$id] = $fill->$name;
            }
        }

        return $fills;
    }

    public function fill_combo_array($table, $id, $name)
    {
        $builder = $this->db->table($table);
        $builder->orderBy($name, 'desc');
        $query = $builder->get();
        $fills = ['' => '--Select--'];

        if ($query->getResult()) {
            foreach ($query->getResult() as $fill) {
				$val='';
				//if (is_array($name)) {
				foreach ($name as $keys => $value) {
					if ($val=='')
						$val	.=	$fill->$value;
					else
						$val	.=	'-'.$fill->$value;
				}
				$fills[$fill->$id] = $val;
            }
        }

        return $fills;
    }	


	
	function fill_combo_where($table,$id,$name,$where){

        $builder = $this->db->table($table);
		$builder->where($where);
        $builder->orderBy($name, 'desc');
        $query = $builder->get();
        $fills = ['' => '--Select--'];

        if ($query->getResult()) {
            foreach ($query->getResult() as $fill) {
                $fills[$fill->$id] = $fill->$name;
            }
        }		
	
		return $fills;
	}

	function fill_combo_where_order($table,$id,$name,$where,$order){
	
		$this->db->order_by($order,'desc');
		$this->db->where($where);
		$query = $this->db->get($table);
		$fills = array();
		$fills['']='--Select--';
		if($query->result()){
			foreach ($query->result() as $fill) {
				$fills[$fill->$id] = $fill->$name;
			}
			return $fills;		
		}else{
			return $fills;
		}
	}
	
	function fill_combo_join($table,$id,$name,$where,$table2,$on){
	
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $on);
		
		$this->db->where($where);
		$query = $this->db->get();
		$fills = array();
		$fills['']='--Select--';
		
		if($query->result()){
			foreach ($query->result() as $fill) {
				$fills[$fill->$id] = $fill->$name;
			}
			return $fills;		
		}else{
			return $fills;
		}
	}	

	function fill_combo_programs(){
	
		$sql			=	"SELECT programs.programid,programs.sname 
							FROM programs 
							INNER JOIN program_cats 
							ON program_cats.programcatid=programs.programcatid 
							WHERE appstatus = 1";
		$sql			=	"SELECT programs.programid,programs.sname 
							FROM programs 
							"; 
							
		$fills = array();
		$fills['']='--Select--';
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {			
			foreach ($query->result() as $fill) {
				$fills[$fill->programid] = $fill->sname;
			}
			return $fills;		
		} else
			return $fills;
		
	}	
	
	function fill_combo_sql($sql,$id,$name){
			
		$query 		= 	$this->db->query($sql);		
		$fills 		= 	array();
		$fills['']='--Select--';
		if($query->result()){
			foreach ($query->result() as $fill) {
				$fills[$fill->$id] = $fill->$name;
			}
			return $fills;		
		}else{
			return $fills;
		}
	}
	
	function fill_combo_name($table,$id,$name1,$name2,$name3,$where){
	
		//$this->db->select($name1,$name2,$name3,$id);
		$this->db->where($where);
		$query = $this->db->get($table);
		$fills = array();
		$fills['']='--Select--';
		if($query->result()){
			foreach ($query->result() as $fill) {
				$fills[$fill->$id] = $fill->$name3." ".$fill->$name1." ".$fill->$name2;
			}
			return $fills;		
		}else{
			return $fills;
		}
	}

	function get_display($tablename,$data,$where){
	
		$this->db->where($where);
		$query = $this->db->get($tablename);
		$display = array();
		$display=$data;
		
		if($query->result()){
			foreach ($query->result() as $row) {
				foreach($data as $key => $value) { 
				   $_POST[$value]=$row->$value;
				}
			}
			
			return true;
		} else {
			return FALSE;
		}
	}

    public function addRecord($table, $data)
    {

 		$namespace = Uuid::NAMESPACE_DNS; // You can use other namespaces as needed
		$name = $table.'-'.date('Y-m-d H:i:s'); // Replace with your logic for generating a custom string
		$uuid = Uuid::uuid5($namespace, $name)->toString();		
		$data['uid']=$uuid; 
		$uuid = Uuid::uuid4()->toString();
		$data['uid']=$uuid; 
		
        $result = $this->db->table($table)->insert($data);

        if ($result)
        {
            return $this->db->insertID(); // Return the last inserted ID if needed
        }

        return false;
    }

    public function addRecords($table, $data)
    {
 		//$namespace = Uuid::NAMESPACE_DNS; // You can use other namespaces as needed
		//$name = $table.'-'.date('Y-m-d H:i:s'); // Replace with your logic for generating a custom string
		//$uuid = Uuid::uuid5($namespace, $name)->toString();		
		$uuid = Uuid::uuid4()->toString();
		$data['uid']=$uuid; 
		
        $this->db->table($table)->insertBatch($data);

        return $this->db->affectedRows();
    }
	
    public function updateRecord($table, $data, $where)
    {
		$query 		= $this->db->table($table);
		$results	=	$query->update($data, $where);
        //$this->db->where($where);
        //$this->db->update($table, $data);
		//$result		=	$results->affectedRows();
        if ($results) {
            return true; // Record updated successfully
        }

        return false; // No records updated
    }

    public function updateRecords($table, $data, $where)
    {
		$query 		= $this->db->table($table);
		$results	=	$query->update($data, $where);
        $affRows = $results->affectedRows();

        return $affRows;
    }
	
	
	function deleteRecordByArray($table, $where) {
		$this->db->where($where);
		$this->db->delete($table);
		if(($this->db->affected_rows() >0)) {
			return true;
		}
		return false;
	}

	function deleteRecord($table, $id_field, $id_value) { //function to delete any record from any table in the system		
				
		$query 		= $this->db->table($table);
		$results	=	$query->where($id_field, $id_value);
		$affRows	=	$query->delete();
        //$affRows 	= 	$results->affectedRows();
		return $affRows;
	}
	
	function deleterecords($table, $where) {
		$this->db->where($where);
		$this->db->delete($table);
		$affrow	=	$this->db->affected_rows();
		if(($affrow >0)) {
			return $affrow;
		}
		return false;
	}

	function records($table, $where_arr) { //function to count records in any table based on a specified criteria
		
		$query = $this->db->get_where($table, $where_arr); // this could not do well as it escapes the values wrongly!		
		$count = $query->num_rows();		
		return $count;
	}	
	
	public function inserts($data,$table){

 		$namespace = Uuid::NAMESPACE_DNS; // You can use other namespaces as needed
		$name = $table.'-'.date('Y-m-d H:i:s'); // Replace with your logic for generating a custom string
		$uuid = Uuid::uuid5($namespace, $name)->toString();		
		$data['uid']=$uuid; 
		
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    //-- edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    //-- update function
    public function updates($action, $id, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $action);
        return;
    }

    //-- delete function
    function deletes($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    //-- user role delete function
    function delete_user_role($id,$table){
        $this->db->delete($table, array('user_id' => $id));
        return;
    }


    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    //-- check user role power
    function check_power($type){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $this->session->userdata('id'));
        $this->db->where('ur.action', $type);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    public function check_email($email){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    public function check_exist_power($id){
        $this->db->select('*');
        $this->db->from('user_power');
        $this->db->where('power_id', $id); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }


    //-- get all power
    function get_all_power($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('power_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get logged user info
    function get_user_info(){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$this->session->userdata('id'));
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get single user info
    function get_single_user_info($id){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- get single user info
    function get_user_role($id){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id',$id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    //-- get all users with type 2
    function get_all_user(){
        $this->db->select('u.*');
        $this->db->select('c.name as country, c.id as country_id');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    //-- count active, inactive and total user
    function get_user_total($yearid){
        $this->db->select('applicantid');
        $this->db->select('count(ona_applicants.applicantno) as total');
        $this->db->select('(SELECT count(ona_applicants.applicantno)
                            FROM ona_applicants
                            WHERE (ayearid="'.$yearid.'")
							and applicantid in (select ona_programs.programid from ona_programs
							inner join programs on ona_programs.programid=programs.programid
							inner join inst_units on inst_units.inst_unitid=programs.inst_unitid
							where inst_units.collageid="'.$_SESSION['COLLAGE'].'"
							)
                            )
                            AS allapp',TRUE);
        $this->db->select('(SELECT count(ona_applicants.applicantno)
                            FROM ona_applicants
                            WHERE (admitted = 1 and ayearid="'.$yearid.'")
							and applicantid in (select ona_programs.programid from ona_programs
							inner join programs on ona_programs.programid=programs.programid
							inner join inst_units on inst_units.inst_unitid=programs.inst_unitid
							where inst_units.collageid="'.$_SESSION['COLLAGE'].'"
							)
                            )
                            AS registered',TRUE);
        $this->db->select('(SELECT count(ona_applicants.applicantno)
                            FROM ona_applicants 
                            WHERE (ona_applicants.selected <>1 and ayearid="'.$yearid.'")
                            )
                            AS unselected',TRUE);
        $this->db->select('(SELECT count(ona_applicants.applicantno)
                            FROM ona_applicants 
                            WHERE (ayearid="'.$yearid.'")
                            )
                            AS allapps',TRUE);

        $this->db->from('ona_applicants');
		$this->db->where('ayearid',$yearid);
		$this->db->group_by(array('ona_applicants.applicantid'));
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- count active, inactive and total user
    function get_user_totals(){
        $this->db->select('discont');
        $this->db->select('count(students.regno) as total');
        $this->db->select('(SELECT count(students.regno)
                            FROM students 
                            WHERE (discont = 1)
                            )
                            AS active_students',TRUE);
        $this->db->select('(SELECT count(students.regno)
                            FROM students 
                            )
                            AS all_students',TRUE);

        $this->db->select('(SELECT count(students.regno)
                            FROM students 
                            WHERE (students.discont =7)
                            )
                            AS graduate',TRUE);
        $this->db->select('(SELECT count(students.regno)
                            FROM students 
                            WHERE (students.discont =6)
                            )
                            AS supp',TRUE);

        $this->db->select('(SELECT count(students.regno)
                            FROM students 
                            WHERE (students.discont =5)
                            )
                            AS failed',TRUE);

        $this->db->from('students');
		$this->db->group_by(array('students.discont'));
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //-- image upload function with resize option
    function upload_image($max_size){
            
            //-- set upload path
            $config['upload_path']  = "./assets/images/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                //-- set upload path
                $source             = "./assets/images/".$data['file_name'] ;
                $destination_thumb  = "./assets/images/thumbnail/" ;
                $destination_medium = "./assets/images/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 200 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                //-- set upload path
                $images = 'assets/images/medium/'.$mid;
                $thumb  = 'assets/images/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }
	
	
}
?>