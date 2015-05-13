<?
ob_start();
include "spoj.php";
require 'stranica.php';
class zarada extends stranica{
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
				$koris = $_GET['kor'];
				$firma="select * from korisnik where korisnik_id = $koris";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$korisnik=$red["korisnicko_ime"];
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
            <br /><br /><br /><br />
    Korisnik: 
    <?
	echo " $korisnik<br><br>";
	
	?>
    <li> Broj registriranih firmi: <? echo " $brf";?></li><br />
    <li> Broj unesenih potraživanja: <? echo " $brp";?></li><br />
    <li> Razina prava korisnika: <? echo "$od";?></li><br />
    <li>Trenutna zarada: <? echo "$zar kn";?></li>
    <br /><br /><br />
    <?
    if(!$_POST["uplata"])
			{
				?>
                <form action="" method="post">
                <table width="600" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#CCCCCC"><h2><strong>Uplata</strong></h2></td>
  
  </tr>
  <tr>
    <td height="30" width="150" align="center" bgcolor="#CCCCCC">Iznos</td>
    <td align="center" bgcolor="#CCCCCC">Opis uplate</td>
  </tr>
  <tr>
    <td height="30" width="150" align="center" bgcolor="#CCCCCC"><input type="text" name="zarada" size="12" /> kn</td>
    <td align="center" bgcolor="#CCCCCC"><input name="opis_uplate" type="text" size="60" /></td>
  </tr>
  <tr>
    <td height="30" colspan="2" align="left" valign="middle" bgcolor="#CCCCCC">
      <h5>NAPOMENA: Umjesto decimalnog zareza upisati točku.<br />
      </h5></td>
    
  </tr>
   <tr>
    <td height="30" colspan="2" align="center" bgcolor="#CCCCCC">
        <input type="submit" name="uplata" value="Potvrdi" />
    </td>
    
  </tr>
</table>
</form>
                <?
            	}else{
					$kor=$_GET['kor'];
					$date = date("Y")."-".date("m")."-".date("d");
					$iznos=$_POST['zarada'];
					$opis=$_POST['opis_uplate'];
					$sql="update korisnik set zarada = zarada + '$iznos' where korisnik_id = $kor";
					if(!$firm=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					$uplate="insert into uplate(korisnik_id, opis_uplate, iznos_uplate, datum) values('$kor', '$opis', '$iznos', '$date')";
					$add_member = mysql_query($uplate);
					?>
                    <br />Iznos je uspješno dodan.
                    <?
					
					}
					?>
<br>
            <a href="statistika.php"><br />Povratak na statistiku</a>
            <br />
            <br />
            <br />	
			
		<table width="700" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td height="20" width="150" align="center" valign="middle" bgcolor="#333333"><h3><strong>Datum uplate</strong></h3></td>
    <td width="150" align="center" valign="middle" bgcolor="#333333"><h3><strong>Iznos uplate</strong></h3></td>
    <td align="center" valign="middle" bgcolor="#333333"><h3><strong>Opis uplate</strong></h3></td>
  </tr>
  <?
  $kid=$_GET['kor'];
  $uplat="select * from uplate where korisnik_id = $kid";
  if(!$upla=mysql_query($uplat)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while($redak = mysql_fetch_array($upla))
  {
	  $dat = $redak["datum"];
  ?>
  <tr>
    <td align="center" valign="middle" bgcolor="#999999"><em><?=$dat?></em></td>
    <td align="center" valign="middle" bgcolor="#999999"><em><?=$redak["iznos_uplate"]?> kn</em></td>
    <td align="left" valign="middle" bgcolor="#999999"><em><?=$redak["opis_uplate"]?></em></td>
  </tr>
  <?
  }
  ?>  
</table>
<br />
<br />
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
$zarada = new zarada();
$zarada -> Prikaz();
ob_flush();
?>