<?
ob_start();
include "spoj.php";
require 'stranica.php';
class ispisivanjea extends stranica{
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
function PrikazStyle(){
	?>
    <style type="text/css">
<!--
body,td,th {
	color: #000;
	font-size: 13px;
}
a:link {
	color: #F00;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #F00;
}
a:hover {
	text-decoration: none;
	color: #F00;
}
a:active {
	text-decoration: none;
	color: #F00;
}
.style1 {
	font-size: 14px;
	}
.style2 {
	font-size: 14px;
	font-weight:bold;
	color:#F00;
	}
	.style8 {
	font-size: 14px;
	font-weight:bold;
	color:#F00;
	}
	.style15 {
	font-size: 14px;
	font-weight:bold;
	color:#060;
	}
	.style20 {
	font-size: 14px;
	font-weight:bold;
	color:#F30;
	}
	.style30 {
	font-size: 14px;
	font-weight:bold;
	color:#630;
	}
	.style40{
	font-size:26px;
	font-weight:900;
	}
	.style41{
	font-size:16px;
	font-weight:bold;
	color:#C00;
	}
	.style50{
	color: #FC0;
		}
-->
</style>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
    <?
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
<ul><li>Na popisu izaberite firmu za koju želite vidjeti doguvanja</li>
<li>Za brže pretraživanje, pritisnite prvo slovo u nazivu firme </li>
<li>Ispod popisa će se pojaviti firme koje duguju firmi koju Ste odabrali</li>
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
	
	if(!$_POST['prikazp'] and !$_POST['prikazd']){
		?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" width="50%">
    Firma za koju želite ispis dugovanja:<br><br>
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
  </tr>
  <tr>
    <td align="center" height="60">
    					<input type="submit" name="prikazp" value="Prikaži potraživanja" />
                        <input type="submit" name="prikazd" value="Prikaži dugovanja" />
    </td>
  </tr>
</table>
</form>
<br /><br />
        <?
		}elseif($_POST['prikazp']){
			?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center">
     Firma za koju želite ispis dugovanja:<br><br>
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
    </tr>
    <tr>
    <td align="center" height="60">
    					<input type="submit" name="prikazp" value="Prikaži potraživanja" />
                        <input type="submit" name="prikazd" value="Prikaži dugovanja" />
    </td>
  </tr>
    <tr>
    <td valign="top"><br /><br />
    <?
	$pf= $_POST['firma'];
		$firma="select * from firme where naziv_firme = '$pf'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$fp=$red["firma_id"];
			}
		$broj="select count(potrazivanja_id) as br from potrazivanja where firma_potrazuje = '$fp'";
			if(!$bro=mysql_query($broj)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
			if($red=mysql_fetch_array($bro)){
				$b=$red["br"];
				if($b > 0){echo " Firmi $pf duguju firme:<br><br>";}else{echo " Firmi $pf nitko ne duguje.";}
				}
		$firme="select * from potrazivanja where firma_potrazuje = '$fp' order by datum desc";
		if(!$fir=mysql_query($firme)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fir))
		{
			$k=$red["korisnik_id"];
			$iznos=$red["iznos"];
			$fid=$red["firma_duguje"];
			$dat=$red["datum"];
			$fie="select * from firme where firma_id = '$fid' order by naziv_firme asc";
		if(!$fi=mysql_query($fie)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fi)){
			$nf=$red["naziv_firme"];
			$osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($dat > $osam){
					echo "<li> <p class=\"style8\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
					}
			elseif ($dat < $osam and $dat > $petna){
				echo "<li> <p class=\"style15\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
				}
		elseif ($dat < $petna and $dat > $dvad){
			echo "<li> <p class=\"style20\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
			}
			elseif ($dat < $dvad and $dat > $trid){
				echo "<li> <p class=\"style30\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
				}
					else{
		echo "<li> $dat : $nf<br>Iznos dugovanja : $iznos kn</li>";
					}
			
			
			
			if($k > 0){
				$sql="select * from korisnik where korisnik_id = '$k'"; 
				if(!$firm=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm) and mysql_num_rows($firm) > 0){
			$ki=$red["korisnicko_ime"];
			echo "<ul>Potraživanje je unio korisnik: $ki.</ul><br>";
		}
			else{
			echo "<ul>Potraživanje je unio korisnik koji se više ne nalazi u bazi podataka.</ul><br>";
			}		
			
				}
				else{
					echo "<ul>Potraživanje je unio administrator.</ul><br>";
					}
				}
		}
	?>
    <br />
    </td>
  </tr>
  
</table>
</form>
<br /><br />
        <?
			}
			else{
				
			?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center">
     Firma za koju želite ispis dugovanja:<br><br>
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
    </tr>
    <tr>
    <td align="center" height="60">
    					<input type="submit" name="prikazp" value="Prikaži potraživanja" />
                        <input type="submit" name="prikazd" value="Prikaži dugovanja" />
    </td>
  </tr>
    <tr>
    <td valign="top"><br /><br />
    <?
	$pf= $_POST['firma'];
		$firma="select * from firme where naziv_firme = '$pf'";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$fp=$red["firma_id"];
			}
		$broj="select count(potrazivanja_id) as br from potrazivanja where firma_duguje = '$fp'";
			if(!$bro=mysql_query($broj)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
			if($red=mysql_fetch_array($bro)){
				$b=$red["br"];
				if($b > 0){echo " Firma $pf duguje:<br><br>";}else{echo " Firma $pf nema dugovanja.";}
				}
		$firme="select * from potrazivanja where firma_duguje = '$fp' order by datum desc";
		if(!$fir=mysql_query($firme)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fir))
		{
			$k=$red["korisnik_id"];
			$iznos=$red["iznos"];
			$fid=$red["firma_potrazuje"];
			$dat=$red["datum"];
			$fie="select * from firme where firma_id = '$fid' order by naziv_firme asc";
		if(!$fi=mysql_query($fie)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fi)){
			$nf=$red["naziv_firme"];
			
			$osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($dat > $osam){
					echo "<li> <p class=\"style8\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
					}
			elseif ($dat < $osam and $dat > $petna){
				echo "<li> <p class=\"style15\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
				}
		elseif ($dat < $petna and $dat > $dvad){
			echo "<li> <p class=\"style20\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
			}
			elseif ($dat < $dvad and $dat > $trid){
				echo "<li> <p class=\"style30\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
				}
					else{
		echo "<li> $dat : $nf<br>Iznos dugovanja : $iznos kn</li>";
					}
			
			
			
			if($k > 0){
				$sql="select * from korisnik where korisnik_id = '$k'"; 
				if(!$firm=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm) and mysql_num_rows($firm) > 0){
			$ki=$red["korisnicko_ime"];
			echo "<ul>Potraživanje je unio korisnik: $ki.</ul><br>";
		}
			else{
			echo "<ul>Potraživanje je unio korisnik koji se više ne nalazi u bazi podataka.</ul><br>";
			}		
				}
				else{
					echo "<ul>Potraživanje je unio administrator.</ul><br>";
					}
				}
		}
	?>
    <br />
    </td>
  </tr>
  
</table>
</form>
<br /><br />
        <?
			
				}
	
}
}
}
		}
	}
$ispisivanjea = new ispisivanjea();
$ispisivanjea -> Prikaz();
ob_flush();
?>