<?
echo md5("Marijan");
if (!$db = mysql_connect("localhost", "root", "aurora"))
{
    echo mysql_error();
die ("<b>Ispricavamo se jer nismo u mogucnosti se spojiti na server!</b><br>Molimo pokušajte malo kasnije!</b>");
}
if (!mysql_select_db("mkd", $db))
{
die ("<b>Greska pri odabiru baze</b>");
}
?>