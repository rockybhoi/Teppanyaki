<?php 
	
	$servername = "127.0.0.1";
	$username = "root";
	$password = "ct@dev";
	$db = "teppanyaki";
	$conn = mysqli_connect($servername, $username, $password, $db);
	
	$word = array(
		"ngrok",
		"localhost"
	);

	if ((strpos($_SERVER['HTTP_HOST'], $word[0]) !== false) or (strpos($_SERVER['HTTP_HOST'], $word[1]) !== false))
	{
		$data = file_get_contents('./order_create.json');			
		$shop_name = "pkrct.myshopify.com";	
		$order_wh_data = json_decode($data, true);			
		$verified=true;
	}
	else
	{
		$data = file_get_contents('php://input');	
		//$data = file_get_contents('./order_create.json');	
		$encode_data=json_encode($data);
		$shop_name = "mokobara.myshopify.com";	
		$data_val = json_decode($data, true);
		$order_wh_data = $data_val;
		$verified=true;
	}
	
	if ($verified) 
	{	
		
		// $order_data="INSERT INTO order_data(order_json) VALUES(".$encode_data.")";
		// mysqli_query($conn,$order_data);	

		
		
		foreach($order_wh_data['note_attributes'] as $order_attr)
		{
			
			
				if($order_attr['name'] == "_teppanyaki")
				{
					$val_code=$order_attr['value'];
					
					$insert_revenue="UPDATE  passcode set check_use='1' where passcode='".$val_code."'";
					
					if(mysqli_query($conn,$insert_revenue))
					{
						echo "success";
					}
					else
					{
						echo "false";
					}

				}
			
			
		}
	}
?>