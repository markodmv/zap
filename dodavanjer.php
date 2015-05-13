<?
ob_start();
include "spoj.php";
require 'stranica.php';
class dodavanjer extends stranica{
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
function PrikazSadrzaj(){
		?><br><br>
        <div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>


Kratke upute:<br><br>
<ul><li>Na lijevom popisu izaberite firmu koja potražuje</li>
<li>Na desnom popisu izaberite firmu koja duguje</li>
<li>Upišite iznos dugovanja.</li>
<li>Kliknite na tipku Dodaj dugovanje u bazu</li>
<li>Za brže pretraživanje, pritisnite prvo slovo u nazivu firme </li>
<li>Ukoliko se firma ne nalazi na popisu registrirejte vašu firmu koristeći gornji izbornik</li>
</ul><br><br>
<hr width="500" align="center"><br>
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
	if($status == 0){echo "Da bi mogli dodavati potraživanja morate imati odobrenje od strane administratora.<br> (Administrator vam mora promijeniti status.)!<br><br>";
	?>Više na <a href="http://www.loreana.hr">www.loreana.hr</a>.<?
    }
	else {
	if(!$_POST['unos'])
	{
?>
<form action="" method="post">
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
   
   <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr align="center">
    <td width="30%">
    <select name="firma_potrazuje" size="10">
    <?
	 $sql="select * from firme order by naziv_firme asc";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
  ?>
  <option><?=$redak["naziv_firme"]?></option>
  <?
  }
  ?>
    </select>
    </td>
    <td width="30%">
     <select name="firma_duguje" size="10">
    <?
	 $sqla="select * from firme order by naziv_firme asc";
  if(!$sa=mysql_query($sqla)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redaka=mysql_fetch_array($sa))
  {
  ?>
  <option><?=$redaka["naziv_firme"]?></option>
  <?
  }
  ?>
    </select>
    </td>
  </tr>
</table>

   
    </td>
  </tr>
  <tr>
    <td height="60" align="center"><br />Iznos potraživanja: <input type="text" name="iznos" /> kn.</td>
  </tr>
  <tr>
    <td align="center" height="40"><input type="submit" name="unos" value="Dodaj dugovanje u bazu" /></td>
  </tr>
</table>
  </form>  
  <br /><br /><br />
<?
	}else{
		
		if(!$_POST['firma_potrazuje'] | !$_POST['firma_duguje'] | !$_POST['iznos']){
			die('Morate odabrati firme i upisati iznos potraživanja!<br><br><a href="dodavanjer.php">Ponovi unos.</a>');}
		if($_POST['firma_potrazuje'] == $_POST['firma_duguje']){
			die('Ne možete odabrati istu firmu koja potražuje i koja duguje!<br><br><a href="dodavanjer.php">Ponovi unos.</a>');
			}
		$regkor="select * from korisnik where korisnik_id = '$id'";
		if(!$reg=mysql_query($regkor)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($reg)){
			$od=$red["status"];
			if($od == N){
				die('Korisnici na probnom razdoblju nemaju ovlasti za dodavanje dugovanja!!');
				}
			}
			$pf= $_POST['firma_potrazuje'];
		$firma="select * from firme where naziv_firme = '$pf'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$fp=$red["firma_id"];
			}
			$df= $_POST['firma_duguje'];
			$firma="select * from firme where naziv_firme = '$df'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$fd=$red["firma_id"];
			}
				$sql="delete from potrazivanja where firma_potrazuje=$fp and firma_duguje=$fd";
			if (mysql_query($sql))
			{}
		$date = date("Y-m-d H:i:s");
               
		$insert="insert into potrazivanja(firma_potrazuje, firma_duguje, iznos, korisnik_id, datum) values ('$fp', '$fd', '".$_POST['iznos']."', '$id', '$date')";
		$add_member = mysql_query($insert);
		?>
        <br />
        Uspješno ste unijeli dugovanje!
        <br /><br /><br />
        <?
		}
		}
}
}
}
		}
	}
$dodavanjer = new dodavanjer();
$dodavanjer -> Prikaz();
ob_flush();
?>