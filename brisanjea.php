<?
ob_start();
include "spoj.php";
require 'stranica.php';
class brisanjea extends stranica{
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
<ul><li>Na popisu izaberite firmu za koju želite brisati doguvanja</li>
<li>Za brže pretraživanje, pritisnite prvo slovo u nazivu firme </li>
<li>Ispod popisa će se pojaviti firme koje duguju firmi koju Ste odabrali</li>
<li>Pored dugovanja koje želite obrisati kliknite na link "obriši"</li>
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
	
	if(!$_POST['prikaz']){
		?>
        <form action="" method="post">
        <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" width="50%">
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
       if($_POST['obrisi'])
                        {      
  
      
      if(is_array($_POST["check"]))
      {
          $i=0;
          foreach ($_POST["check"] as $che)
          {
              $query="delete from potrazivanja where potrazivanja_id = '".$che."'";
              mysql_query($query) or die(mysql_error());
              $i++;
          }
          echo "Broj obrisanih dugovanja : $i";
   
      }
      else
      {
         echo "Morate odabrati dugovanje koje želite obrisati."; 
      }
      
                        }
		}else{
			?>
        <form action="" method="post">
        <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center" width="50%">
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
			
                      				?>
  <form action="" method="post">

                <table width="500" border="1" cellspacing="1" cellpadding="1">
     <?  
                        
			/*$sql="delete from potrazivanja where potrazivanja_id = '$pid'";
			if (mysql_query($sql))
			{
			if (mysql_affected_rows() > 0 and mysql_affected_rows() < 2)
				{
				echo "<br> Dugovanje je uspješno obrisano!<br>";
				} 
			} else {echo "Nastala je greska pri brisanju podataka!<br />" . mysql_error();}							
*/
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
                                

		$firme="select * from potrazivanja where firma_potrazuje = '$fp'";
		if(!$fir=mysql_query($firme)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fir))
		{
			$fid=$red["firma_duguje"];
			$dat=$red["datum"];
			$p=$red["potrazivanja_id"];
			$fie="select * from firme where firma_id = '$fid'";
		if(!$fi=mysql_query($fie)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		while($red=mysql_fetch_array($fi)){
			$nf=$red["naziv_firme"];
			?>
            <tr>
    <td>
 
          <li>
            <?
           /* <a href="?action=obrisi&potrazivanja_id=<?=$p?>"> - Obriši </a>*/
			echo " $dat : $nf ";
			?>
      </td>
       
      <td width="100">
         Obrisati:  
          <input type="checkbox" name="check[]" value="<?=$p?>"/>
      </li>
 </td>
  </tr>
            <?
				}
		}
	?>
   
</table>
      
                     <br>
        <div align="center">
    <input type="submit" name="obrisi" value="Obriši odabrano"/>
        </div>
 </form>
 <?
          
   
   
                             
                                
                                
			}
	
}
}
}
		}
	}
$brisanjea = new brisanjea();
$brisanjea -> Prikaz();
ob_flush();
?>