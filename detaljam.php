<?
ob_start();
include "spoj.php";
require 'stranica.php';
class detaljam extends stranica{
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
{ header("Location: index.php"); 
} 

else 
{
	?>
	<table width="80%" border="1" align="center" cellpadding="1" cellspacing="1">
  <tr align="center">
  	<td>Redni br.</td>
    <td>Naziv firme</td>
    <td>Adresa</td>
    <td>Telefon</td>
    <td>Fax</td>
    <td>Mobitel</td>
    <td>E-mail</td>
  </tr>
 


	<?
	$i=0;
	$firme=array("$_GET[firm1]", "$_GET[firm2]", "$_GET[firm3]", "$_GET[firm4]", "$_GET[firm5]", "$_GET[firm6]", "$_GET[firm7]", "$_GET[firm8]", "$_GET[firm9]", "$_GET[firm10]", "$_GET[firm11]", "$_GET[firm12]", "$_GET[firm13]", "$_GET[firm14]", "$_GET[firm15]", "$_GET[firm16]");
	foreach($firme as $firma)
	{
		
		if($firma > 0){	
		 $i++;
		 $sqlt="select * from firme where firma_id = '$firma'";
  if(!$ts=mysql_query($sqlt)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
  while ($redak=mysql_fetch_array($ts))
  {
	 
	  ?>
      
    <td><?=$i?></td>
    <td><?=$redak["naziv_firme"]?>&nbsp;</td>
    <td><?=$redak["adresa_firme"]?>&nbsp;</td>
    <td><?=$redak["telefon"]?>&nbsp;</td>
    <td><?=$redak["fax"]?>&nbsp;</td>
    <td><?=$redak["mobitel"]?>&nbsp;</td>
    <td><?=$redak["email"]?>&nbsp;</td>
   </tr>
	  <?
	  
	  }
		
		
		}
		
		}
	?>
       
        </table>
        <br /><br />
        <a href="mosta.php">Povratak.</a>
        <?
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
$detaljam = new detaljam();
$detaljam -> Prikaz();
ob_flush();
?>