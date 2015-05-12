<?php
	session_start();
	$pass = $_POST['pass'];
	
	if ($pass == "k3513060")
	{
		$_SESSION['pass'] = $pass;
		header('location: index.php?sasaran=input');
	}
	else
	{
		echo "Login gagal! Silahkan <a href='index.php'>ulangi login</a>";
	}
?>