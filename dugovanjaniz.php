<?
ob_start();
include "spoj.php";
require 'stranica.php';
class dugovanjanizr extends stranica{
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
                    </ul>
            </li>
                  </ul>
    <?
	}
function PrikazSadrzaj(){
	
			?>
        <br><br>
        <div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>


Kratke upute:<br><br>
<ul><li>Na popisu izaberite firmu za koju želite tražiti kompenzaciju</li>
<li>Za brže pretraživanje, pritisnite prvo slovo u nazivu firme</li>
<li>Desno od popisa, na padajućem izboriku izaberite maksimalan broj firmi u Vašoj kompenzaciji</li>
<li>Kliknite na tipku kreni</li>
<li>Ispod će se pojaviti kompezacije, ukoliko postoje</li>
</ul><br><br>
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
	{ header("Location: index.php"); } 
else 
	{
		$status = $info['status'];
	if($status == N){echo "Da bi mogli ispisati dugovanja u nizu morate imati odobrenje od strane administratora.<br> (Administrator vam mora promijeniti status.)!<br><br>";
	?>Više na <a href="http://www.loreana.hr">www.loreana.hr</a>.<?
    }
	else {
		if(!$_POST['prikaz']){
			$this -> IzborFirme();
							  }
							  else {
								  $this -> IzborFirme();
								  $this -> Obrada();
								  }
	}
	}
}
	
	
	}
function Obrada(){
$firma=$_POST["firma"];
$firm="select * from firme where naziv_firme = '$firma'";
		if(!$fim=mysql_query($firm)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($fim)){
			$fid=$red["firma_id"];
			}
$brojniza=$_POST["broj"];
echo "Ispis dugovanja u nizu ($brojniza):<br><br>";  


for ($i=0; $i<=$brojniza; $i++){
	$dug="select * from potrazivanja where firma_duguje = $fid order by datum desc";
	if(!$du=mysql_query($dug)){echo "<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
	if($red=mysql_fetch_array($du)){
		$d=$red["datum"];
		$firma=$red["firma_duguje"];
		$fid=$red["firma_potrazuje"];
		}
	$this -> Ispis();
	}}
function Ispis(){
	?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
		$naziv="select * from firme where firma_id = $firma";
		if(!$naz=mysql_query($naziv)){echo "<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($redak=mysql_fetch_array($naz)){
			 $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					    ?>
                  <tr bgcolor="#FF0000">
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?
					}
			elseif ($d < $osam and $d > $petna){
				    ?>
                  <tr bgcolor="#006600">
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?
				}
		elseif ($d < $petna and $d > $dvad){
			  ?>
                  <tr bgcolor="#FF3300">
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?
			}
			elseif ($d < $dvad and $d > $trid){
				   ?>
                  <tr bgcolor="#663300">
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?

				}
					else{
	     	?>
            <tr bgcolor="#CCCCCC">
            <td align="left"><?=$redak["naziv_firme"]?></td>
            <td align="center" width="200"><?=$d?></td>
  	        </tr>
            <?
					}
					}
	?> 
</table>
<?
	}
function IzborFirme(){
		?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" width="50%">
    Firma sa kojom želite početi ispis dugovanja:<br><br>
     <select name="firma" size="10">
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
    <td align="center">
    Broj ispisa u nizu:<br /><br />
    <select name="broj">
    <option>50</option>
    <option>100</option>
    <option>150</option>
    <option>200</option>
    <option>250</option>
    <option>300</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="center" height="60" colspan="2"><input type="submit" name="prikaz" value="Kreni" /></td>
  </tr>
</table>
</form>
<br /><br />
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
	if($od == N){$odo = NE;}else{$odo= DA;}
	?>
	<br><br>
	Registriranih firmi: <? echo " $brf";?><br />
    Unesenih potraživanja: <? echo " $brp";?><br />
    Odobrenje administratora: <? echo "$odo";?><br />
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
$dugovanjanizr = new dugovanjanizr();
$dugovanjanizr -> Prikaz();
ob_flush();
?>