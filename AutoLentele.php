<!DOCTYPE html>
<html>
    <head>
        <title>PHP - MySQL - Select</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    thead {
        font-size: 20px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<body>

<h2>
 Nuostabi automobiliu Lentele
</h2>

<button onclick="naujas()" type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Įveskite naują automobilį</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Suveskite duomenis</h4>
            </div>
            <div class="modal-body">
            <form action="addnew.php" method="post">
    <h3>Data</h3>
    <input name="date" placeholder="Auto data" >
    <h3>Numeris</h3>
    <input name="number" placeholder="Auto numeris" >
    <h3>Atstumas</h3>
    <input name="distance" placeholder="Auto atstumas" >
    <h3>Laikas</h3>
    <input name="time" placeholder="Auto laikas" >
    <br>
    <br>
    <button> Saugoti <button>
    </form>
    <br> 
            </div>
            <div class="modal-footer">
               
                
            </div>

        </div>

    </div>
</div>

<br><br>

<?php 

// Prisijungimo duomenys
$servername = 'localhost';
$dbname = 'Auto';
$username = 'Auto';
$password = 'LabaiSlaptas123';

// Prisijungiame prie duomenų bazės 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
}

// Suformuojame SELECT užklausą
$sql = 'SELECT id, number, distance/time*3.6 as speed, date FROM radars ORDER BY number, date DESC';

// Vykdome suformuotą užklausą duomenų bazėje
$result = $conn->query($sql);

// Tikriname ar rezultate yra bent viena eilutė
if ($result->num_rows > 0) { 
    ?>
        <table border=1>
            <tr>
                <th>id</th>
                <th>Numeris</th>
                <th>Data</th>
                <th>Greitis</th>
                <th>Taisyti</th>
                <th>Trinti</th>
            </tr>
        
            <!-- einame cikle per visas rezultato eilutes ir jas išvedame --> 
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo round($row['speed']); ?></td> 
                    <td> <a href="update.php?id=<?php echo $row['id']; ?>">Taisyti</a></td>
                    <td> <a href="trinti.php?id=<?php echo $row['id']; ?>">Trinti</a></td>
                </tr>
            <?php } ?>

        </table>
    <?php
} else {
    echo 'nėra duomenų';
}
// uždarome prisijungimą prie DB
$conn->close();

?>
</body>
</html>

