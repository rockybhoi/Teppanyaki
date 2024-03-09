<?php
header('Access-Control-Allow-Origin: *');
  
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "teppanyaki";

$servername = "127.0.0.1";
$username = "root";
$password = "ct@dev";
$db = "teppanyaki";
$conn = mysqli_connect($servername, $username, $password, $db);



//$final_arr = array();

call_user_func($_POST['method_call']);

function check_code(){
    global $conn; 
    
    $code=$_POST['code'];
    $check_data="SELECT * FROM passcode where passcode='".$code."' and check_use='0'";
    $query_run_data=mysqli_query($conn,$check_data);
    if(mysqli_num_rows($query_run_data) < 1 )
    {
        $final_arr["success"]=false;        
    }else
    {
        $final_arr["success"]=true;

    }
   echo json_encode($final_arr);
}

?>





