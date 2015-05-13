<?
ob_start();
include "spoj.php";
require 'stranica.php';
class profit extends stranica{
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
	$this -> PrikazSadrzaj($sadrzaj);
	$this -> PrikazKraj();
	echo "</body>\n</html><br><br><br><br>";
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
header("Location: indexr.php");
}
}
}
	}

function PrikazLog(){	

if (isset($_POST['submit'])) { 
if(!$_POST['username'] | !$_POST['pass']) {
die ('Nisu popunjena zatražena polja.<br><a href="index.php"> Pokušajte ponovo. </a>');
}
if (!get_magic_quotes_gpc()) {
$_POST['email'] = addslashes($_POST['email']);
}
$check = mysql_query("SELECT * FROM korisnik WHERE korisnicko_ime = '".$_POST['username']."'")or die(mysql_error());
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
die ('Ne postoji takav korisnik.<br><a href="index.php"> Pokušajte ponovo. </a>');
}
while($info = mysql_fetch_array( $check )) 
{
$_POST['pass'] = stripslashes($_POST['pass']);
$info['lozinka'] = stripslashes($info['lozinka']);
$_POST['pass'] = md5($_POST['pass']);
if ($_POST['pass'] != $info['lozinka']) {
die ('Lozinka nije valjana.<br><a href="index.php"> Pokušajte ponovo. </a>');
}
else 
{  
$_POST['username'] = stripslashes($_POST['username']); 
$hour = time() + 3600; 
setcookie(ID_my_site, $_POST['username'], $hour); 
setcookie(Key_my_site, $_POST['pass'], $hour); 
header("Location: indexr.php");
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
	}
$profit = new profit();
$profit -> SetSadrzaj('
					 <br><br>
				<div align="left">
					Prvi koraci u ostvarenju profita preko <a href="http://tvornica-ideja.blogspot.com/2011/08/prvi-koraci-u-ostvarenju-profita-preko.html">www.moj-manager.com/kompenzacije</a><br>
Na bazi mišljenja MINISTARSTVA ZNANOSTI OBRAZOVANJA I ŠPORTA<br><br>


Prvi korak:<br>
Potrebno je napraviti KONCESIJSKI UGOVOR (uzmi-rentaj-vrati) ……………….cijena 0 kuna – U PRILOGU KONCESIJSKOG UGOVORA<br> I MIŠLJENJE MINISTARSTVA.
(sve će Vam biti priređeno)<br><br>

Drugi korak:<br><br>

Da Vas educiramo osnovnom služenju tog programa i osnovne tehnike<br>
……………….cijena 0 kuna<br><br>

Treći korak:<br>
Pronaći potencijalne ne zaposlene ili zaposlene osobe koje bi se prekvalificirale i postale<br>
-Komercijalista<br>
-Kompenzacijski komercijalista<br><br>

(ali im se ne izdaje diploma nego potvrda ako su uspješno završile obuku)<br><br>

Te iste osobe morate naučiti osnovnim pojmovima ono što Vas mi naučimo da prenesete na njih a ostalo ćemo <br>edukacijom.<br>
Te iste osobe, imate dužnost s nama skupa plasirati na  tržištu kao izgrađeni kadar i ne smije nitko ostati ne<br> zaposlen jedino ako se neće zaposliti.<br><br>

Ponude s tržišta da se traži  kadar, morate im predočiti. Pa ako hoće ili neće pristati na ponuđene uvjete s<br> tržišta.<br>
Vodite evidenciju i o kadru i potrebama s tržišta.<br>
Ovo su poslovi na daljinu pa Vam ne mora osoba dolaziti u ured da je obučite a isto tako osoba iz Splita može<br> raditi za tvrtku iz Bjelovara a da ne mora živjeti u Bjelovaru. Ostaje živjeti u Splitu . To olakšava ljudima<br> pristup poslu.<br><br>

Primjer: ponudite tržištu telefonom ili faxom službe koje obučavate-obučavamo pa će te iz prve ruke u pregovorima<br> vidjeti promišljanja subjekata ali prvo da krenemo s temeljima.<br><br>

Četvrti korak:<br>
Taj kadar plaća 2.000,00 kn + PDV i  priučen kod Vas, poslati ga do nas na zaključno usavršavanje.<br><br>

Peti korak:<br>
Dok se obučavaju nuditi ih tržištu tako da imamo plan tko ih treba i za koju strukturu posla ili koju će granu<br> gospodarstva raditi u toj tvrtci ili na kojim odjelu će poslovati.<br>
………………cijenu treba platiti tržište 7.000,00 kuna + PDV<br><br>

Tržištu dajete izbor od 3 osobe ako je uplatio po predračunu za jednu osobu a ako primi dvije dužan  je uplatiti<br> za novoprimljenu osobu.<br><br>

Taj subjekt pošto uzima kadar mora uzeti u najam i program jer su osobe obučene raditi na njemu.<br>
……………….cijena 500,00 kn/mj + PDV<br><br>

Šesti korak:<br><br>

Napomena:<br>
Dužnost nam je odgojiti-izgraditi kadar i plasirati ga tržištu što našem tako i šire. Može za početak u regiji <br>BIH, SRBIJI itd.<br><br><br>




REKAPITULACIJA:<br><br>

Plaća polaznik……………………………………….2.000,00 kn+ PDV<br>
Plaća tvrtka koja želi kadar………………………….7.000,00 kn +PDV<br>
Plaća tvrtka 500,00/ mj korištenje prograx12 mj…... 6.000,00 kn + PDV<br><br>

Ukupno:……………………………………………..15.000,00 kn<br>
(na godišnjem nivo za jednu osobu)<br><br>

Od toga programeru 4 % za praćenje i poboljšavanje produktivnosti i nadgradnji<br>
(plaćanje suautorskog ugovora ili ugovora o djelu)<br><br>

Ostaje ukupno cca……………………………………….14.400,00<br>
To dijelimo 50:50 % jer zajedno istražujemo tržište-educiramo i zajedno plasiramo kadar.<br><br>

Plaćanje:<br>
Najprije pravimo ugovor o djelu i suautorski ugovor ili ako ste tvtka ugovor o poslovno tehničkoj suradnji.<br>
Ugovor će definirati prava i obveze a prema zakonu RH.<br><br>

Zaključak : OVO JE ZARADA SAMO NA JEDNOJ OSOBI , ŠTO GOVORI DA VAM OSTANE ……………………..7.200,00 kn + PDV <br><br>


Međutim, ostavljamo vremenu kako bi zajednički izvršili korekciju. Ovo su konture kako bi krenuli s mrtve točke.<br>
Za sad smo mi savjetnik a kasnije možete postati i Vi u hodu, ovisi koliko želite učiti i uzdizati se i razvijati<br> ovakav oblik prihodovanja plasmanom znanja.<br><br>

Napomena:<br>
Ovdje nije ubačeno u obračun zarada od pojedinačne  i grupne zarade na KOMPENZACIJAMA.<br><br>

Ako radite operativno možete nakon trećeg mjeseca zarađivati 5.000,00 s tendencijom rasta.<br>
Ako radite i  globalno možete još slične takve vrijednosti.<br>
Međutim, to nije sve jer nije sve obuhvaćeno što bi mogli skupno obavljati i razvijati se.<br>
Vašu specijalnost možemo odrediti preko par pitanja koje će biti u hodu na koje nam morate dati odgovor kako bih<br> spoznali gdje ste u ovim kategorijama najbliži a sve se da naučiti ako hoćete.<br><br>

Molim zainteresirane da se jave na e-mail : posredovanje@vip.hr<br><br><br><br><br>

<a href="http://tvornica-ideja.blogspot.com/2011/08/elaborat-za-alternativni-plasman.html">ELABORAT ZA ALTERNATIVNI PLASMAN KREDITA S VEĆOM DOBITI </a>
<br><br><br><br>

Kako imati veću kamatu na kredite ?<br>
Razmatrajući kako sigurnije plasirati sredstva i ubrizgavati ih u pojedine grane gospodarstva , dolazimo do jednog<br> vrlo kvalitetnog rješenja, primjenljivog u našim uvjetima poslovanja.<br><br>

Mi smo tvrtka „Loreana d.o.o.“ koja bi vukla od Vas likvidna sredstva na bazi unaprijed zatvorenih otkupnih <br>kompenzacija .(Ugovor o otkupu)<br>
Loreana -> Banka -> vaš vjerovnik -> vjerovnikov vjerovnik-> Loreana<br><br>

Mi bi prihvatili cijenu likvidnih sredstava od Banke do 1,5 % + PDV a prema iznosu na otkupnoj kompenzaciji što na<br> godišnjem nivou je 18 %+PDV.<br>
Plaćanje po zatvorenoj otkupnoj kompenzaciji do 3-5 dana umanjeno za ugovoreni postotak 1,5 % + PDV ako se <br>dogovorimo-ugovorimo s Vama.<br><br>

Napomena:<br>
Tu je potrebno zadužiti  jednu Vašu osobu ili više koje će voditi ovo poslovanje ako se ovo prihvati od strane<br> Vas.<br><br>

Tržištu je ovo prihvatljivo !<br>
Međutim, postavlja se pitanje da li Banka ima toliko dugovanja prema svojim vjerovnicima ? Kolika je potreba za<br> otkupom ?<br><br>

Da bi Banka imala i dugovanja, dovodimo Vam potencijalne klijente korisnike kredita koji će uzimati kredite 70 % u<br> likvidnoj masi a 30 % preko višestruki kompenzacija<br>
(otkupnih kompenzacija) gdje bi oni zatvarali svoje vjerovnike-dobavljače a po odobrenom kreditu oni postaju Vaš<br> vjerovnik.<br>
(Odnos je stavljen paušalno, može i 50 % likvidna sredstva a 50 % zatvaranje vjerovnikovih vjerovnika)<br>
Na taj način za ovih 30 % ili 50 % bi BANKA  imala kod nas kamatu 1,5 % na apsolutni iznos otkupne <br>kompenzacije-preuzetih likvidnih sredstava. Isto tako i kod njih-klijenta  bila bi kamata prema izračunu i <br>ekonomskoj opravdanosti Banke.<br>
Na ovaj način se otvara široka fronta potencijalno zainteresiranih za  otkupne kompenzacije i klijenti <br>potencijalni korisnici kredita pod ovim uvjetima ili sličnim uvjetima.<br>
Prema tome u takvom interesu otvara se novo tržište za plasman pod različitim uvjetima-gibljivim i raznim <br>varijantama s kombinatorikom odnosa.<br><br>

Primjer zatvaranja 1. (OBRTAJ za ostatak 30 %-50 % klijent-ovog  odobrenog kredita)<br>
Loreana-> Banka-> klijent korisnik kredita->vjerovnik klijenta->Loreana<br><br>

Molimo Vas da nas pozovete da zajednički elaboriramo ovaj projekt.-program.<br><br><br><br><br>


<a href="http://tvornica-ideja.blogspot.com/2011/08/ubrzavanje-naplate-potrazivanja.html">UBRZAVANJE NAPLATE POTRAŽIVANJA</a>
<br><br><br>
<br>


1.<br>
Spremni smo Vam osiguravati gorivo na Benzinskim crpkama uz 5 % +PDV (bilo koje crpke) na bazi vaših sadašnjih i<br> budućih potraživanja<br><br>

2.<br>
Spremni smo Vam osiguravati likvidna sredstva na Vaš ŽR na bazi sadašnjih i budućih potraživanja od 8-10 % ovisno<br> gdje su vam pozicionirana potraživanja.<br><br>

3.<br>
Spremni smo zatvarati erste card-diners, pbz card-american INA, HEP, Leasing i druge prioritene dobavljače uz 4-5<br> % + PDV<br><br>

Za sve se obratite na : Mob:095 894 36 11<br>
e-mail: posredovanje@vip.hr<br><br>
</div>					
 ');
$profit -> Prikaz();
ob_flush();
?>