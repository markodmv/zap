<?php
ob_start();
class stranica
{
	var $sadrzaj;
	var $keywords = 'kompenzacije, zarada';
	
function SetSadrzaj($newsadrzaj) {
		$this -> sadrzaj = $newsadrzaj;
		}
function SetKeywords($newkeywords) {
		$this -> keywords = $newkeywords;
		}
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
function PrikazKeywords(){
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<meta name=\"keywords\" content=\"$this->keywords\">";
	echo "<meta name=\"author\" content=\"Webmaster: Marko Vašek\" />";
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
function PrikazPoc(){
		?>
        <style type="text/css">
<!--
body {
	background-image: url();
	background-color: #FFF;
}
-->
</style><table width="100%" align="center" bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0">
 <tr height="120" ><td>&nbsp;</td>
<td background="slike/loreana1.jpg">&nbsp;



</td>
</tr>
  <tr>
    <td height="40" width="30%" align="right"><img src="slike/gl2.png" width="200" height="40" /></td>
    			<td bgcolor="#999999" background="slike/d.png" align="center">
                <table width="700" height="40" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<?
    }
function PrikazMeni(){
	?>
    <ul  id="MenuBar1" class="MenuBarHorizontal" >
                    <li><a class="MenuBarItemSubmenu" href="registracijafirmi.php"> Registriranje novih firmi </a>
                      <ul>
                        <li><a href="registracijafirmi.php"> Registriranje novih firmi </a></li>
                         <li><a href="uredjivanjefirmi.php"> Uređivanje podataka firmi </a></li>
                      </ul>
                    </li>
                    <li><a class="MenuBarItemSubmenu" href="ispisivanje.php"> Dodavanje/Brisanje potraživanja</a>
                      <ul>
                        <li><a href="ispisivanje.php"> Ispisivanje potraživanja/dugovanja </a></li>
                        <li><a href="dodavanje.php"> Dodavanje potraživanja </a></li>
                        <li><a href="brisanje.php"> Brisanje potraživanja </a></li>
                      </ul>
                    </li>
                    <li><a href="kompenzacije.php"> Nađi kompenzaciju/most</a>
                    <ul>
                     <li><a href="kompenzacije.php"> Nađi kompenzaciju </a></li>
                     <li><a href="most.php"> Nađi most </a></li>
                    </ul>
            </li>
                  </ul>
    <?
	}
function PrikazDrugi(){
	?>
       </td>
  </tr>
</table>
    </td>
    
     <td height="40" width="30%" align="right"><img src="slike/3.png" width="200" height="40" /></td>
   
  </tr>
  <tr>
    <td height="520" bgcolor="#FFFFFF" valign="top">
    
    <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<?
	}
function PrikazLog(){
	?>
    &nbsp;
	<?
}
function PrikazDT(){
	?>
    </td>
  </tr>
  <tr>
    <td>
    <?
	}
function PrikazOglasi(){
	?>
    <table width="100%">
     <tr><td class="style41"><br /><br /><br />Ova web TVORNICA ima trenutnu cijenu:</td></tr>
<tr><td align="center" class="style40">
<?
		$firma="select count(potrazivanja_id) as potraga from potrazivanja";
		if(!$firm=mysql_query($firma)){echo"<br>Nastala je greška pri izvođenju upita!<br>".mysql_query();}
		if($red=mysql_fetch_array($firm)){
			$brp=$red["potraga"];
			$cijena= ($brp - 10119) * 2 + 100000;
			echo "<br>$cijena,00 €<br><br>";
			}
?>
</td></tr>
</table>
<a href="http://www.dzabe.net" target="_blank"><img src="http://www.dzabe.net/counter.php?page=www.zaposljavanje-kompenzacije.com&digits=3&unique=1" alt="brojac poseta" border="0"></a>
          
<br /><br /><br />
 Linkovi:
<br /><br />
<li><a href="http://www.zaposljavanje-kompenzacije.com/profit.php">Zarada na stranici</a></li>
<li><a href="http://www.loreana.hr">Loreana</a></li>
<li><a href="http://www.moj-manager.com">Moj-manager</a></li>
<li><a href="http://www.moj-manager.com/kompenzacije">Moj-manager/kompenzacije</a></li>
<li><a href="http://www.tvornica-ideja.com.hr">Tvornica ideja</a></li><br />
<li><a href="http://tvornica-ideja.blogspot.com/2011/08/prvi-koraci-u-ostvarenju-profita-preko.html">Prvi koraci u ostvarenju profita</a></li><br />
<li><a href="http://tvornica-ideja.blogspot.com/2011/08/elaborat-za-alternativni-plasman.html">Elaborat za alternativni plasman kredita s većom dobiti</a></li><br />
<li><a href="http://tvornica-ideja.blogspot.com/2011/08/ubrzavanje-naplate-potrazivanja.html">Ubrzavanje naplate potraživanja</a></li><br />
<br />
<table width="100%" border="2" cellpadding="1" cellspacing="1" bordercolor="#990000" bgcolor="#EAEBFF">
  <tr>
    <td align="center"> 
    <p><strong>Povežite se s bazom</strong></p> 
    <br />
      <a href="http://www.moj-manager.com">www.moj-manager.com</a><br /><br />
      
      Ako želite, kliknite <a href="http://moj-manager.com/upis.php">ovdje</a> i unesite svoj E-mail kako bi se povezali sa komercijalnim tržištem koje je u bazi.
    <br /><br />
 </td>
  </tr>
</table>
<br />
<img src="../slike/drvena_kuca1.jpg" width="80%" height="170" />
<br /><br />


<P><A href="http://www.freecondomsamples.org"><IMG border=0 
src="http://freecondomsamples.org/wp-content/uploads/Free-Condom-Samples.jpg" 
width=186 height=139></A></P>
<P>www.freecondomsamples.org</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P>&nbsp;</P>
<P><A href="http://alternateexteriorangles.net/"><IMG border=0 
src="http://alternateexteriorangles.net/wp-content/uploads/Alternate-Exterior-Angles.gif" 
width=178 height=108></A></P>
<P>http://alternateexteriorangles.net/</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P><A href="http://whatdosalamanderseat.net/"><IMG border=0 
src="http://whatdosalamanderseat.net/wp-content/uploads/What-Do-Salamanders-Eat.jpg" 
width=203 height=96></A></P>
<P>&nbsp;</P>
<P>http://whatdosalamanderseat.net/</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P><A href="http://kangolhatsformen.org/"><IMG border=0 
src="http://kangolhatsformen.org/wp-content/uploads/Kangol-Hats-For-Men.jpg" 
width=208 height=127></A></P>
<P>http://kangolhatsformen.org/</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P><A href="http://scrunchbottomswimwear.net/about/"><IMG border=0 
src="http://www.anita.co.za/images/swimwear1.jpg" width=138 height=156></A></P>
<P>&nbsp;</P>
<P>http://scrunchbottomswimwear.net</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P><A href="http://howtoinstallpavers.net/"><IMG border=0 
src="http://howtoinstallpavers.net/wp-content/uploads/How-To-Install-Pavers.gif" 
width=152 height=152></A></P>
<P>&nbsp;</P>
<P>http://howtoinstallpavers.net/</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P><A href="http://tomatoplantdiseases.net/"><IMG border=0 
src="http://tomatoplantdiseases.net/wp-content/uploads/Tomato-Plant-Diseases.gif" 
width=183 height=182></A></P>
<P>&nbsp;</P>
<P>http://tomatoplantdiseases.net/</P>
<P>&nbsp;</P>
<HR width="250" align="left">

<P><A href="http://thingstodoinbostonthisweekend.net/"><IMG border=0 
src="http://thingstodoinbostonthisweekend.net/wp-content/uploads/Things-To-Do-In-Boston-This-Weekend.jpg" 
width=189 height=126></A></P>
<P>http://thingstodoinbostonthisweekend.net/</P>
<P>
<HR width="250" align="left">
<P><A href="http://milkthistlesideeffects.net/">
<IMG border=0 
src="http://milkthistlesideeffects.net/wp-content/uploads/Milk-Thistle-Side-Effects.jpg" 
width=125 height=158>
</A></P>
<P>http://milkthistlesideeffects.net/</P>
<P>

<HR width="250" align="left">
<?
	}
function PrikazTreci(){
	?>
    </td>
  </tr>
</table>
    </td>
    <td width="100%" valign="top" class="style1">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC">
  <tr>
    <td align="center">

   <table width="80%" border="0" cellspacing="0" cellpadding="0" align="right">
  <tr>
    <td>


    <?
	}
function PrikazSadrzaj(){
	echo $this -> sadrzaj;
	}
function PrikazKraj(){
	?>
     <br /><br />
    <img src="slike/logo.jpg" width="685" height="208" />
    <br /><br />
    </td>
  </tr>
</table>
    </td>
  </tr>
</table>
<br /><br /><br />
<br /><br />
<ul>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5410074358406722";
/* Izrada oglasa */
google_ad_slot = "9538511290";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</ul>
    </td>
    
  </tr>
  <tr>
    <td height="40" valign="top" align="right"><img src="slike/dl2.png" width="200" height="40" /></td>
   <td bgcolor="#999999" align="center" background="slike/d.png"> Web systems and design by <a href="#">Marko Vašek</a></td>
     <td align="right" height="40" width="30%"><img src="slike/4.png" height="40" width="200"></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
    <?
    }
	}
	ob_flush();
	?>