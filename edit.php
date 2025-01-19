<?php
$servername = "localhost:3306";
$username = "root";
$password = "1MG2024";
$dbname = "produktuakdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$row = "";
$id="";
$izena = "";
$mota = "";
$prezioa = "";
if (isset($_GET["izena"])) {
    $izena = ($_GET["izena"]);
}
if (isset($_GET["id"])) {
    $id = ($_GET["id"]);
}
if (isset($_GET["mota"])) {
    $mota = ($_GET["mota"]);
}
if (isset($_GET["prezioa"])) {
    $prezioa = ($_GET["prezioa"]);
}
?>
 
<form action="edit.php" method="get">
    <br>
    <label for="izena"> <strong>Erregistroa sartu: </strong></label>
    <br>
    <input type="text" name="id" id="id" value="" placeholder="sartu id-a" />
    <input type="text" name="izena" id="izena" value="" placeholder="sartu izena" />
    <input type="text" name="mota" id="mota" value="" placeholder="sartu mota" />
    <input type="number" name="prezioa" id="prezioa" value="" placeholder="..€">
    <button>Sartu</button>
</form>
 

 
 <?php
 $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$id'";
 
 if ($conn->query($sql) === TRUE) {
     echo "Record updated successfully";
 } else {
     echo "Error updating record: " . $conn->error;
 }

 $conn->close();
?>