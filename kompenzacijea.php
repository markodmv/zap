<?
ob_start();
include "spoj.php";
require 'stranica.php';
class kompenzacijea extends stranica{
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
		?><br><br>
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
    Firma za koju želite naći kompenzaciju:<br><br>
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
    Maksimalan broj firmi koje će sudjelovati<br /> u kompenzaciji:<br /><br />
    <select name="broj">
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
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
    Firma za koju želite naći kompenzaciju:<br><br>
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
    Maksimalan broj firmi koje će sudjelovati<br /> u kompenzaciji:<br /><br />
    <select name="broj">
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    <option>14</option>
    <option>15</option>
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
$firm="select * from firme where naziv_firme = '$firma'";
		if(!$fim=mysql_query($firm)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($fim)){
			$fid=$red["firma_id"];
			}
$brojfirmi=$_POST["broj"];
echo "Moguće kompenzacije za firmu $firma s ograničenjem na $brojfirmi firmi u nizu su:<br><br>";

$sqlo="select * from potrazivanja where firma_duguje = '$fid'";
if(!$fimo=mysql_query($sqlo)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fimo)){
			set_time_limit(200);
			$d1=$red["datum"];
			$dug1=$red["firma_potrazuje"];
			$pot1=$red["firma_duguje"];
			$sqla="select * from potrazivanja where firma_duguje = '$dug1'";
				if(!$fima=mysql_query($sqla)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
				while($red=mysql_fetch_array($fima)){
					$d2=$red["datum"];
				$dug2=$red["firma_potrazuje"];
				$pot2=$red["firma_duguje"];
				if($dug2 == $pot1)
						{ 
						$potovi=array("$pot1", "$pot2", "$dug2");
						$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
	  									
						$potnaz=$redak["naziv_firme"];
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
					echo " <p class=\"style8\">- $potnaz ............... $d</p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d</p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d</p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d</p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$dug2\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\"  align=\"left\"><br>";
						break;
						}
						
						$sqlb="select * from potrazivanja where firma_duguje = '$dug2'";
						if(!$fimb=mysql_query($sqlb)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
						while($red=mysql_fetch_array($fimb)){
							$d3=$red["datum"];
						$dug3=$red["firma_potrazuje"];
						$pot3=$red["firma_duguje"];
						if($pot3 == $pot1 || $pot3 == $pot2){break;}
						if($dug3 == $pot1)
							{
								$potovi=array("$pot1", "$pot2", "$pot3", "$dug3");
								$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
						$potnaz=$redak["naziv_firme"];
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
					echo " <p class=\"style8\">- $potnaz ............... $d</p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d</p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d</p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d</p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$dug3\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";
						break;
								}
								$cetiri="select * from potrazivanja where firma_duguje = '$dug3'";
								if(!$cet=mysql_query($cetiri)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
								while($red=mysql_fetch_array($cet)){
									$d4=$red["datum"];
								$dug4=$red["firma_potrazuje"];
								$pot4=$red["firma_duguje"];
								if($pot4 == $pot1|| $pot4 == $pot2|| $pot4 == $pot3){break;}
											if($dug4 == $pot1)
											{
													$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$dug4");
													$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
						$potnaz=$redak["naziv_firme"];
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
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$dug4\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
												}
													$pet="select * from potrazivanja where firma_duguje = '$dug4'";
													if(!$pe=mysql_query($pet)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
													while($red=mysql_fetch_array($pe)){
														$d5=$red["datum"];
													$dug5=$red["firma_potrazuje"];
													$pot5=$red["firma_duguje"];
													if($pot5 == $pot1|| $pot5 == $pot2|| $pot5 == $pot3|| $pot5 == $pot4){break;}
														if($dug5 == $pot1)
														{
															$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$dug5");
															$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
	  if($i==1) $d=$d1;
						if($i==2) $d=$d2;
						if($i==3) $d=$d3;
						if($i==4) $d=$d4;
						if($i==5) $d=$d5;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
							echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$dug5\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";
						break;
															}
															if($brojfirmi == 5){break;}
															$sest="select * from potrazivanja where firma_duguje = '$dug5'";
															if(!$ses=mysql_query($sest)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($ses)){
																$d6=$red["datum"];
															$dug6=$red["firma_potrazuje"];
															$pot6=$red["firma_duguje"];
															if($pot6 == $pot1|| $pot6== $pot2|| $pot6 == $pot3|| $pot6 == $pot4|| $pot6 == $pot5){break;}
															if($dug6 == $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$dug6");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
  if(!$s=mysql_query($sql)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($s))
  {
	  if($i==1) $d=$d1;
	  if($i==2) $d=$d2;
						if($i==3) $d=$d3;
						if($i==4) $d=$d4;
						if($i==5) $d=$d5;
						if($i==6) $d=$d6;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo " <p>- $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$dug6\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
																		}
																			if($brojfirmi == 6){break;}
															$sedam="select * from potrazivanja where firma_duguje = '$dug6'";
															if(!$sed=mysql_query($sedam)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($sed)){
																$d7=$red["datum"];
															$dug7=$red["firma_potrazuje"];
															$pot7=$red["firma_duguje"];
															if($pot7 == $pot1 || $pot7== $pot2 || $pot7 == $pot3 || $pot7 == $pot4 || $pot7 == $pot5 || $pot7 == $pot6){break;}
															if($dug7 == $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$dug7");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
					echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$dug7\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
																		}
																				if($brojfirmi == 7){break;}
															$osam="select * from potrazivanja where firma_duguje = '$dug7'";
															if(!$osa=mysql_query($osam)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($osa)){
																$d8=$red["datum"];
															$dug8=$red["firma_potrazuje"];
															$pot8=$red["firma_duguje"];
															if($pot8== $pot1 || $pot8 == $pot2 || $pot8 == $pot3 || $pot8 == $pot4 || $pot8 == $pot5 || $pot8 == $pot6 || $pot8 == $pot7){break;}
															if($dug8 == $pot1)
																{
																$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$dug8");
																$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
							echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$dug8\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
																		}
																								
																								if($brojfirmi == 8){break;}
															$devet="select * from potrazivanja where firma_duguje = '$dug8'";
															if(!$deve=mysql_query($devet)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($deve)){
																$d9=$red["datum"];
															$dug9=$red["firma_potrazuje"];
															$pot9=$red["firma_duguje"];
															if($pot9== $pot1 || $pot9== $pot2 || $pot9== $pot3|| $pot9== $pot4 || $pot9== $pot5|| $pot9== $pot6 || $pot9== $pot7 || $pot9== $pot8){break;}
															if($dug9 == $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$dug9");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$dug9\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
																		}
																		if($brojfirmi == 9){break;}
															$deset="select * from potrazivanja where firma_duguje = '$dug9'";
															if(!$des=mysql_query($deset)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($des)){
																$d10=$red["datum"];
															$dug10=$red["firma_potrazuje"];
															$pot10=$red["firma_duguje"];
															if($pot10 == $pot1 || $pot10== $pot2 || $pot10== $pot3 || $pot10== $pot4 || $pot10== $pot5 || $pot10== $pot6 || $pot10== $pot7 || $pot10== $pot8 || $pot10== $pot9){break;}
															if($dug10 == $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$pot10", "$dug10");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						if($i==10) $d=$d10;
						$potnaz=$redak["naziv_firme"];
							        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo " <p>- $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$pot10&firm11=$dug10\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
																		}
																		if($brojfirmi == 10){break;}
															$jedanaest="select * from potrazivanja where firma_duguje = '$dug10'";
															if(!$jed=mysql_query($jedanaest)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($jed)){
																$d11=$red["datum"];
															$dug11=$red["firma_potrazuje"];
															$pot11=$red["firma_duguje"];
															if($pot11== $pot1 || $pot11 == $pot2 || $pot11 == $pot3 || $pot11 == $pot4 || $pot11 == $pot5 || $pot11 == $pot6 || $pot11 == $pot7 || $pot11 == $pot8 || $pot11 == $pot9 || $pot11 == $pot10){break;}
															if($dug11 == $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$pot10", "$pot11", "$dug11");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						if($i==10) $d=$d10;
						if($i==11) $d=$d11;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$pot10&firm11=$pot11&firm12=$dug11\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";
						break;
																		}
																		if($brojfirmi == 11){break;}
															$dvanaest="select * from potrazivanja where firma_duguje = '$dug11'";
															if(!$dvana=mysql_query($dvanaest)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($dvana)){
																$d12=$red["datum"];
															$dug12=$red["firma_potrazuje"];
															$pot12=$red["firma_duguje"];
															if($pot12== $pot1 || $pot12 == $pot2 || $pot12 == $pot3 || $pot12 == $pot4 || $pot12 == $pot5 || $pot12 == $pot6 || $pot12 == $pot7 || $pot12 == $pot8 || $pot12 == $pot9 || $pot12 == $pot10 || $pot12 == $pot11){break;}
															if($dug12== $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$pot10", "$pot11", "$pot12", "$dug12");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						if($i==10) $d=$d10;
						if($i==11) $d=$d11;
						if($i==12) $d=$d12;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$pot10&firm11=$pot11&firm12=$pot12&firm13=$dug12\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";
						break;
																		}
																		if($brojfirmi == 12){break;}
															$trinaest="select * from potrazivanja where firma_duguje = '$dug12'";
															if(!$trina=mysql_query($trinaest)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($trina)){
																$d13=$red["datum"];
															$dug13=$red["firma_potrazuje"];
															$pot13=$red["firma_duguje"];
															if($pot13== $pot1 || $pot13 == $pot2 || $pot13 == $pot3 || $pot13 == $pot4 || $pot13 == $pot5 || $pot13 == $pot6 || $pot13 == $pot7 || $pot13 == $pot8|| $pot13 == $pot9 || $pot13 == $pot10 || $pot13 == $pot11 || $pot13 == $pot12){break;}
															if($dug13== $pot1)
																{
																$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$pot10", "$pot11", "$pot12", "$pot13", "$dug13");
																$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						if($i==10) $d=$d10;
						if($i==11) $d=$d11;
						if($i==12) $d=$d12;
						if($i==13) $d=$d13;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$pot10&firm11=$pot11&firm12=$pot12&firm13=$pot13?firm14=$dug13\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";	
						break;
																		}
																		if($brojfirmi == 13){break;}
															$cetrnaest="select * from potrazivanja where firma_duguje = '$dug13'";
															if(!$cetrnae=mysql_query($cetrnaest)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($cetrnae)){
																$d14=$red["datum"];
															$dug14=$red["firma_potrazuje"];
															$pot14=$red["firma_duguje"];
															if($pot14== $pot1 || $pot14 == $pot2 || $pot14 == $pot3 || $pot14 == $pot4 || $pot14 == $pot5 || $pot14 == $pot6 || $pot14 == $pot7 || $pot14 == $pot8 || $pot14 == $pot9 || $pot14 == $pot10 || $pot14 == $pot11 || $pot14 == $pot12 || $pot14 == $pot13){break;}
															if($dug14== $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$pot10", "$pot11", "$pot12", "$pot13", "$pot14", "$dug14");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						if($i==10) $d=$d10;
						if($i==11) $d=$d11;
						if($i==12) $d=$d12;
						if($i==13) $d=$d13;
						if($i==14) $d=$d14;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$pot10&firm11=$pot11&firm12=$pot12&firm13=$pot13?firm14=$pot14&firm15=$dug14\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";
						break;
																		}
																		if($brojfirmi == 14){break;}
															$petnaest="select * from potrazivanja where firma_duguje = '$dug14'";
															if(!$petnae=mysql_query($petnaest)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
															while($red=mysql_fetch_array($petnae)){
																$d15=$red["datum"];
															$dug15=$red["firma_potrazuje"];
															$pot15=$red["firma_duguje"];
															if($pot15== $pot1 || $pot15 == $pot2 || $pot15 == $pot3 || $pot15 == $pot4 || $pot15 == $pot5 || $pot15 == $pot6 || $pot15 == $pot7 || $pot15 == $pot8 || $pot15 == $pot9 || $pot15 == $pot10 || $pot15 == $pot11 || $pot15 == $pot12 || $pot15 == $pot13 || $pot15 == $pot14){break;}
															if($dug15== $pot1)
																{
																	$potovi=array("$pot1", "$pot2", "$pot3", "$pot4", "$pot5", "$pot6", "$pot7", "$pot8", "$pot9", "$pot10", "$pot11", "$pot12", "$pot13", "$pot14", "$pot15", "$dug15");
																	$i=1;
						foreach($potovi as $poto)
						{ $sql="select * from firme where firma_id = '$poto'";
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
						if($i==10) $d=$d10;
						if($i==11) $d=$d11;
						if($i==12) $d=$d12;
						if($i==13) $d=$d13;
						if($i==14) $d=$d14;
						if($i==15) $d=$d15;
						$potnaz=$redak["naziv_firme"];
								        $osamd = mktime(0,0,0,date("m"),date("d")-8,date("y"));
			$osam = date("Y-m-d H:i:s", $osamd);
			$petnad = mktime(0,0,0,date("m"),date("d")-15,date("y"));
			$petna = date("Y-m-d H:i:s", $petnad);
			$dvadd = mktime(0,0,0,date("m"),date("d")-20,date("y"));
			$dvad = date("Y-m-d H:i:s", $dvadd);
			$tridd = mktime(0,0,0,date("m"),date("d")-30,date("y"));
			$trid = date("Y-m-d H:i:s", $tridd);
			if($d > $osam){
					echo " <p class=\"style8\">- $potnaz ............... $d<br></p>";
					}
			elseif ($d < $osam and $d > $petna){
				echo " <p class=\"style15\">- $potnaz ............... $d<br></p>";
				}
		elseif ($d < $petna and $d > $dvad){
			echo " <p class=\"style20\">- $potnaz ............... $d<br></p>";
			}
			elseif ($d < $dvad and $d > $trid){
				echo " <p class=\"style30\">- $potnaz ............... $d<br></p>";
				}
					else{
		echo "<p> - $potnaz ............... $d</p>";
					}
							$i++;
  }
							}
						echo "<br><a href=\"detalja.php?firm1=$pot1&firm2=$pot2&firm3=$pot3&firm4=$pot4&firm5=$pot5&firm6=$pot6&firm7=$pot7&firm8=$pot8&firm9=$pot9&firm10=$pot10&firm11=$pot11&firm12=$pot12&firm13=$pot13?firm14=$pot14&firm15=$pot15&firm16=$dug15\">Ispis detalja</a><br>";
						echo "<hr width=\"55%\" align=\"left\"><br>";
						break;
																		}
																		if($brojfirmi == 15){break;}
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
$kompenzacijea = new kompenzacijea();
$kompenzacijea -> Prikaz();
ob_flush();
?>