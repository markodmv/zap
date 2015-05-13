<?
ob_start();
include "spoj.php";
require 'stranica.php';
class statistika extends stranica{
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
		if(!$_POST['pogledaj']){
			?>
            <form action="" method="post">
            <table width="600" height="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><br />
    <select name="korisnik" size="15">
    <?
    $sql="select * from korisnik order by korisnicko_ime asc";
	 if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
	?>
    <option><?=$redak["korisnicko_ime"];?></option>
    <?
  }
  ?>
    </select>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="2" height="50"><input type="submit" name="pogledaj" value="Prikaži podatke" /></td>
  </tr>
</table>
</form>
            <?
			}
			else{
				$korisnik=$_POST['korisnik'];
					$firma="select * from korisnik where korisnicko_ime = '$korisnik'";
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
            <form action="" method="post">
            <table width="600" height="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%"><br />
    <select name="korisnik" size="15">
    <?
    $sql="select * from korisnik order by korisnicko_ime asc";
	 if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
	?>
    <option><?=$redak["korisnicko_ime"];?></option>
    <?
  }
  ?>
    </select>
    </td>
    <td valign="top"><br /><br /><br />
    Korisnik: 
    <?
	echo " $korisnik<br><br>";
	
	?>
    <li> Broj registriranih firmi: <? echo " $brf";?></li><br />
    <li> Broj unesenih potraživanja: <? echo " $brp";?></li><br />
    <li> Razina prava korisnika: <? echo "$od";?></li><br />
    <li>Trenutna zarada: <? echo "$zar kn";?></li>
    <br /><br /><br />
    <a href="status.php?kor=<?=$koris?>">Promijeni</a> status korisnika.<br /><br />
    <a href="uplate.php?kor=<?=$koris?>">Uplate</a>.<br />
     <a href="isplate.php?kor=<?=$koris?>">Isplate</a>.<br /><br />
      <a href="briskor.php?kor=<?=$koris?>">OBRIŠI KORISNIKA</a>.<br /><br />
   
   

    </td>
  </tr>
  <tr>
    <td align="center" colspan="2" height="50"><input type="submit" name="pogledaj" value="Prikaži podatke" /></td>
  </tr>
</table>
</form>
<?
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
$statistika = new statistika();
$statistika -> Prikaz();
ob_flush();
?>