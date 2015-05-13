<?
//ob_start();
include "spoj.php";
require 'stranica.php';
class mosta extends stranica{
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
<ul><li>Ova funkcija služi za pronalaženje "mostova" prilikom pucanja kompenzacije</li>
<li>Na lijevom popisu odaberite firmu od koje želite početi</li>
<li>Na desnoj strani odaberite firmu do koje će ići Vaš most</li>
<li>Na padajućem izborniku odaberite broj firmi u mostu, preporučamo da probate s manjim brojem</li>
</ul><br><br>
<hr width="500" align="center"><br><br>

<br />
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
    Firma od koje želite početi:<br><br>
     <select name="firmapoc" size="10">
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
     Firma do koje će ići vaš most:<br><br>
     <select name="firmakraj" size="10">
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
    <td align="center" colspan="2">
    Maksimalan broj firmi koje će sudjelovati<br /> u kompenzaciji:<br /><br />
    <select name="broj">
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
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
		}else{
			?>
        <form action="" method="post">
        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" width="50%">
    Firma od koje želite početi:<br><br>
     <select name="firmapoc" size="10">
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
     Firma do koje će ići vaš most:<br><br>
     <select name="firmakraj" size="10">
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
    <td align="center" colspan="2">
    Maksimalan broj firmi koje će sudjelovati<br /> u kompenzaciji:<br /><br />
    <select name="broj">
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
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
$firmapoc=$_POST["firmapoc"];
$firmakraj=$_POST["firmakraj"];
$firm="select * from firme where naziv_firme = '$firmapoc'";
		if(!$fim=mysql_query($firm)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($fim)){
			$fidp=$red["firma_id"];
			}
			$firmk="select * from firme where naziv_firme = '$firmakraj'";
		if(!$fimk=mysql_query($firmk)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($fimk)){
			$fidk=$red["firma_id"];
			}
$brojfirmi=$_POST["broj"];
echo "Mogući mostovi od firme $firmapoc do firme $firmakraj s ograničenjem na $brojfirmi firmi u nizu su:<br><br><br><br>";



			$sql1="select * from potrazivanja where firma_duguje = '$fidp' order by datum desc";
			if(!$fimo1=mysql_query($sql1)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fimo1))
				{
					set_time_limit(200);
					$d1=$red["datum"];
					$fird1=$red["firma_duguje"];
					$potrazuje1=$red["firma_potrazuje"];
					if($fird1==0){ continue; }
					if($potrazuje1==0){ continue; }
					if($potrazuje1==$fidk){ continue; }
					if($potrazuje1==$fidp){ continue; }
					
					$sql2="select * from potrazivanja where firma_duguje = '$potrazuje1' order by datum desc";
					if(!$fimo2=mysql_query($sql2)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo2))
						{
					$d2=$red["datum"];
					$fird2=$red["firma_duguje"];
					$potrazuje2=$red["firma_potrazuje"];
					if($fird2==0){ continue; }
					if($potrazuje2==0){ continue; }
					if($potrazuje2==$fidp){ continue; }
					if($potrazuje2==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$potrazuje2");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
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
											$i++;
											
											}
											
											}
											?>
 
</table>

