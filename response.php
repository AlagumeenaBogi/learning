
<?php
	//include connection file 
	include_once("database_connection.php");
	 
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'id',
		1 =>'student_name',
		2 =>'address'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( student_name LIKE '".$params['search']['value']."%' )";    
		$where .=" OR 	address LIKE '".$params['search']['value']."%' ";

	//	$where .=" OR 	school_name LIKE '".$params['search']['value']."%' )";
	
	}
		//$where .="status =1 AND reg_id=10";

	// getting total number records without any search
	$sql = "SELECT * FROM `registration`";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
//echo $sqlRec."<BR>";
	$queryTot = mysql_query($sqlTot) or die("database error:". mysql_error($link_mce_global));


	$totalRecords = mysql_num_rows($queryTot);

	$queryRecords = mysql_query($sqlRec) or die("error to fetch employees data");

	//iterate on results row and create new index array of data
	while( $row = mysql_fetch_row($queryRecords) ) { 
		$data[] = $row;
	}	

	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $data   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
	