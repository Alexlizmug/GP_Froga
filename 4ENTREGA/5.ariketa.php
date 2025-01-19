<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    
    <title>Formulario - Produktuak</title>
    <!--estekak funtzionatzeko-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <script>
        // formularioa erakusteko scripta
        function showAddForm() {
            // "addForm" IDa duen elementua bistaratzen du
            document.getElementById('addForm').style.display = 'block';
        }
    </script>
</head>

<body>

    <?php
   // Datu-basearekin konexioa
    $servername = "localhost";
    $username = "root";
    $password = "1MG2024";
    $dbname = "entrega4";
// MySQL konexioa 
    $conn = new mysqli($servername, $username, $password, $dbname);
    // konexioak egiten duen probatu
    if ($conn->connect_error) {
        die("Errorea konektatzean: " . $conn->connect_error);
    }
    // aldagaiak hutsik jarri
    $bilaketa = "";
    $mota_filtratu = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // formularioa osatuta badago egin
        if (isset($_POST['osatu'])) {
            $izena = $conn->real_escape_string($_POST['izena']);
            $mota = $conn->real_escape_string($_POST['mota']);
            $prezioa = $conn->real_escape_string($_POST['prezioa']);

            //izena, mota eta prezioa hutsak baldin badira, inserta egingo du
            if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
                //inserta egiteko 
                $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";
                //errorea dagoen konprobatu
                if ($conn->query($sql) === TRUE) {
                    echo "Erregistro berria ondo sortu da.<br>";
                    //bestela errorea emango du
                } else {
                    echo "Errorea: " . $sql . "<br>" . $conn->error;
                }

            }
        }
    }


// formularioa osatuta badago egin
    if (isset($_POST['bilatu'])) {
  
        $bilaketa = $conn->real_escape_string($_POST['bilaketa']);
        $mota_filtratu = $conn->real_escape_string($_POST['mota_filtratu']);
    }

    ?>
   <!-- Produktuak bilatzeko formularioa -->
    <div id="search">
        <form method="POST">
            <label for="bilaketa">Bilatu:</label>
              <!-- Bilaketaren inputa -->
            <input type="text" name="bilaketa" id="bilaketa" placeholder="Bilatu izenaren arabera"
                value="<?php echo htmlspecialchars($bilaketa); ?>">
            <label for="mota_filtratu">Mota:</label>
            <!-- Produktu motaren labela -->
            <select name="mota_filtratu" id="mota_filtratu"> <!-- Aukerak azaldu -->
                <option value="">-- Aukeratu mota --</option>
                <option value="Fruituak" <?php if ($mota_filtratu == 'Fruituak')
                    echo 'selected'; ?>>Fruituak</option>
                <option value="Esnekiak" <?php if ($mota_filtratu == 'Esnekiak')
                    echo 'selected'; ?>>Esnekiak</option>
                <option value="Haragia" <?php if ($mota_filtratu == 'Haragia')
                    echo 'selected'; ?>>Haragia</option>
                <option value="Beste" <?php if ($mota_filtratu == 'Beste')
                    echo 'selected'; ?>>Besteak</option>
                <option value="Gozoak" <?php if ($mota_filtratu == 'Gozoak')
                    echo 'selected'; ?>>Gozoak</option>

            </select>
            <!-- Bilaketa botoia -->
            <button type="submit" name="bilatu">Bilatu</button>
        </form>
    </div>
    <!--Inserta egiteko formularioa-->
    <form method="POST" id="addForm" style="display:none;">
    <label for="izena">Izena:</label><br>
    <input type="text" name="izena" id="izena" placeholder="Sartu izena"><br><br>

    <label for="mota">Mota:</label><br>
    <input type="text" name="mota" id="mota" placeholder="Sartu mota"><br><br>

    <label for="prezioa">Prezioa:</label><br>
    <input type="text" name="prezioa" id="prezioa" placeholder="Sartu prezioa"><br><br>

    <button type="submit" name="osatu">Osatu</button>
    

</form>

    <!-- Gehitzeko botoia  -->
    <div class="gehitu">
        <button onclick="showAddForm()"><i class="fa fa-plus" aria="hidden" ></i></button>
    </div>
    
    <h3>Produktuen Zerrenda:</h3>
   <!-- Produktuak taula -->
    <table border="1">
        <tr>
           
            <th>Izena</th>
            <th>Mota</th>
            <th>Prezioa</th>
            <th>Ekintzak</th>
        </tr>
        <?php
        // select kontsulta
        $sql_select = "SELECT ProduktuId, izena, mota, prezioa FROM produktuak";

      //emaitzak gorde
        $result = $conn->query($sql_select);
        //emaitzak gordetzen badira sartu
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //errenkadak imprimatu
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["izena"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["mota"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["prezioa"]) . " &euro;</td>";
        echo "<td>".
        //ezabatzeko ikonoa
                   " <i class='fas fa-trash'></i>
                </form>".
                //editatzeko ikonoa

                " <i class='fas fa-pencil-alt'></i></a>
              </td>";
        echo "</tr>";
    }
}
?>
</table>

<?php
//konexioa itxi
$conn->close();
?>

</body>
</html>