<?
											echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$potrazuje2\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
									}
							$sql3="select * from potrazivanja where firma_duguje = '$potrazuje2' order by datum desc";
					if(!$fimo3=mysql_query($sql3)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo3))
						{
					$d3=$red["datum"];
					$fird3=$red["firma_duguje"];
					$potrazuje3=$red["firma_potrazuje"];
					if($fird3==0){ continue; }
					if($potrazuje3==0){ continue; }
					if($potrazuje3==$fidp || $potrazuje3==$fird2){	continue; }
					if($potrazuje3==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$potrazuje3");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$potrazuje3\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						$sql4="select * from potrazivanja where firma_duguje = '$potrazuje3' order by datum desc";
					if(!$fimo4=mysql_query($sql4)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo4))
						{
					$d4=$red["datum"];
					$fird4=$red["firma_duguje"];
					$potrazuje4=$red["firma_potrazuje"];
					if($fird4==0){ continue; }
					if($potrazuje4==0){ continue; }
					if($potrazuje4==$fidp || $potrazuje4==$fird2 || $potrazuje4==$fird3){	continue; }
					if($potrazuje4==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$fird4", "$potrazuje4");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
											if($i==4) $d=$d4;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$fird4&firm5=$potrazuje4\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						if($brojfirmi == 5){continue;}
$sql5="select * from potrazivanja where firma_duguje = '$potrazuje4' order by datum desc";
					if(!$fimo5=mysql_query($sql5)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo5))
						{
					$d5=$red["datum"];
					$fird5=$red["firma_duguje"];
					$potrazuje5=$red["firma_potrazuje"];
					if($fird5==0){ continue; }
					if($potrazuje5==0){ continue; }
					if($potrazuje5==$fidp || $potrazuje5==$fird2 || $potrazuje5==$fird3 || $potrazuje5==$fird4){	continue; }
					if($potrazuje5==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$fird4", "$fird5", "$potrazuje5");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
											if($i==4) $d=$d4;
											if($i==5) $d=$d5;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$fird4&firm5=$fird5&firm6=$potrazuje5\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						if($brojfirmi == 6){continue;}
$sql6="select * from potrazivanja where firma_duguje = '$potrazuje5' order by datum desc";
					if(!$fimo6=mysql_query($sql6)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo6))
						{
					$d6=$red["datum"];
					$fird6=$red["firma_duguje"];
					$potrazuje6=$red["firma_potrazuje"];
					if($fird6==0){ continue; }
					if($potrazuje6==0){ continue; }
					if($potrazuje6==$fidp || $potrazuje6==$fird2 || $potrazuje6==$fird3 || $potrazuje6==$fird4 || $potrazuje6==$fird5){	continue; }
					if($potrazuje6==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$fird4", "$fird5", "$fird6", "$potrazuje6");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
											if($i==4) $d=$d4;
											if($i==5) $d=$d5;
											if($i==6) $d=$d6;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$fird4&firm5=$fird5&firm6=$fird6&firm7=$potrazuje6\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						if($brojfirmi == 7){continue;}
$sql7="select * from potrazivanja where firma_duguje = '$potrazuje6' order by datum desc";
					if(!$fimo7=mysql_query($sql7)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo7))
						{
					$d7=$red["datum"];
					$fird7=$red["firma_duguje"];
					$potrazuje7=$red["firma_potrazuje"];
					if($fird7==0){ continue; }
					if($potrazuje7==0){ continue; }
					if($potrazuje7==$fidp || $potrazuje7==$fird2 || $potrazuje7==$fird3 || $potrazuje7==$fird4 || $potrazuje7==$fird5 || $potrazuje7==$fird6){	continue; }
					if($potrazuje7==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$fird4", "$fird5", "$fird6", "$fird7", "$potrazuje7");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
											if($i==4) $d=$d4;
											if($i==5) $d=$d5;
											if($i==6) $d=$d6;
											if($i==7) $d=$d7;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$fird4&firm5=$fird5&firm6=$fird6&firm7=$fird7&firm8=$potrazuje7\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						if($brojfirmi == 8){continue;}
$sql8="select * from potrazivanja where firma_duguje = '$potrazuje7' order by datum desc";
					if(!$fimo8=mysql_query($sql8)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo8))
						{
					$d8=$red["datum"];
					$fird8=$red["firma_duguje"];
					$potrazuje8=$red["firma_potrazuje"];
					if($fird8==0){ continue; }
					if($potrazuje8==0){ continue; }
					if($potrazuje8==$fidp || $potrazuje8==$fird2 || $potrazuje8==$fird3 || $potrazuje8==$fird4 || $potrazuje8==$fird5 || $potrazuje8==$fird6 || $potrazuje8==$fird7){	continue; }
					if($potrazuje8==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$fird4", "$fird5", "$fird6", "$fird7", "$fird8", "$potrazuje8");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
											if($i==4) $d=$d4;
											if($i==5) $d=$d5;
											if($i==6) $d=$d6;
											if($i==7) $d=$d7;
											if($i==8) $d=$d8;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$fird4&firm5=$fird5&firm6=$fird6&firm7=$fird7&firm8=$fird8&firm9=$potrazuje8\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						if($brojfirmi == 9){continue;}
$sql9="select * from potrazivanja where firma_duguje = '$potrazuje8' order by datum desc";
					if(!$fimo9=mysql_query($sql9)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
					while($red=mysql_fetch_array($fimo9))
						{
					$d9=$red["datum"];
					$fird9=$red["firma_duguje"];
					$potrazuje9=$red["firma_potrazuje"];
					if($fird9==0){ continue; }
					if($potrazuje9==0){ continue; }
					if($potrazuje9==$fidp || $potrazuje9==$fird2 || $potrazuje9==$fird3 || $potrazuje9==$fird4 || $potrazuje9==$fird5 || $potrazuje9==$fird6 || $potrazuje9==$fird7 || $potrazuje9==$fird8){	continue; }
					if($potrazuje9==$fidk)
									{
									$ispis=array("$fird1", "$fird2", "$fird3", "$fird4", "$fird5", "$fird6", "$fird7", "$fird8", "$fird9", "$potrazuje9");
									$i=1;
									?>
                                    <table width="60%" border="0" cellspacing="1" cellpadding="0">
<?
									foreach($ispis as $ispisi)
						{ $sql="select * from firme where firma_id = '$ispisi'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  											{
											if($i==1) $d=$d1;
											if($i==2) $d=$d2;
											if($i==3) $d=$d3;
											if($i==4) $d=$d4;
											if($i==5) $d=$d5;
											if($i==6) $d=$d6;
											if($i==7) $d=$d7;
											if($i==8) $d=$d8;
											if($i==9) $d=$d9;
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
											$i++;
											
											}
											
							}
							?>
 
</table>

<?
								echo "<br><a href=\"detaljam.php?firm1=$fird1&firm2=$fird2&firm3=$fird3&firm4=$fird4&firm5=$fird5&firm6=$fird6&firm7=$fird7&firm8=$fird8&firm9=$fird9&firm10=$potrazuje9\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
											
										}
						
						//sljedeći
						
						}
						
						}
						
						}
						
						}
						
						
						}
						
						}
						
						}
					
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
$mosta = new mosta();
$mosta -> Prikaz();
//ob_flush();
?>