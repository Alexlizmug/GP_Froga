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
        <input type="text" name="bilaketa" id="bilaketa" placeholder="Bilatu izenaren arabera" value="<?php echo htmlspecialchars($bilaketa); ?>">
        <label for="mota_filtratu">Mota:</label>
         <!-- Produktu motaren labela -->
        <select name="mota_filtratu" id="mota_filtratu">
            <option value="">-- Aukeratu mota --</option><!-- Aukerak azaldu -->
            <option value="Fruituak" <?php if ($mota_filtratu == 'Fruituak') echo 'selected'; ?>>Fruituak</option>
            <option value="Esnekiak" <?php if ($mota_filtratu == 'Esnekiak') echo 'selected'; ?>>Esnekiak</option>
            <option value="Haragia" <?php if ($mota_filtratu == 'Haragia') echo 'selected'; ?>>Haragia</option>
            <option value="Beste" <?php if ($mota_filtratu == 'Beste') echo 'selected'; ?>>Besteak</option>
            <option value="Gozoak" <?php if ($mota_filtratu == 'Gozoak') echo 'selected'; ?>>Gozoak</option>

        </select>
        <!-- Bilaketa botoia -->
        <button type="submit" name="bilatu">Bilatu</button>
    </form>
</div>


  <!-- Gehitzeko botoia  -->
<div class="gehitu" >
    <button onclick="showAddForm()"><i class="fa fa-plus" aria-hidden="true"></i></button>
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