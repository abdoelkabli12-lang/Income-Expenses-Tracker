<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";

if (isset($_POST['Incomes'])) {
    $Incomes = trim($_POST['Incomes']);
        
    if ($Incomes !== '') {

      $sql_con = new mysqli($servername, $username, $password, $dbname);
              
      if ($sql_con->connect_error) {
        die("Connection failed: " . $sql_con->connect_error);
      }

      $stmt = $sql_con->prepare("INSERT INTO income_tracker(Income) VALUES(?)");
              
      $stmt->bind_param("i", $Incomes);
      $stmt->execute();


      $stmt->close();
      $sql_con->close();
    }

}

header("Location: index.php");
exit;

?>