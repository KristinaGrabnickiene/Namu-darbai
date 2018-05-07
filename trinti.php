<?php 

// Prisijungimo duomenys
$servername = 'localhost';
$dbname = 'Auto';
$username = 'Auto';
$password = 'LabaiSlaptas123';

if (!isset($_GET['id']))
{
    echo 'Nebuvo priskirtas ID...';
    exit;
}

$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error)
{
    die('Prisijungimo klaida (' . $con->connect_errno . ') ' . $con->connect_error);
}

$sql = "DELETE FROM radars WHERE id = ?";
if (!$result = $con->prepare($sql))
{
    die('Query failed: (' . $con->errno . ') ' . $con->error);
}

if (!$result->bind_param('i', $_GET['id']))
{
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
}

if (!$result->execute())
{
    die('Execute failed: (' . $result->errno . ') ' . $result->error);
}

if ($result->affected_rows > 0)
{
    echo "Sveikinu, eilute sėkmingai ištrinta iš DB";
}
else
{
    echo "Nepavyko ištrinti duomenu iš DB";
}
$result->close();
$con->close();
?>


<input type="button" value="Grįžti atgal mygtukas" onclick="history.back(-1)" />