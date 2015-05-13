<?
ob_start();
include "spoj.php";
require 'stranica.php';
class ispisivanje extends stranica{
	function Prikaz(){
	$this -> PrikazPP();
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

function PrikazPP(){
	if(isset($_COOKIE['ID_my_site'])) 
{ 
$username = $_COOKIE['ID_my_site']; 
$pass = $_COOKIE['Key_my_site']; 
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '$username'")or die(mysql_error()); 
while($info = mysql_fetch_array( $check )) 
{ 

if ($pass != $info['lozinka']) 
{ 
} 
else
{
header("Location: ispisivanjer.php");
}
}
}
	}
function PrikazLog(){	

if (isset($_POST['submit'])) { 
if(!$_POST['username'] | !$_POST['pass']) {
die ('Nisu popunjena zatražena polja.<br><a href="ispisivanje.php"> Pokušajte ponovo. </a>');
}
if (!get_magic_quotes_gpc()) {
$_POST['email'] = addslashes($_POST['email']);
}
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '".$_POST['username']."'")or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
die ('Ne postoji takav korisnik.<br><a href="ispisivanje.php"> Pokušajte ponovo. </a>');
}
while($info = mysql_fetch_array( $check )) 
{
$_POST['pass'] = stripslashes($_POST['pass']);
$info['lozinka'] = stripslashes($info['lozinka']);
$_POST['pass'] = md5($_POST['pass']);
if ($_POST['pass'] != $info['lozinka']) {
die ('Lozinka nije valjana.<br><a href="ispisivanje.php"> Pokušajte ponovo. </a>');
}
else 
{  
$_POST['username'] = stripslashes($_POST['username']); 
$hour = time() + 3600; 
setcookie(ID_my_site, $_POST['username'], $hour); 
setcookie(Key_my_site, $_POST['pass'], $hour); 
header("Location: ispisivanjer.php");
} 
} 
} 
else 
{ 
?> 
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<br> 
<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF"> 
<tr>
<td height="40" >
<a href="administrator.php">Administrator</a><br />
<hr width="150" align="left" />
</td>
</tr>
<tr>
<td height="35"> Korisni&#269;ko ime:<br>
    <input name="username" type="text" maxlength="50"></td>
</tr>
<tr>
<td height="35"> Lozinka:<br>
<input name="pass" type="password" maxlength="50"></td>
</tr> 
<tr>
<td height="40" colspan="2" align="center"> 
    <div align="center">
      <input type="submit" name="submit" value="Prijavi se"> 
    </div></td>
</tr>
<tr>
<td height="40" >
Niste registrirani?<br>
<a href="registracijakorisnika.php">Registrirajte se</a>
</td>
</tr>
</table> 
</form> 
<?
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
echo "Da bi mogli vidjeti ispis potrživanja morate biti korisnik!";
?><br /><br />Više na <a href="http://www.loreana.hr">www.loreana.hr</a>.<?
	/*if(!$_POST['prikaz']){
		?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" >
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
    <td align="center" height="60"><input type="submit" name="prikaz" value="Prikaži dugovanja" /></td>
  </tr>
</table>
</form>
<br /><br />
        <?
		}else{
			?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" >
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
    <td valign="top"><br />
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
			$iznos=$red["iznos"];
			$fid=$red["firma_duguje"];
			$dat=$red["datum"];
			$fie="select * from firme where firma_id = '$fid' order by naziv_firme asc";
		if(!$fi=mysql_query($fie)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fi)){
			$nf=$red["naziv_firme"];
			$dan= date("d", strtotime($dat));
			$datem = date("d")."-".date("m")."-".date("y");
			$m = date("m", strtotime($dat));
			$day= $dan + 7;
			$datum = $day."-".$m."-".date("Y", strtotime($dat));
			$danasnji=date("Ymd");
			$upisani = date ("Ymd", strtotime($datum));
			if($day > 30)
			{
			$day = - 30;
			$m = + 1;
			$datum = $day."-".$m."-".date("Y", strtotime($dat));
			$upisani = date ("Ymd", strtotime($datum));
			}
			if( $danasnji < $upisani){ 
			?>
			
			<?
			echo "<li> <p class=\"style2\">$dat : $nf <br>Iznos dugovanja : $iznos kn</p></li>";
			?>
		
			<?
			}
			else  { echo "<li> $dat : $nf<br>Iznos dugovanja : $iznos kn</li>"; }
			
			
				}
		}
	?>
    <br />
    </td>
  </tr>
  <tr>
    <td align="center" height="60"><input type="submit" name="prikaz" value="Prikaži dugovanja" /></td>
  </tr>
</table>
</form>
<br /><br />
        <?
}
		
	*/
	}
	}
$ispisivanje = new ispisivanje();
$ispisivanje -> Prikaz();
ob_flush();
?>