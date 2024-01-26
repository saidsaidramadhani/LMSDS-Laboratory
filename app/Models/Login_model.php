<?php
namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model {

	function find_names($str)
	{
	
		

		$ssql	=	"SELECT regno,CONCAT(CONCAT(IF(students.surname='','',CONCAT(UPPER(students.surname),' ')),
					students.firstname),' ', students.midname) as fullname 
					FROM students 
					Where 
					(regno like'%".$str."%' OR 
					CONCAT(CONCAT(IF(students.surname='','',CONCAT(UPPER(students.surname),'')),
					students.firstname),'', students.midname) like'%".$str."%')
					order by regno";
		
					
		$query = $this->db->query($ssql);
		$result = $query;
		
		if ($result->getNumRows() == 1) {
			return $result->getResult();
		} else {
			return false;
		}
	}   

    public function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)',$id);
        $this->db->update($table,$action);
        return;
    }

    //-- check post email
    public function check_email($email){

		$query = $this->db->table('user');
		$query->select('*');
        $query->where('email', $email); 
        $query->limit(1);
		$result = $query->get();
		
		if ($result->getNumRows() == 1) {
			return $result->getResult();
		} else {
			return false;
		}
    }


    // check valid user by id
    public function validate_id($id){

		$query = $this->db->table('user');
        $query->select('*');
        $query->where('md5(id)', $id); 
        $query->limit(1);

		$result = $query->get();
		
		if ($result->getNumRows() == 1) {
			return $result->getResult();
		} else {
			return false;
		}
    }



    //-- check valid user
    function validate_user(){            
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		
		$query = $this->db->table('security');
		$query->select('userno, username, passwd, usercat, security.mod_id as mod_id, mod_dir, mod_lib, mod_name, usermod, inst_unitid, blocked, priv_id');
		$query->join('modules', 'modules.mod_id = security.mod_id');
		$query->where('username', $username);
		$query->where('passwd', md5($password));
		$query->limit(1);
		
		$result = $query->get();
		
		if ($result->getNumRows() == 1) {
			return $result->getResult();
		} else {
			return false;
		}
	}

	public function getRows($where = [])
	{
		if (!empty($where)) {
			$query = $this->db->table('login');
			$query->select('user_id, username, password, email,active');
			//$query->join('modules', 'modules.mod_id = security.mod_id');
			$query->where($where);
	
			$result = $query->get();
	
			if ($result->getNumRows() > 0) {
				return $result->getResult();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function login($username, $password)
	{

		$query = $this->db->table('login');
		$query->select('user_id, username, password, email,active');
		//$query->join('modules', 'modules.mod_id = security.mod_id');
		$query->where('username', $username);
		$query->where('password', md5($password));
		$query->limit(1);
		
		$result = $query->get();
		
		if ($result->getNumRows() == 1) {
			return $result->getResult();
		} else {
			return false;
		}

	}
	//Lst@1234
	//UPDATE `security` SET `passw` = '$2y$10$2.dMECPPdDiVpoJPEH11VuTJmtGQDhjMDm6QT7LO.GGqee/lb9XE.' WHERE `usercat` = 'applicant'
	function uplogin($username,$password)
	{

		$data = [
					   'passwd' => $password
		];

		$this->db->where('username', $username);
		$this->db->update('security', $data); 
		
	}		
	
	function lastlogin($username)
	{

		$data = [
					   'lastlogin' => date('Y-m-d H:i:s')
		];

		$this->db->where('username', $username);
		$this->db->update('security', $data); 
		
	}	

	public function lastpwdtime($username)
	{
		$data = [
			'lastpwdtime' => date('Y-m-d H:i:s')
		];
	
		$this->db->where('username', $username);
		$this->db->update('security', $data);
	}


	function getdeptname($dept)
	{
		$query = $this->db->table('inst_units');
		$query -> select('usname');
		$query -> where('inst_unitid =' . "'" . $dept . "'"); 
		$query -> limit(1);

        $result = $query->get();

        if ($result->getNumRows() > 0) {
            return $result->getResult();
        } else {
            return false;
        }

	}
	
	function getstudent($userno)
	{

		$query = $this->db->table('students');
		$query -> select('studentid,firstname,midname,surname');
		$query -> where('regno =' . "'" . $userno . "'"); 
		$query -> limit(1);

        $result = $query->get();

        if ($result->getNumRows() > 0) {
            return $result->getResult();
        } else {
            return false;
        }

	}
	
	function getstaff($userno)
	{

		$query = $this->db->table('staff');
		$query -> select('staffid,firstname,midname,surname');
		$query -> where('pfno =' . "'" . $userno . "'"); 
		$query -> limit(1);

        $result = $query->get();

        if ($result->getNumRows() > 0) {
            return $result->getResult();
        } else {
            return false;
        }

	}

}