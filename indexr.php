<?
ob_start();
include "spoj.php";
require 'stranica.php';
class indexr extends stranica{
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
	$this -> PrikazSadrzaj($sadrzaj);
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
	}
$indexr = new indexr();
$indexr -> SetSadrzaj('
					 <br><br>
					<div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>

O kompenzatoru :<br><br>
<ul>
<li>Kompenzator je namjenjen ubrzavanju dosadašnjih dugotrajnih procesa nazivanja dužnika, provjeravanja njihovih potraživanja i tako u krug...</li>
<li>Od sada sve imate na jednom mjestu. Dovoljno je da Vi uneseta Vaša potraživanja i preporučite .::Kompenzator::. Vašim dužnicima da i oni učine isto</li>
<li>Nakon što su unesena dugovanja, dovoljno je samo odabrati firmu i kliknuti na traženje kompenzacije</li>
<li>.::Kompenzator::. prolazi kroz bazu potraživanja i pronalazi Vam sve moguće kompenzacije, a na izlazu dobivate ispis potencijalnih kompenzacija</li></ul>
Mogućnosti kompenzatora:<br><br>
<ul>
<li>Ispis potraživanja - služi za praćenje i kontrolu potraživanja (svi korisnici imaju pristup)</li>
<li>Dodavanje potraživanja - služi za dodavanje novog potraživanja u bazu (svi korisnici imaju pristup)</li>
<li>Brisanje potraživanja - služi za brisanje postojećeg potraživanja iz baze (samo pretplatnici imaju pristup)</li>
<li>Traženje "mostova" - služi za pronalazak alternativnih lanaca dugovanja između dvije fimre, praktičko ukoliko dođe do pucanja kompenzacije uslije podmiranja dugovanja(pretplatnici i korisnici na probnom razdoblju imaju pristup)</li></ul>
Korisnici :<br><br>
<ul>
<li>Posjetitelji - posjetitelji stranice</li>
<li>Korisnici na probnom razdoblju - postaje se nakon registracije i potvrde na link poslan mailom, vrijedi sljedećih 7 dana</li>
<li>Stalni korisnici ( pretplatnici) - postaje se nakon uplate određene cjenikom</li> </ul>
Cjenik (samo za pretplatnike):<br><br>
<ul>
<li>1 mjesec - 500 HRK</li>
<li>2 mjesec - 1000 HRK</li>
<li>3 mjesec - 1400 HRK</li>
<li>6 mjesec - 2500 HRK</li>
<li>12 mjesec - 4000 HRK </li></ul><br><br>
Ukoliko imate nejasnoća slobodno nam se obratite na brojeve telefona 
objavljene ispod.
<br><br><br><br>
<p align="center">Marijan Nedić: 098/186-5590, Dinko Jeleč: 095/894-3611</p>
<br>
 ');
$indexr -> Prikaz();
ob_flush();
?>