<?php 
session_start();
$lg = array("err");
if(isset($_POST['sesskey']))
{
	if (session_destroy()) {
	$lg = array('error'=>"no");
    }
}else{
	$lg = array('error'=>"yes");
}
echo json_encode($lg );

 ?>