<?
ob_start();
include "spoj.php";
require 'stranica.php';
class admin extends stranica{
	function Prikaz(){
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n";
	echo "<title>Zarada - kompenzacije</title>";
	$this -> PrikazKeywords();
	$this -> PrikazStyle();
	echo "</head>\n<body>\n";
	$this -> PrikazPoc();
	$this -> PrikazMeni();
	$this -> PrikazDrugi();
	$this -> PrikazLog();
	$this -> PrikazDT();
	$this -> PrikazOglasi();
	$this -> PrikazTreci();
	$this -> PrikazSadrzaj();
	$this -> PrikazKraj();
	echo "</body>\n</html><br><br><br><br>";
		}
function PrikazSadrzaj(){
	
	
		if(isset($_COOKIE['ID_my_site']))
{ 

$username = $_COOKIE['ID_my_site']; 
$pass = $_COOKIE['Key_my_site'];
$check = mysql_query("SELECT * FROM admin WHERE korisnicko_ime = '$username'")or die(mysql_error());
while($info = mysql_fetch_array( $check )) 
{
if ($pass != $info['lozinka']) 
{
}
else
{
header("Location: indexa.php");
}
}
}
if (isset($_POST['submit'])) { 
if(!$_POST['username'] | !$_POST['pass']) {
die ('Nisu popunjena zatražena polja.<br><a href="administrator.php"> Pokušajte ponovo. </a>');
}
if (!get_magic_quotes_gpc()) {
$_POST['email'] = addslashes($_POST['email']);
}
$check = mysql_query("SELECT * FROM admin WHERE korisnicko_ime = '".$_POST['username']."'")or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
die ('Ne postoji takav korisnik.<br><a href="administrator.php"> Pokušajte ponovo. </a>');
}
while($info = mysql_fetch_array( $check )) 
{
$_POST['pass'] = stripslashes($_POST['pass']);
$info['lozinka'] = stripslashes($info['lozinka']);
$_POST['pass'] = md5($_POST['pass']);
if ($_POST['pass'] != $info['lozinka']) {
die ('Lozinka nije valjana.<br><a href="administrator.php"> Pokušajte ponovo. </a>');
}
else 
{  
$_POST['username'] = stripslashes($_POST['username']); 
$hour = time() + 3600; 
setcookie(ID_my_site, $_POST['username'], $hour); 
setcookie(Key_my_site, $_POST['pass'], $hour); 
header("Location: indexa.php");
} 
} 
} 
else 
{ 
?> 
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<br> 
<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF"> 
<tr>
<td height="35"> Korisni&#269;ko ime:<br>
    <input name="username" type="text" maxlength="50"></td>
</tr>
<tr>
<td height="35"> Lozinka:<br>
<input name="pass" type="password" maxlength="50"></td>
</tr> 
<tr>
<td height="40" colspan="2" align="center"> 
    <div align="left">
      <input type="submit" name="submit" value="Prijavi se"> 
    </div></td>
</tr>
</table> 
</form> 
<?
	}
	}
	}
$admin = new admin();
$admin -> Prikaz();
ob_flush();
?>