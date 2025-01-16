<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>Formulario - Produktuak</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script>
        function showAddForm() {
            document.getElementById('addForm').style.display = 'block';
        }
    </script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "produktuakdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error);
}

$bilaketa = "";
$mota_filtratu = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['osatu'])) {
        $izena = $conn->real_escape_string($_POST['izena']);
        $mota = $conn->real_escape_string($_POST['mota']);
        $prezioa = $conn->real_escape_string($_POST['prezioa']);

        if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
            $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";
            if ($conn->query($sql) === TRUE) {
                echo "Erregistro berria ondo sortu da.<br>";
            } else {
                echo "Errorea: " . $sql . "<br>" . $conn->error;
            }
        } else {
        }
    }

  
       
    }

    if (isset($_POST['bilatu'])) {
        $bilaketa = $conn->real_escape_string($_POST['bilaketa']);
        $mota_filtratu = $conn->real_escape_string($_POST['mota_filtratu']);
    }

?>



<div id="search">
    <form method="POST">
        <label for="bilaketa">Bilatu:</label>
        <input type="text" name="bilaketa" id="bilaketa" placeholder="Bilatu izenaren arabera" value="<?php echo htmlspecialchars($bilaketa); ?>">
        <label for="mota_filtratu">Mota:</label>
        <select name="mota_filtratu" id="mota_filtratu">
            <option value="">-- Aukeratu mota --</option>
            <option value="Fruituak" <?php if ($mota_filtratu == 'Fruituak') echo 'selected'; ?>>Fruituak</option>
            <option value="Esnekiak" <?php if ($mota_filtratu == 'Esnekiak') echo 'selected'; ?>>Esnekiak</option>
            <option value="Haragia" <?php if ($mota_filtratu == 'Haragia') echo 'selected'; ?>>Haragia</option>
            <option value="Beste" <?php if ($mota_filtratu == 'Beste') echo 'selected'; ?>>Besteak</option>
            <option value="Gozoak" <?php if ($mota_filtratu == 'Gozoak') echo 'selected'; ?>>Gozoak</option>

        </select>
        <button type="submit" name="bilatu">Bilatu</button>
    </form>
</div>

<form method="POST" id="addForm" style="display:none;">
    <label for="izena">Izena:</label><br>
    <input type="text" name="izena" id="izena" placeholder="Sartu izena"><br><br>

    <label for="mota">Mota:</label><br>
    <input type="text" name="mota" id="mota" placeholder="Sartu mota"><br><br>

    <label for="prezioa">Prezioa:</label><br>
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa"><br><br>

    <button type="submit" name="osatu">Osatu</button>
    

</form>
<div class="gehitu" >
    <button onclick="showAddForm()"><i class="gehitu"></i> Gehitu</button>
  </div>
<h3>Produktuen Zerrenda:</h3>
<table border="1">
    <tr>
        <th>Izena</th>
        <th>Mota</th>
        <th>Prezioa</th>
        <th>Ekintzak</th>
    </tr>
<?php
$sql_select = "SELECT id, izena, mota, prezioa FROM produktuak WHERE 1=1";

if (!empty($bilaketa)) {
    $sql_select .= " AND izena LIKE '%$bilaketa%'";
}

if (!empty($mota_filtratu)) {
    $sql_select .= " AND mota = '$mota_filtratu'";
}

$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["izena"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["mota"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["prezioa"]) . " &euro;</td>";
        echo "<td>
                <form method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' name='ezabatu'><i class='fas fa-trash'></i></button>
                </form>
                <a href='edit.php?id=" . $row['id'] . "'><i class='fas fa-pencil-alt'></i></a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'> Ez dago daturik.</td></tr>";
}
?>
</table>

<?php
$conn->close();
?>

</body>
</html>





 