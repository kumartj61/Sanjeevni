<?php
	$a = password_hash("12345",PASSWORD_DEFAULT);
	echo  $a;
	echo "\n Verify password ". password_verify("12345",$a);

?>
