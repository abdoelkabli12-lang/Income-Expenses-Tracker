<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";



if (isset($_POST['Expences']) && isset($_POST['descreption_exp']))  {
    $Expences = trim($_POST['Expences']);
    $Desc_exp = trim($_POST['descreption_exp']);
    $Date_exp = $_POST['Date_exp1'];
        
    if ($Expences !== '') {

      $sql_con = new mysqli($servername, $username, $password, $dbname);
              
      if ($sql_con->connect_error) {
        die("Connection failed: " . $sql_con->connect_error);
      }



      if($Date_exp != '') {
      $stmt = $sql_con->prepare("INSERT INTO expences_trakcer(Expences, descr, Date) VALUES(?, ?, ?)");
      $stmt->bind_param("iss", $Expences, $Desc_exp, $Date_exp);
      } else { 
        $stmt = $sql_con->prepare("INSERT INTO expences_trakcer(expences, descr, Date) VALUES(?, ?, CURRENT_DATE())");
              $stmt->bind_param("is", $Expences, $Desc_exp);
      }
      $stmt->execute();


      $stmt->close();
      $sql_con->close();
    }

}

header("Location: index.php");
exit;

?>