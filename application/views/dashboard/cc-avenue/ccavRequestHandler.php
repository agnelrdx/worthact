<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>
<?php include APPPATH . 'libraries/Crypto.php';

	error_reporting(0);

	$working_key=$working_key;//Shared by CCAVENUES
	$access_code=$access_code;//Shared by CCAVENUES
	$merchant_data='';
	
	foreach ($order_info as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
                
	}
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="<?= $action_url; ?>"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>