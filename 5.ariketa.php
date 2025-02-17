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
//datu-baseko konexioa egiten du 
$servername = "localhost";
    $username = "root";
    $password = "1MG2024";
    $dbname = "gp_froga";

    $conn = new mysqli($servername, $username, $password, $dbname);
    //ez bada konektatzen errorea emango du, bestela ez da ezer azalduko
    if ($conn->connect_error) {
        die("Errorea konektatzean: " . $conn->connect_error);
    }
    //array-en definizioa
    $bilaketa = "";
    $mota_filtratu = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['osatu'])) {
            $izena = $conn->real_escape_string($_POST['izena']);
            $mota = $conn->real_escape_string($_POST['mota']);
            $prezioa = $conn->real_escape_string($_POST['prezioa']);

            //izena, mota eta prezioa hutsak baldin badaude, lerro horretan inserta engingo da
            if (!empty($izena) && !empty($mota) && !empty($prezioa)) {
                //inserta egiteko sql-ko kodigoa
                $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";
                //dena ondo joan baldin bada inserta egingo du
                if ($conn->query($sql) === TRUE) {
                    echo "Erregistro berria ondo sortu da.<br>";
                    //bestela errorea emango du
                } else {
                    echo "Errorea: " . $sql . "<br>" . $conn->error;
                }

            }
        }
    }



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
            <!--Testu-kutxa bat sortzen du, erabiltzaileak izen bat bilatzeko balio duena, eta balio lehenetsia htmlspecialchars erabiliz segurtasunez bistaratzen du-->
            <input type="text" name="bilaketa" id="bilaketa" placeholder="Bilatu izenaren arabera"
                value="<?php echo htmlspecialchars($bilaketa); ?>">
            <label for="mota_filtratu">Mota:</label>
            <!--option value erabiltzen du, produktu motak lista moduan ateratzeko-->
            <select name="mota_filtratu" id="mota_filtratu">
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
            <!--bilaketa egiteko botoia-->
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

    <!-- Hasierako JavaScript metodoa hasteko da, insert ariketan, formularioa betetzeko agertuko da.-->
    <!-- gehitu botoiari ematerakoan, formalarioa irekiko da eta betetzeko aukera izango dugu-->
    <div class="gehitu">
        <button onclick="showAddForm()"><i class="fa fa-plus" aria="hidden"></i></button>
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
        //datu baseari selecta eskatzen diogu
        $sql_select = "SELECT id, izena, mota, prezioa FROM produktuak";

        //emaitzak hemen begiratzen ditu
        $result = $conn->query($sql_select);
        //emaitzean lerroak 0 baino handigoak badira taula inprimituko digu, bestela ez digu ezer ez inprimituko
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Taularen errenkadak bucle honetan inprimatzen ditu, datu-baseko azken erregistroa landu arte.
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["izena"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["mota"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["prezioa"]) . " &euro;</td>";
                echo "<td>" .
                    //zakarrontzia ikonoa jartzen du
                    " <i class='fas fa-trash'></i>
                </form>" .
                    //arkatzaren ikonoa jartzen du
        
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