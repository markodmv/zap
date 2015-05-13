<?
ob_start();
include "spoj.php";
require 'stranica.php';
class registracijafirmir extends stranica{
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
function PrikazMeni(){
	?>
   <ul  id="MenuBar1" class="MenuBarHorizontal" >
                    <li><a class="MenuBarItemSubmenu" href="registracijafirmir.php"> Registriranje novih firmi </a>
                      <ul>
                        <li><a href="registracijafirmir.php"> Registriranje novih firmi </a></li>
                         <li><a href="uredjivanjefirmir.php"> Uređivanje podataka firmi </a></li>
                      </ul>
                    </li>
                    <li><a class="MenuBarItemSubmenu" href="ispisivanjer.php"> Dodavanje/Brisanje potraživanja</a>
                      <ul>
                        <li><a href="ispisivanjer.php"> Ispisivanje potraživanja </a></li>
                        <li><a href="dodavanjer.php"> Dodavanje potraživanja </a></li>
                        <li><a href="brisanjer.php"> Brisanje potraživanja </a></li>
                      </ul>
                    </li>
                    <li><a href="kompenzacijer.php"> Nađi kompenzaciju/most</a>
                    <ul>
                     <li><a href="kompenzacijer.php"> Nađi kompenzaciju </a></li>
                     <li><a href="mostr.php"> Nađi most </a></li>
                      <li><a href="dugovanjanizr.php"> Dugovanja (u nizu) </a></li>
                      <li><a href="potrazivanjanizr.php"> Potraživanja (u nizu) </a></li>
                    </ul>
            </li>
                  </ul>
    <?
	}
function PrikazSadrzaj(){
		?><br><br>
        <div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>

Kratke upute:<br><br>
<ul><li>Naziv firme je obavezan</li>
<li>Ostale podatke, ako su Vam poznati, unesite zbog brže realizacije kompenzacije</li>
<li>Kliknite na tipku Registriraj</li></ul><br><br>
<hr width="500" align="center"><br><br>
<?

if(isset($_COOKIE['ID_my_site'])) 
{ 
$username = $_COOKIE['ID_my_site']; 
$pass = $_COOKIE['Key_my_site']; 
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '$username'")or die(mysql_error()); 
while($info = mysql_fetch_array( $check )) 
{ 

if ($pass != $info['lozinka']) 
{ header("Location: index.php"); 
} 

else 
{
	$id = $info['korisnik_id'];
	$status = $info['status'];
	if($status == 0){echo "Da bi mogli registrirati novu firmu morate imati odobrenje od strane administratora.<br> (Administrator vam mora promijeniti status.)!<br><br>";
	?>Više na <a href="http://www.loreana.hr">www.loreana.hr</a>.<?
	}
	else {
if (isset($_POST['registracija'])) { 

		if (!get_magic_quotes_gpc()) 
		{
		$_POST['naziv_firme'] = addslashes($_POST['naziv_firme']);
		}
$firmacheck = $_POST['naziv_firme'];
$check = mysql_query("SELECT naziv_firme FROM firme WHERE naziv_firme = '$firmacheck'") 
or die(mysql_error());
$check2 = mysql_num_rows($check);


	if ($check2 != 0) 
	{
	echo 'Naziv firme '.$_POST['naziv_firme'].' vec postoji.<br><br> <a href="registracijafirmir.php">Ponovi unos.</a>';
	return;
	}
	if($_POST['naziv_firme'] == null){
		echo 'Morate upisati naziv firme.<br><br> <a href="registracijafirmir.php">Ponovi unos.</a>';
	return;
		}
$date = date("Y")."-".date("m")."-".date("d");
$insert = "INSERT INTO firme (naziv_firme, adresa_firme, telefon, fax, mobitel, email, datum, korisnik_id)
VALUES ('".$_POST['naziv_firme']."', '".$_POST['adresa_firme']."', '".$_POST['telefon']."', '".$_POST['fax']."', '".$_POST['mobitel']."', '".$_POST['email']."', '$date', '$id')";
$add_member = mysql_query($insert);
?>
<br>Firma je uspješno registrirana!
<br>

<?php 
}
else 
{ 
?>
<form action="" method="post">
<table width="300" height="200" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> Naziv firme</td>
    <td><input type="text" name="naziv_firme"></td>
  </tr>
  <tr>
    <td> Adresa</td>
    <td><input type="text" name="adresa_firme"></td>
  </tr>
  <tr>
    <td> Telefon</td>
    <td><input type="text" name="telefon"></td>
  </tr>
  <tr>
    <td> Fax</td>
    <td><input type="text" name="fax"></td>
  </tr>
  <tr>
    <td> Mobitel</td>
    <td><input type="text" name="mobitel"></td>
  </tr>
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
}
}
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
{ header("Location: index.php"); 
} 

else 
{
	$firma="select * from korisnik where korisnicko_ime = '$username'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$koris=$red["korisnik_id"];
			$od=$red["status"];
			$zar=$red["zarada"];
			}
					$firma="select count(potrazivanja_id) as potraga from potrazivanja where korisnik_id = '$koris'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$brp=$red["potraga"];
			}
				$firma="select count(firma_id) as firm from firme where korisnik_id = '$koris'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$brf=$red["firm"];
			}
	?>
	<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF"> 
    <tr>
    <td height="40"><?
    $kor = ucfirst(strtolower($username));
	echo "Korisnik : $kor ";
	
	?>
	<br><br>
	Registriranih firmi: <? echo " $brf";?><br />
    Unesenih potraživanja: <? echo " $brp";?><br />
    Razina prava: <? echo "$od";?><br />
    Trenutna zarada: <? echo "$zar kn";?><br /><br /></td>
    </tr>
     <tr>
    <td height="40"><a href="logout.php">Odjava</a><hr width="150" align="left"></td>
    </tr>
    </table>
    <?	
	}
} 
	}
else 
{ 
echo "Cooki ne postoji";
} 
	}
	}
$registracijafirmir = new registracijafirmir();
$registracijafirmir -> Prikaz();
ob_flush();
?>