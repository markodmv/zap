<?
ob_start();
include "spoj.php";
require 'stranica.php';
class uredjivanjefirmia extends stranica{
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
                    <li><a class="MenuBarItemSubmenu" href="#"> Dodavanje/Brisanje potraživanja</a>
                      <ul>
                        <li><a href="ispisivanjea.php"> Ispisivanje potraživanja </a></li>
                        <li><a href="dodavanjea.php"> Dodavanje potraživanja </a></li>
                        <li><a href="brisanjea.php"> Brisanje potraživanja </a></li>
                      </ul>
                    </li>
                    <li><a href="#"> Nađi kompenzaciju/most</a>
                    <ul>
                     <li><a href="kompenzacijea.php"> Nađi kompenzaciju </a></li>
                     <li><a href="mosta.php"> Nađi most </a></li>
                    </ul>
            </li>
                  </ul>
    <?
	}
function PrikazSadrzaj(){
		?><br><br>
        <div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>


Kratke upute:<br><br>
<ul><li>Odaberite s popisa fimu koju želite urediti i kliknite na tipku Prikaži podatke</li>
<li>Zatim popunite formu</li>
<li>Naziv firme je obavezan</li>
<li>Ostale podatke, ako su Vam poznati, unesite zbog brže realizacije kompenzacije</li>
<li>Kliknite na tipku Promijeni podatke</li>
</ul><br><br>

<hr width="500" align="center"><br><br>
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
			if(!$_POST['promijeni'])
			{
				$err=false;
			$nz=$_GET['fid'];
			$sq="select * from firme where firma_id = '$nz'";
			 if(!$s=mysql_query($sq)){
				 echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();
				 $err=true;
				 }else{
					 $novi_podatak=mysql_fetch_array($s);
					 }
	  if(!$err){
		  ?>
<form action="" method="post">
<table width="300" height="200" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td> Naziv firme<input type="hidden" name="fid" value="<?=$novi_podatak["firma_id"]?>"></td>
    <td><input type="text" name="naziv_firme" value="<?=$novi_podatak["naziv_firme"]?>"></td>
  </tr>
  <tr>
    <td> Adresa</td>
    <td><input type="text" name="adresa_firme" value="<?=$novi_podatak["adresa_firme"]?>"></td>
  </tr>
  <tr>
    <td> Telefon</td>
    <td><input type="text" name="telefon" value="<?=$novi_podatak["telefon"]?>"></td>
  </tr>
  <tr>
    <td> Fax</td>
    <td><input type="text" name="fax" value="<?=$novi_podatak["fax"]?>"></td>
  </tr>
  <tr>
    <td> Mobitel</td>
    <td><input type="text" name="mobitel" value="<?=$novi_podatak["mobitel"]?>"></td>
  </tr>
  <tr>
    <td> E-mail</td>
    <td><input type="text" name="email" value="<?=$novi_podatak["email"]?>"></td>
  </tr>
  <tr>
    <td colspan="2" align="center" height="50"><input type="submit" name="promijeni" value="Promijeni podatke"></td>
  </tr>
</table>
</form>

        <?
	  }
			}else{
				if($_POST['naziv_firme'] == null){
		echo "Morate upisati naziv firme.<br><br> ";
		?>
        <a href="uredjivanjefirmip.php?fid=<?=$_POST["fid"];?>">Ponovi unos.</a>
        <?
	return;
		}
				else{
				$fi=$_POST["fid"];
				$sql="update firme set naziv_firme = '".$_POST["naziv_firme"]."', adresa_firme = '".$_POST["adresa_firme"]."', telefon = '".$_POST["telefon"]."', fax = '".$_POST["fax"]."', mobitel = '".$_POST["mobitel"]."', email = '".$_POST["email"]."' where firma_id = '$fi'";
				if (mysql_query($sql))
			{
			if (mysql_affected_rows()>0)
				{
				echo "<br>Podaci su uspješno izmjenjeni!<br>";
				?><a href="uredjivanjefirmia.php"><br />Povratak</a><?
				} else {echo "<br>Podaci nisu izmjenjeni!<br>";
					?><a href="uredjivanjefirmia.php"><br />Povratak</a>
					<?
					}				
			} else 
				{
				echo "<br>Nastala je greška pri izmjeni podataka.<br>" . mysql_error();
				?><a href="uredjivanjefirmia.php"><br />Povratak</a><?
				}
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
	}
$uredjivanjefirmia = new uredjivanjefirmia();
$uredjivanjefirmia -> Prikaz();
ob_flush();
?>