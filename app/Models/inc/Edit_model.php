<?php
class Edit_model extends CI_Model {

	
	public function __construct() {
	
		$this->load->database();
		
	}

	function get_Campus($where_arr, $action=array('col_edit'=>TRUE,'col_del'=>TRUE), $ref_tables=array()) {
	    		
		$where	=	'';	
		if(isset($where_arr) && is_array($where_arr)) {
			$where = " WHERE ";
			foreach($where_arr as $key => $value) {
					$where .= $key." like '".$value."' AND ";
			}		
			$where = substr_replace($where ,"",-5); //remove the last'AND' with its surrounding spaces i.e. remove the last' AND'
		
		}
		
		$sql = "SELECT unitcatname,ucode,unitcatid,
				inst_units_cats.unitcatname,collname 
				FROM 
				collage 
				INNER JOIN inst_units_cats ON (inst_units_cats.collageid=collage.collageid)
				".$where;
				
		$query 	= 	$this->db->query($sql);
		
		if ($query->num_rows() > 0) {
			return $query;
		} else {
			return false;
		}
	}
	
	function edit_Campus($id) {
	
		$sql = "SELECT * FROM inst_units_cats where unitcatid=".$id;
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {		
			$row = $query->row_array(); 
				$data = array(
				'unitcatid'=>$row['unitcatid'],
				'ccode'=>$row['ucode'],
				'cname'=>$row['unitcatname']);
		return $data;
		}
	}	
	function edit_subjects($id) {
	
		$sql = "SELECT * 
		FROM ona_qualify_sub 
		WHERE qua_subid=".$id;

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {		
			$row = $query->row_array(); 
				$data = array(
				'sub_code'		=>	$row['sub_code'],
				'qua_sub_name'		=>	$row['qua_sub_name'],
				'qualification'		=>	$row['qualificationid'],
				'qua_subid'		=>	$row['qua_subid']);
		return $data;
		}
	}			
	
	function edit_nacteapi($id) {
	
		$sql = "SELECT * 
		FROM nacte_api 
		WHERE nacteid=".$id;

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {		
			$row = $query->row_array(); 
				$data = array(
				'apiname'		=>	$row['apiname'],
				'apivalue'		=>	$row['apivalue'],
				'collageid'		=>	$row['collageid'],
				'desc'			=>	$row['desc'],
				'nacteid'		=>	$row['nacteid']);
		return $data;
		}
	}		
	
	function edit_district($id) {
	
		$sql = "SELECT * 
		FROM districts 
		WHERE districtid=".$id;

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {		
			$row = $query->row_array(); 
				$data = array(
				'districtid'	=>	$row['districtid'],
				'districtname'	=>	$row['districtname'],
				'regionid'		=>	$row['regionid']);
		return $data;
		}
	}		
	
	function edit_cohot($id) {
	
		$sql = "SELECT * 
		FROM academic_year 
		WHERE yearid=".$id;
		$sql	=	"select yearid,acyear,end,status,
					astatus,a_enddate
					from academic_year 
					where yearid like '%".$id."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {		
			$row = $query->row_array(); 
					$data = array(
						'status'		=>$row['status'],
						'astatus'		=>$row['astatus'],
						'end'			=>$row['end'],
						//'astartdate'		=>$row['a_startdate'],
						'aenddate'		=>$row['a_enddate'],
						//'cyear'			=>$row['cyear'],
						'acyear'		=>$row['acyear']
					);
		return $data;
		}
	}	

	function get_student($where_arr, $action=array('col_edit'=>TRUE,'col_del'=>TRUE), $ref_tables=array()) {

		$where='';
		
		$query	=	false;
		if(isset($where_arr) & is_array($where_arr)) {
			$where = " WHERE ";
			foreach($where_arr as $key => $value) {
					$where .= $key." like'%".$value."%' AND ";
			}		
			$where = substr_replace($where ,"",-5); //remove the last'AND' with its surrounding spaces i.e. remove the last' AND'
	    }
	
			$sql = "SELECT studentid,students.regno, firstname,midname,surname,sexid,maritalid,programcode,students.countryid,
					countryname,regioncode,districtid,address,phone,fax,email,entrycatid,disabid,disabdescr,acyear,sexid,index_no,centers,entry
					FROM students 
					LEFT JOIN countries ON countries.countryid=students.countryid ".$where;
			
			$query = $this->db->query($sql);
	return $query;
	}	
	
	function edit_student($id) {
	
		$sql = "SELECT * 
		FROM students 
		WHERE studentid=".$id;

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {		
			$row = $query->row_array(); 
				$data = array(
				'reg_no'	=>	$row['regno'],
				'index_no'	=>	$row['index_no'],
				'surname'	=>	$row['surname'],
				'midname'	=>	$row['midname'],
				'firstname'	=>	$row['firstname'],
				'address'	=>	$row['address'],
				'fax'		=>	$row['fax'],
				'disabdescr'=>	$row['disabdescr'],
				'phone'		=>	$row['phone'],
				'studyyear'		=>	$row['studyyear'],
				'email'		=>	$row['email'],
				'sexid'		=>	$row['sexid'],
				'intake'	=>	$row['intake'],
				'regioncode'=>	$row['regioncode'],
				'datepicker'=>	$row['birthdate'],
				'datepickers'=>	$row['admindate'],
				'datepicker1'=>	$row['enddate'],
				'maritalid'	=>	$row['maritalid'],
				'programcode'=>	$row['programcode'],
				'districtid'=>	$row['districtid'],
				'entrycatid'=>	$row['entrycatid'],
				'disabid'	=>	$row['disabid'],
				'acyear'	=>	$row['acyear'],
				'status'	=>	$row['discont'],
				'photo'		=>	$row['photo'],
				'status'	=>	$row['discont'],
				'verified'	=>	$row['verified'],
				'countryid'	=>	$row['countryid']);
		return $data;
		}
	}	

    function get_app_summary($acyear){
        $this->db->select('ayearid');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(ona_applicants.applicantno)
                            FROM ona_applicants 
                            WHERE (sexid <> 2 and ayearid="'.$acyear.'")
                            )
                            AS male',TRUE);

        $this->db->select('(SELECT count(ona_applicants.applicantno)
                            FROM ona_applicants 
                            WHERE (sexid = 2 and ayearid="'.$acyear.'"))
                            AS female',TRUE);

        $this->db->from('ona_applicants');
        $this->db->where('ayearid',$acyear);
        $this->db->group_by(array('ayearid'));
        $query = $this->db->get();
        //$query = $query->row();  
        return $query;
    }
	
}
?>