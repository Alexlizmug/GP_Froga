<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <!--Web-ak edukiko duen titulua-->
    <title>Formulario - Produktuak</title>
    <!--Ezarritako ikonoak funtzionatzeko ezarri behar den link-a-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!--Beste orrialdeko css-ari deia orrialde honetan funtzionatzeko-->
    <link rel="stylesheet" href="style.css">
    <script>
        //JavaScript-eko funtzio bati egiten dio deia, gero INSERT-a egin ahal izateko, eta formularioa erakusteko
        function showAddForm() {
            //id-a addForm moduan jarri du
            document.getElementById('addForm').style.display = 'block';
        }
    </script>
</head>
<body>

<?php
//datu-baseko konexioa
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "produktuakdb";

$conn = new mysqli($servername, $username, $password, $dbname);
//ez bada konektatzen errorea emango du, bestela ez da ezer azalduko
if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error);
}
//array-en definizioa
$bilaketa = "";
$mota_filtratu = "";
if (isset($_POST['bilatu'])) {
    //SQL kontsulta egin baino lehen karaktere espezialak saltatzeko balio du
    $bilaketa = $conn->real_escape_string($_POST['bilaketa']);
    $mota_filtratu = $conn->real_escape_string($_POST['mota_filtratu']);
}

?>
<!--Formulario bat erabiltzen du produktu motak definitzeko-->
<div id="search">
    <form method="POST">
        <label for="bilaketa">Bilatu:</label>
        <!--htmlspecialchars PHPko funtzio bat da, zenbait karaktere berezi HTML entitateetan haien irudikapenak bihurtzen dituena-->
        <!--hemen bilatzen dena, bilaketa array-ean gordeko da, bilaketa egin ahal izateko-->
        <input type="text" name="bilaketa" id="bilaketa" placeholder="Bilatu izenaren arabera" value="<?php echo htmlspecialchars($bilaketa); ?>">
        <label for="mota_filtratu">Mota:</label>
        <!--option value erabiltzen du, produktu motak lista moduan ateratzeko-->
        <select name="mota_filtratu" id="mota_filtratu">
            <option value="">-- Aukeratu mota --</option>
            <!--mota_filtratu arraya sortzen da, gero mota filtratu ahal izateko-->
            <option value="Fruituak" <?php if ($mota_filtratu == 'Fruituak') echo 'selected'; ?>>Fruituak</option>
            <option value="Esnekiak" <?php if ($mota_filtratu == 'Esnekiak') echo 'selected'; ?>>Esnekiak</option>
            <option value="Haragia" <?php if ($mota_filtratu == 'Haragia') echo 'selected'; ?>>Haragia</option>
            <option value="Beste" <?php if ($mota_filtratu == 'Beste') echo 'selected'; ?>>Besteak</option>
            <option value="Gozoak" <?php if ($mota_filtratu == 'Gozoak') echo 'selected'; ?>>Gozoak</option>

        </select>
        <!--bilaketa egiteko botoia-->
        <button type="submit" name="bilatu">Bilatu</button>
    </form>
</div>


<!-- hasierako JavaScripteko metodoa funtzionatzeko valio du, hau da, insert-eko ariketan formularioa betetzeko agertuko da-->
<div class="gehitu" >
    <button onclick="showAddForm()"><i class="fa fa-plus" aria-hidden="true"></i></button>
  </div>
  <!--titulua-->
<h3>Produktuen Zerrenda:</h3>
<!--taula-->
<table border="1">
    <tr>
        <!--taularen tituluak-->
        <th>Izena</th>
        <th>Mota</th>
        <th>Prezioa</th>
        <th>Ekintzak</th>
    </tr>
<?php
//datu baseari selecta eskatzen diogu, eta selecta array baten barruan gordetzen du
$sql_select = "SELECT id, izena, mota, prezioa FROM produktuak";

//datu baseari eskaera
$result = $conn->query($sql_select);
//emaitzean lerroak 0 baino handigoak badira taula inprimituko digu, bestela ez digu ezer ez inprimituko
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //taularen lerroak while (bukle) honen barruan inprimatzen da, datu baseko azkeneko erregistroa egin harte
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["izena"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["mota"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["prezioa"]) . " &euro;</td>";
        echo "<td>".
        //basura ikonoa
                   " <i class='fas fa-trash'></i>
                </form>".
                //arkatz ikonoa

                " <i class='fas fa-pencil-alt'></i></a>
              </td>";
        echo "</tr>";
    }
}
?>
</table>

<?php
//konexioa ixten da
$conn->close();
?>

</body>
</html>