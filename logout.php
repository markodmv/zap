<?php
ob_start();
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<title>Logout Page</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Courier New, Courier, monospace;
}
-->
</style></head>
<body>
<?php 
$past = time() - 100; 
//this makes the time in the past to destroy the cookie 
setcookie(ID_my_site, gone, $past); 
setcookie(Key_my_site, gone, $past); 
header("Location: index.php"); 
?> 
</body>
</html>
<?php
ob_flush();
?>