<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <!--web orrialdearen tituloa-->
    <title>Formulario - Produktuak</title>
    <!--Jarritako ikonoak ikusteko jarri behar den linka-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!--style.css deitutako css orrialdeari deia egiteko-->
    <link rel="stylesheet" href="style.css">
    <script>
        //JavaScript-eko funtzio bati egiten dio deia, gero INSERT-a egin ahal izateko, eta formularioa erakusteko
        function showAddForm() {
            document.getElementById('addForm').style.display = 'block';
        }
    </script>
</head>
<body>

<?php
//datu-baseko konexioa egiten du 
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "gp_froga";

$conn = new mysqli($servername, $username, $password, $dbname);
//konektatzen ez bada errorea emango du, bestela ez da ezer aterako
if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error);
}
//arraya definitzen du
$bilaketa = "";
$mota_filtratu = "";
if (isset($_POST['bilatu'])) {
    $bilaketa = $conn->real_escape_string($_POST['bilaketa']);
    $mota_filtratu = $conn->real_escape_string($_POST['mota_filtratu']);
}

?>
<!--Formulario bat sortzen du produktu motak bertan definitzeko-->
<div id="search">
    <form method="POST">
        <label for="bilaketa">Bilatu:</label>
        <!--Testu-kutxa bat sortzen du, erabiltzaileak izen bat bilatzeko balio duena, eta balio lehenetsia htmlspecialchars erabiliz segurtasunez bistaratzen du-->
        <input type="text" name="bilaketa" id="bilaketa" placeholder="Bilatu izenaren arabera" value="<?php echo htmlspecialchars($bilaketa); ?>">
        <label for="mota_filtratu">Mota:</label>
        <!--option value erabiliz listan jartzen du-->
        <select name="mota_filtratu" id="mota_filtratu">
            <option value="">-- Aukeratu mota --</option>
            <option value="Fruituak" <?php if ($mota_filtratu == 'Fruituak') echo 'selected'; ?>>Fruituak</option>
            <option value="Esnekiak" <?php if ($mota_filtratu == 'Esnekiak') echo 'selected'; ?>>Esnekiak</option>
            <option value="Haragia" <?php if ($mota_filtratu == 'Haragia') echo 'selected'; ?>>Haragia</option>
            <option value="Beste" <?php if ($mota_filtratu == 'Beste') echo 'selected'; ?>>Besteak</option>
            <option value="Gozoak" <?php if ($mota_filtratu == 'Gozoak') echo 'selected'; ?>>Gozoak</option>

        </select>
        <!--bilaketa egiteko botoia sortu-->
        <button type="submit" name="bilatu">Bilatu</button>
    </form>
</div>


<!-- Hasierako JavaScript metodoa hasteko da, insert ariketan, formularioa betetzeko agertuko da.-->
<div class="gehitu" >
    <button onclick="showAddForm()"><i class="fa fa-plus" aria-hidden="true"></i></button>
  </div>
  <!--titulua-->
<h3>Produktuen Zerrenda:</h3>
<!--taula-->
<table border="1">
    <tr>
        <!--Taulen tituloak-->
        <th>Izena</th>
        <th>Mota</th>
        <th>Prezioa</th>
        <th>Ekintzak</th>
    </tr>
<?php
//Datu baseari select bat eskatzen dio, eta horreta gure web orrialdean aterako da.
$sql_select = "SELECT id, izena, mota, prezioa FROM produktuak";

//emaitzak hemen begiratzen ditu
$result = $conn->query($sql_select);
//emaitzen lerroak 0 baino handiagoa izaten bada, taula imprimatuko du, aldiz ez bada handiagoa ez du imprimatuko
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
// Taularen errenkadak bucle honetan inprimatzen ditu, datu-baseko azken erregistroa landu arte.
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["izena"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["mota"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["prezioa"]) . " &euro;</td>";
        echo "<td>".
        //zakarrontzia ikonoa jartzen du
                   " <i class='fas fa-trash'></i>
                </form>".
                //arkatzaren ikonoa jartzen du

                " <i class='fas fa-pencil-alt'></i></a>
              </td>";
        echo "</tr>";
    }
}
?>
</table>

<?php
//konexioa ixten du
$conn->close();
?>

</body>
</html>