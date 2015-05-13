<?
ob_start();
include "spoj.php";
require 'stranica.php';
class regkorisnika extends stranica {
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
function PrikazLog(){
	
	
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
header("Location: indexr.php");
}
}
}
if (isset($_POST['submit'])) { 
if(!$_POST['username'] | !$_POST['pass']) {
die ('Nisu popunjena zatražena polja.<br><a href="registracijakorisnika.php"> Pokušajte ponovo. </a>');
}
if (!get_magic_quotes_gpc()) {
$_POST['email'] = addslashes($_POST['email']);
}
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '".$_POST['username']."'")or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
die ('Ne postoji takav korisnik.<br><a href="registracijakorisnika.php"> Pokušajte ponovo. </a>');
}
while($info = mysql_fetch_array( $check )) 
{
$_POST['pass'] = stripslashes($_POST['pass']);
$info['lozinka'] = stripslashes($info['lozinka']);
$_POST['pass'] = md5($_POST['pass']);
if ($_POST['pass'] != $info['lozinka']) {
die ('Lozinka nije valjana.<br><a href="registracijakorisnika.php"> Pokušajte ponovo. </a>');
}
else 
{  
$_POST['username'] = stripslashes($_POST['username']); 
$hour = time() + 3600; 
setcookie(ID_my_site, $_POST['username'], $hour); 
setcookie(Key_my_site, $_POST['pass'], $hour); 
header("Location: indexr.php");
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
<td height="40" >
<a href="administrator.php">Administrator</a><br />
<hr width="150" align="left" />
</td>
</tr>
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
	}
function PrikazSadrzaj(){
	?>
    <br><br>
        <div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>

Kratke upute:<br><br>
<ul><li>Sva polja su obavezna</li>
<li>Kliknite na tipku registriraj</li>
<li>Nakon isteka probnog razdoblja od 7 dana, račun će Vam biti blokiran ukoliko ne uplatite sredstva dogovorena cjenikom</li></ul><br><br>

<?
if (isset($_POST['registracija'])) { 

if (!$_POST['korisnicko_ime'] | !$_POST['lozinka'] | !$_POST['pass2'] | !$_POST['ime_prezime'] | !$_POST['firma'] | !$_POST['adresa'] | !$_POST['telefon'] | !$_POST['fax'] | !$_POST['mobitel'] | !$_POST['email']) 
	{
	die('Nisu popunjena sva polja!<br><br>
	<a href="registracijakorisnika.php">Ponovi unos.</a>');
	
	}

		if (!get_magic_quotes_gpc()) 
		{
		$_POST['korisnicko_ime'] = addslashes($_POST['korisnicko_ime']);
		}
$usercheck = $_POST['korisnicko_ime'];
$check = mysql_query("SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = '$usercheck'") 
or die(mysql_error());
$check2 = mysql_num_rows($check);


	if ($check2 != 0) 
	{
	echo 'Korisnicko ime '.$_POST['Korisnicko_ime'].' vec postoji.<br><br> <div class="style6"><a href="registracijakorisnika.php">Ponovi unos.</a></div>';
	return;
	}
	
	if ($_POST['lozinka'] != $_POST['pass2']) 
		{
		echo 'Neispravna lozinka.<br><br> <div class="style6"><a href="registracijakorisnika.php">Ponovi unos.</a></div>';
		return;
		}
		
$_POST['lozinka'] = md5($_POST['lozinka']);

			if (!get_magic_quotes_gpc()) 
			{
			$_POST['lozinka'] = addslashes($_POST['lozinka']);
			$_POST['korisnicko_ime'] = addslashes($_POST['korisnicko_ime']);
			}
$date = date("Y")."-".date("m")."-".date("d");
$insert = "INSERT INTO korisnik (korisnicko_ime, lozinka, ime_prezime, firma, adresa, telefon, fax, mobitel, email, datum)
VALUES ('".$_POST['korisnicko_ime']."', '".$_POST['lozinka']."', '".$_POST['ime_prezime']."','".$_POST['firma']."','".$_POST['adresa']."','".$_POST['telefon']."', '".$_POST['fax']."', '".$_POST['mobitel']."', '".$_POST['email']."', '$date')";
$add_member = mysql_query($insert);
?>
<br>Uspješno ste registrirani!
<br>

<?php 
}
else 
{ 
?>

<form action="" method="post">
<table width="300" height="350" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> Korisničko ime</td>
    <td><input type="text" name="korisnicko_ime"></td>
  </tr>
  <tr>
    <td> Lozinka</td>
    <td><input type="text" name="lozinka"></td>
  </tr>
  <tr>
    <td> Lozinka ponovo</td>
    <td><input type="text" name="pass2"></td>
  </tr>
    <tr>
    <td> Ime i prezime</td>
    <td><input type="text" name="ime_prezime"></td>
  </tr>
  <tr>

  <tr>
    <td> Naziv firme</td>
    <td><input type="text" name="firma"></td>
  </tr>
  <tr>
    <td> Adresa</td>
    <td><input type="text" name="adresa"></td>
  </tr>
    <tr>
    <td> Telefon</td>
    <td><input type="text" name="telefon"></td>
  </tr>
  <tr>
  <tr>
    <td> Fax</td>
    <td><input type="text" name="fax"></td>
  </tr>
    <tr>
    <td> Mobitel</td>
    <td><input type="text" name="mobitel"></td>
  </tr>
  <tr>
  <tr>
    <td> E-mail</td>
    <td><input type="text" name="email"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="registracija" value="Registriraj"></td>
  </tr>
</table>
</form>
    <?
}
		}
	}
$regkorisnika = new regkorisnika();
$regkorisnika -> Prikaz();
ob_flush();
?>