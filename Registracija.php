<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
 <style>
.error {color: #FF0000;}
</style>
<body>  

<?php

$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Reikalingas vardas";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Rašyti tik raides ir tarpus";
    }
  }
  
  if (empty($_POST["psw"])) {
    $pswErr = "Reikalingas slaptažodis";
  } else {
    $psw = test_input($_POST["psw"]);
     }
    
 }

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>

<h2>Slaptažodžio pateikimo forma: </h2>
<p><span class="error">* būtina užpildyti</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
 Vardas: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
 Slaptažodis: <input type="text" name="psw" value="<?php echo $psw;?>">
  <span class="error">* <?php echo $pswErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Saugoti"> 
</form>

<?php
echo "<h2>Tavo išrašas:</h2>";
?>
Vardas yra <?php echo $name; ?><br>
Slaptažodis:  <?php echo $psw; ?>
<footer>
<br>
<br>
Kaunas,Ⓒ <?php echo date("Y");?>

</footer>
</body>
</html>

</body>
</html>