<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";

if (isset($_POST['Expences'])) {
    $Expences = trim($_POST['Expences']);
        
    if ($Expences !== '') {

      $sql_con = new mysqli($servername, $username, $password, $dbname);
              
      if ($sql_con->connect_error) {
        die("Connection failed: " . $sql_con->connect_error);
      }

      $stmt = $sql_con->prepare("INSERT INTO expences_trakcer(Expences) VALUES(?)");
              
      $stmt->bind_param("i", $Expences);
      $stmt->execute();


      $stmt->close();
      $sql_con->close();
    }

}

header("Location: index.php");
exit;

?>