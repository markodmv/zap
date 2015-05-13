<?	
  if(isset($_COOKIE['ID_my_site']))
{ 

$username = $_COOKIE['ID_my_site']; 
$pass = $_COOKIE['Key_my_site'];
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '$username'")or die(mysql_error());
while($info = mysql_fetch_array( $check )) 
{
if ($pass != $info['lozinka']) 
{
}
else
{
header("Location: index.php");
exit();
}
}
}
if (isset($_POST['submit'])) { 
if(!$_POST['username'] | !$_POST['pass']) {
die ('Nisu popunjena zatražena polja.<br><a href="index.php"> Pokušajte ponovo. </a>');
}
if (!get_magic_quotes_gpc()) {
$_POST['email'] = addslashes($_POST['email']);
}
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '".$_POST['username']."'")or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
die ('Ne postoji takav korisnik.<br><a href="index.php"> Pokušajte ponovo. </a>');
}
while($info = mysql_fetch_array( $check )) 
{
$_POST['pass'] = stripslashes($_POST['pass']);
$info['lozinka'] = stripslashes($info['lozinka']);
$_POST['pass'] = md5($_POST['pass']);
if ($_POST['pass'] != $info['lozinka']) {
die ('Lozinka nije valjana.<br><a href="index.php"> Pokušajte ponovo. </a>');
}
else 
{  
$_POST['username'] = stripslashes($_POST['username']); 
$hour = time() + 60*60*24*30; 
setcookie(ID_my_site, $_POST['username'], $hour); 
setcookie(Key_my_site, $_POST['pass'], $hour); 
header("Location: index.php"); 
exit();
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
    <div align="center">
      <input type="submit" name="submit" value="Prijavi se"> 
    </div></td>
</tr>
<tr>
<td height="40" >
Niste registrirani?<br>
<a href="registracijakorisnika.php">Registrirajte se</a>
</td>
</tr>
</table> 
</form> 
<?
	}
	?>