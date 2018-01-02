<?php 
include("database_connection.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> List</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" media="all">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
	 
<script type="text/javascript" src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
</head>
<body>

	<div class="container" style="padding-bottom:10px;">
      <div class="">
		<h1>List</h1>
        <div class="">
    		<table id="employee_grid" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.No </th>
                        <th>Student Name</th>
        				<th>Address</th>
        				<th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
      </div>
    </div>
    
</body>
<script>
$( document ).ready(function() {
$('#employee_grid').DataTable({
"bProcessing": true,
"serverSide": true,
"ajax":{
url :"response.php", // json datasource
type: "post",  // type of method  , by default would be get
"aoColumnDefs" : [
{
'bSortable' : false,
'aTargets' : [3,4]
}],
"dataSrc": function (jsonData) { //alert(jsonData);alert(jsonData.data); 
var j=1;
for ( var i=0, len=jsonData.data.length ; i<len ; i++ ) { //alert(jsonData.data[i][0]);
var get_val=jsonData.data[i][0];
jsonData.data[i][0] =j;
jsonData.data[i][2] = '<span class="text-success">'+jsonData.data[i][2]  +'</span>';
jsonData.data[i][3] = '<div class="btn-group" data-toggle="buttons"> <div class="col-sm-6"><a href="http://google/upload/'+jsonData.data[i][15]+'" target="_blank" class="btn btn-primary btn-xs" download>Download</a></div><div class="col-sm-6"> <a href="http://google.com/ingenious_view_profile.php?id='+get_val+'" target="_blank" class="btn btn-warning btn-xs">View Profile</a></div></div>';
j++;
}
return jsonData.data;
},
error: function(){ 
$(".employee-grid-error").html("");
$("#employee_grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
//$("#employee_grid_processing").css("display","none");
}
}
});   
});
</script>
</html>

<!----https://www.phpflow.com/php/datatable-responsive-using-php-and-mysql-with-ajax/
phpflow jquery datatable------>