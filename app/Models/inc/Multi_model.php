<?php
namespace App\Models\inc;

use CodeIgniter\Model;

class Multi_model extends Model {
		
	function countRecords($table, $where_arr) { //function to count records in any table based on a specified criteria
			
		$where_str=' WHERE';		
		foreach($where_arr as $key => $value) {		
			$where_str .= $key.''.$value.' AND';		
		}
		
		$where_str = substr_replace($where_str,'', -5);
				
		$sql ='SELECT * FROM'.$table.''.$where_str;		
		$query = $this->db->query($sql);		
		$count = $query->num_rows();				
		return $count;
	}
		

	function showRecords($query, $action, $ref_tables) {
		$results = $query->getResult();
		if (count($results) > 0)  {
				foreach ($query->getResult() as $row) {
					if(empty($ref_tables)) {
						$en_del = TRUE;
					} else {
						foreach($ref_tables as $key => $value) {
							$fk = $row->$key; //fk = foreign key
							$sql2 = "SELECT ".$key." FROM ".$value." WHERE ".$key." ='".$fk."'";
							$query2 = $this->db->query($sql2);
							$results2 = $query2->getResult();
							if(count($results2) > 0) {
								$en_del = FALSE; //$en_del = enable delete
								break;
							} else {
								$en_del = TRUE;
								continue;
							}
						}
					}
					$action['en_del'] = $en_del;
					$data[] = (array)$row + $action; // + PHP union operator to merge arrays ...
				}
		} else {
			$data[] = 0;
		}
		//return $query->result_array();
		return $data;
	}

	function showRecord($query, $action, $ref_tables) {
		$results = $query->getResult();
		if (count($results) > 0)  {
				foreach ($query->getResult() as $row) {
					if(empty($ref_tables)) {
						$en_del = TRUE;
					} else {
						foreach($ref_tables as $key => $value) {
							$keys	= explode('|',$key);
							$key1	=	$keys[0];
							$key2	=	$keys[1];
							$fk = $row->$key1; //fk = foreign key
							$sql2 = "SELECT ".$key2." FROM ".$value." WHERE ".$key2." ='".$fk."'";
							$query2 = $this->db->query($sql2);
							$results2 = $query2->getResult();
							if(count($results2) > 0) {
								$en_del = FALSE; //$en_del = enable delete
								break;
							} else {
								$en_del = TRUE;
								continue;
							}
						}
					}
					$action['en_del'] = $en_del;
					$data[] = (array)$row + $action; // + PHP union operator to merge arrays ...
				}
		} else {
			$data[] = 0;
		}
		//return $query->result_array();
		return $data;
	}

}
