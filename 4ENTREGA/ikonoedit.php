<?php
$servername = "localhost:3306";
$username = "root";
$password = "1MG2024";
$dbname = "entrega4";

$conn = new mysqli($servername, $username, $password, $dbname);
$row = "";
$id="";
$izena = "";
$mota = "";
$prezioa = "";
if (isset($_GET["izena"])) {
    $izena = ($_GET["izena"]);
}
if (isset($_GET["ProduktuId"])) {
    $id = ($_GET["ProduktuId"]);
}
if (isset($_GET["mota"])) {
    $mota = ($_GET["mota"]);
}
if (isset($_GET["prezioa"])) {
    $prezioa = ($_GET["prezioa"]);
}
?>
 
<form action="ikonoedit.php" method="get">
    <br>
    <label for="izena"> <strong>Erregistroa sartu: </strong></label>
    <br>
    <input type="text" name="id" id="id" />
    <input type="text" name="izena" id="izena" />
    <input type="text" name="mota" id="mota"/>
    <input type="number" name="prezioa" id="prezioa" >
    <button>Sartu</button>
</form>
 
 <?php
 $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE ProduktuId='$id'";
 
 $conn->close();
?>