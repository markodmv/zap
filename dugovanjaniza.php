<?
ob_start();
include "spoj.php";
require 'stranica.php';
class dugovanjaniza extends stranica{
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
function PrikazSadrzaj(){
	
			?>
        <br><br>
        <div align="center"> <h3>Posebna pogodnost : Prvih 5 registriranih korisnika dobiva besplatno prvih mjesec dana korištenja .::Kompenzatora::.</h3> </div>


Kratke upute:<br><br>
<ul><li>Na popisu izaberite firmu za koju želite tražiti kompenzaciju</li>
<li>Za brže pretraživanje, pritisnite prvo slovo u nazivu firme</li>
<li>Desno od popisa, na padajućem izboriku izaberite maksimalan broj firmi u Vašoj kompenzaciji</li>
<li>Kliknite na tipku kreni</li>
<li><a name="gore">Ispod će se pojaviti kompezacije, ukoliko postoje</a></li>
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
	{ header("Location: index.php"); } 
else 
	{
		if(!$_POST['prikaz']){
			
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
							  else {
								 
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
	
								  
$firma=$_POST["firma"];
echo "<br>Firma: $firma<br>";
$firm="select * from firme where naziv_firme = '$firma'";
		if(!$fim=mysql_query($firm)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($fim)){
			$fid=$red["firma_id"];
			//echo "<br>FID1: $fid<br>";
			}
			else{echo "<br>Firma nije pronađena!<br>";}
			//echo "<br>fid = $fid";
$brojniza=$_POST["broj"];

echo "<br>Ispis dugovanja u nizu ($brojniza):<br><br>";  
//echo "<br>FID2: $fid<br>";
$name="select * from potrazivanja where firma_duguje = $fid order by datum desc";
if(!$nam=mysql_query($name)){echo "<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
while($red=mysql_fetch_array($nam))
{
$fidi=$red["firma_duguje"];
$fidii=$red["firma_potrazuje"];
for ($i=1; $i<=$brojniza; $i++){
	$fidel=$fidi;
	$fideli=$fidii;
	//echo "<br>fidel = fid = $fidel";
	if($i == 1){
	$dug="select * from potrazivanja where firma_duguje = $fidel and firma_potrazuje = $fideli order by datum desc";
	if(!$du=mysql_query($dug)){echo "<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
	if($red=mysql_fetch_array($du)){
		$d=$red["datum"];
		$firma_ime=$red["firma_duguje"];
		$fidi=$red["firma_potrazuje"];
		}
	}
	else{
		$fidel=$fidi;
		$dug="select * from potrazivanja where firma_duguje = $fidel order by datum desc";
	if(!$du=mysql_query($dug)){echo "<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
	if($red=mysql_fetch_array($du)){
		$d=$red["datum"];
		$firma_ime=$red["firma_duguje"];
		$fidi=$red["firma_potrazuje"];
		}
		
	}
	
		$naziv="select * from firme where firma_id = $fidel";
		if(!$naz=mysql_query($naziv)){echo "<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($redak=mysql_fetch_array($naz)){
			
			?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
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
                  <td width="20" align="center"><?=$i?></td>
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?
					}
			elseif ($d < $osam and $d > $petna){
				    ?>
                  <tr bgcolor="#006600">
                  <td width="20" align="center"><?=$i?></td>
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?
				}
		elseif ($d < $petna and $d > $dvad){
			  ?>
                  <tr bgcolor="#FF3300">
                  <td width="20" align="center"><?=$i?></td>
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?
			}
			elseif ($d < $dvad and $d > $trid){
				   ?>
                  <tr bgcolor="#663300">
                  <td width="20" align="center"><?=$i?></td>
                  <td align="left" class="style50"><?=$redak["naziv_firme"]?></td>
                  <td align="center" width="200" class="style50"><?=$d?></td>
                  </tr>
                   <?

				}
					else{
	     	?>
            <tr bgcolor="#CCCCCC">
            <td width="20" align="center"><?=$i?></td>
            <td align="left"><?=$redak["naziv_firme"]?></td>
            <td align="center" width="200"><?=$d?></td>
  	        </tr>
            <?
					}
					?> 
</table>
<?
		$nizbroj=$brojniza;
	   if($i == $nizbroj){
		   echo "<br><br><br>";
		   break;}
	   $novi_fid=$fidi;
		$r=$redak["naziv_firme"];
		//echo "<br>novi fid = $fid";
		if($i > 1){
		if ($novi_fid == $fidel){
		echo "Firma $r nema dugovanja!<br><br>";
		break;}
		
					}
					
	
		}
	}
	?>
    <a href="#gore">Vrati se na početak stranice</a><br /><br />
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
$dugovanjaniza = new dugovanjaniza();
$dugovanjaniza -> Prikaz();
ob_flush();
?>