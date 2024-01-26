    <!-- Start Page Content -->
	<?php 
		if (isset($addNew[0]))	
		$addNews = $addNew[0];
	?>

    <div class="row">
        <div class="col-lg-12">
           <div class="card card-info">
		   
		      <div class="card-header">
                <h3 class="card-title"><?php echo $page_title; ?></h3>
              </div>

	         <div class="title_right">
             <table border="0" style="margin-left: 62.5%; width: 38%; margin-bottom:5px"><tr><td>
                 <div style="float:left; padding-left: 73%">
                     <div style="float:left;">
					 	
					  <form role="form" method="post">
						<div class="">
						  <button type="submit" class="btn btn-primary" name="my_borrow_button" value="MyBorrow">View My Borrow</button>
						</div>
					  </form>                       
                     </div>
                 </div>
             </td></tr>
             </table>
				</div>		  

                <div class="card-body">
<table id="example1" class="table table-bordered table-striped" style="font-size:12px">
 
 <thead>
	<tr>
<?php
		for($i=0; $i < sizeof($headData); $i++) { //$headData = header row array defined in the respective controller
			echo "<th>".$headData[$i]."</th>";
		}
		$colspan=0;
		echo "<th>Borrow</th>";
	echo "</tr></thead>";
	echo "<tbody>";
	$k=1;
	if(isset($queryData) && sizeof($queryData)>0 && ($queryData[0] !=0)) {
	foreach($queryData as $rows => $row){ //$queryData = the actual queried data from the respective model loaded by the respective controller function...
		echo '<tr border="1">';
		echo "<td align='center' border='1'>". $k ."</td>";
		foreach ($mapData as $key => $value) { //$mapData = array mapped to $queryData keys to determine alignment of table cells. Defined in the controller
			foreach ($row as $col => $cell) {
				if($key===$col) {
					if ($key=='is_for_borrowing') {
						if ($cell=='1')
						$cell	=  	'<span class="badge bg-success">Yes</span>';	
						else 
						$cell	=	'<span class="badge bg-danger">No</span>';
					}
					if ($key=='status') {
						if ($cell=='1')
						$cell	=  	'<span class="badge bg-success">Active</span>';	
						else 
						$cell	=	'<span class="badge bg-danger">Inactive</span>';
					}
					if ($key=='borrow_status') {
						if ($cell=='1')
						$cell	=  	'<span class="badge bg-success">Approved</span>';
						elseif ($cell=='2')	
						$cell	=  	'<span class="badge bg-danger">Rejected</span>';	
						else 
						$cell	=	'<span class="badge bg-primary">Progress</span>';
					}					
					if ($key=='gender') {
						if ($cell=='1')
						$cell	=  	'<span class="badge bg-primary">Male</span>';	
						if ($cell=='2') 
						$cell	=	'<span class="badge bg-info">Female</span>';
					}					
					if(strtoupper($value)==='L') {
						echo "<td align='left'>". $cell ."</td>";
					} elseif(strtoupper($value)==='C') {
						echo "<td align='center'>". $cell ."</td>";
					} elseif(strtoupper($value)==='R') {
						echo "<td align='right'>". $cell ."</td>";
					} else {
						echo "<td align='left'>". $cell ."</td>";
					}
				}
			}
		}
		$ediID='';
		for($i=0; $i<sizeof($editURI); $i++) {
			$ediURI = $editURI[0];
			if($i>0) {
				//$ediID .= '/'.$row->$editURI[$i]; //this works if the returned data, i.e. $queryData are OBJECT '$query->result()'
				$ediID = $row[$editURI[$i]]; //this works if the returned data, i.e. $queryData are ARRAY '$query->result_array()'
			}
		}
		echo "<td>";
		if(isset($row['col_details'])) {
			if (isset($addDetails[0])) {
				$do_edit_credit_function = $addDetails[0];
			} else {
				$do_edit_credit_function = "no_modal";
			}
			
			$link = '<a href="javascript:void(0)" title="Details" onclick="'.$do_edit_credit_function.'('."'".$ediID."'".')"><i class="fa fa-syringe icon-white" style="font-size:12px"></i></a>';
			echo $link;
		} 
		echo "&nbsp;";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "&nbsp;";

		if($row['col_edit']===TRUE) {
			if (isset($addNew[0])) {
				$do_edit_credit_function = $addNew[0];
			} else {
				$do_edit_credit_function = "no_modal";
			}
			
			$link = '<a href="javascript:void(0)" title="Edit" onclick="'.$do_edit_credit_function.'('."'".$ediID."'".')"><i class="fa fa-edit icon-white" style="font-size:12px"></i></a>';
			echo $link;
		} else {
			echo "*";
		}
		echo "&nbsp;";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "&nbsp;";
		echo "&nbsp;";		
/* 	   if($row['col_del']===TRUE) {
		$delID='';
			for($i=0; $i<sizeof($deleteURI); $i++) {
				$delURI = $deleteURI[0];
				if($i>0) {
					$delID .= '/'.$row[$deleteURI[$i]]; //this works if the returned data, i.e. $queryData are ARRAY '$query->result_array()'
				}
			}
			if($row['en_del'] === TRUE) {
				//echo "<td>". anchor($delURI.$delID,'Delete', array('onClick' => "return confirm('Deleting record. Are you sure?')")) ."</td>";
				$link='<a href="'.$delURI.$delID.'"><i class="fa fa-trash icon-white" style="font-size:12px"></i></a>';
				if (isset($addNew[2])) {
					$do_edit_credit_function = $addNew[2];
				} else {
					$do_edit_credit_function = "no_modal";
				}
				$link = '<a href="javascript:void(0)" title="Delete" onclick="'.$do_edit_credit_function.'('."'".$delID."'".')"><i class="fa fa-trash icon-danger" style="font-size:12px"></i></a>';
				echo "".$link."";
			} else {
				echo "<font color='red'>*</font>";
				//$link='<a href="'.$delURI.$delID.'"><i class="glyphicon glyphicon-trash icon-white"></i></a>';
				//echo "<td>".$link."</td>";
			}
		} else {
				echo "<font color='red'>*</font>";
		} */
			if(isset($row['col_details']) && $row['col_details']===TRUE) {
				$detID='';
				if(isset($detailsURI)) {
					for($i=0; $i<sizeof($detailsURI); $i++) {
						$detURI = $detailsURI[0];
						if($i>0) {
								//$ediID .= '/'.$row->$editURI[$i]; //this works if the returned data, i.e. $queryData are OBJECT '$query->result()'
								$detID .= '/'.$row[$detailsURI[$i]]; //this works if the returned data, i.e. $queryData are ARRAY '$query->result_array()'
						}
					}
					echo "".anchor_popup($detURI.$detID,'Details',array()) ."";
				}

				//$k++;
			}
			echo "</th>";
			echo "</tr>";
		$k++;
		}
	}
	//}
	//$this->load->library('session');
	//echo $session_id = $this->session->userdata('session_id');
	//unset($_SESSION['WHERE_ARR']);
	echo "<tbody>";
	?>
	</table>
                    </div>
            </div>
        </div>
    </div>
 </div>
    <!-- End Page Content -->