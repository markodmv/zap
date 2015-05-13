<?
ob_start();
include "spoj.php";
require 'stranica.php';
class dodavanjea extends stranica{
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
                    <li><a class="MenuBarItemSubmenu" href="registracijafirmia.php"> Registriranje novih firmi </a>
                      <ul>
                        <li><a href="registracijafirmia.php"> Registriranje novih firmi </a></li>
                         <li><a href="uredjivanjefirmia.php"> Uređivanje podataka firmi </a></li>
                      </ul>
                    </li>
                    <li><a class="MenuBarItemSubmenu" href="ispisivanjea.php"> Dodavanje/Brisanje potraživanja</a>
                      <ul>
                        <li><a href="ispisivanjea.php"> Ispisivanje potraživanja </a></li>
                        <li><a href="dodavanjea.php"> Dodavanje potraživanja </a></li>
                        <li><a href="brisanjea.php"> Brisanje potraživanja </a></li>
                      </ul>
                    </li>
                    <li><a href="kompenzacijea.php"> Nađi kompenzaciju/most</a>
                    <ul>
                     <li><a href="kompenzacijea.php"> Nađi kompenzaciju </a></li>
                     <li><a href="mosta.php"> Nađi most </a></li>
                      <li><a href="dugovanjaniza.php"> Dugovanja (u nizu) </a></li>
                       <li><a href="potrazivanjaniza.php"> Potraživanja (u nizu) </a></li>
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
$check = mysql_query("SELECT * FROM admin WHERE korisnicko_ime = '$username'")or die(mysql_error()); 
while($info = mysql_fetch_array( $check )) 
{ 

if ($pass != $info['lozinka']) 
{ header("Location: index.php"); 
} 

else 
{
	?>
	<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF"> 
    <tr>
    <td height="40"><?
    $kor = ucfirst(strtolower($username));
	echo "Korisnik : $kor ";
	?></td>
    </tr>
     <tr>
    <td height="40"><a href="logout.php">Odjava</a><hr width="150" align="left"></td>
    </tr>
    <tr>
    <td height="40"><a href="statistika.php">Statistika korisnika</a><hr width="150" align="left"></td>
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
$check = mysql_query("SELECT * FROM admin WHERE korisnicko_ime = '$username'")or die(mysql_error()); 
while($info = mysql_fetch_array( $check )) 
{ 
if ($pass != $info['lozinka']) 
{ header("Location: index.php"); 
} 
else 
{
	$id = $info['korisnik_id'];
	if(!$_POST['unos'])
	{
?>
<form action="" method="post">
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
   
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center">
    <td width="50%">
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
    <td>
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
			die('Morate odabrati firme i upisati iznos potraživanja!<br><br><a href="dodavanjea.php">Ponovi unos.</a>');}
		if($_POST['firma_potrazuje'] == $_POST['firma_duguje']){
			die('Ne možete odabrati istu firmu koja potražuje i koja duguje!<br><br><a href="dodavanjea.php">Ponovi unos.</a>');
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
               
		$insert="insert into potrazivanja(firma_potrazuje, firma_duguje, iznos, admin, datum) values ('$fp', '$fd', '".$_POST['iznos']."', 'Y', '$date')";
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
$dodavanjea = new dodavanjea();
$dodavanjea -> Prikaz();
ob_flush();
?>