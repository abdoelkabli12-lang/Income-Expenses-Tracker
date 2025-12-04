<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";

$Date = $_POST['date'];
if (isset($_POST['Incomes']) && isset($_POST['descreption'])){
    $Incomes = trim($_POST['Incomes']);
    $Desc = trim($_POST['descreption']);
        
    if ($Incomes !== '') {

      $sql_con = new mysqli($servername, $username, $password, $dbname);
              
      if ($sql_con->connect_error) {
        die("Connection failed: " . $sql_con->connect_error);
      }


            
      if($Date != '') {
        $stmt = $sql_con->prepare("INSERT INTO income_tracker(Income, descr, Date) VALUES(?, ?, ?)");
        $stmt->bind_param("iss", $Incomes, $Desc, $Date);
      } else {
            $stmt = $sql_con->prepare("INSERT INTO income_tracker (Income, descr, Date) VALUES (?, ?, CURRENT_DATE())");
            $stmt->bind_param("is", $Incomes, $Desc);

      }
      $EDate = $_POST['edit-date'];
      $id = $_POST['id'];
      if (isset($_POST['edit-Incomes'])){
        $EIncomes = trim($_POST['edit-Incomes']);
        $EDesc = trim($_POST['edit-descreption']);


        if($EIncomes !== '') {
          $stmt = $sql_con->prepare("UPDATE income_tracker Income WHERE id = $id");
        $stmt->bind_param("d", $Incomes);
        }
      }
      $stmt->execute();


      $stmt->close();
      $sql_con->close();
    }

}



header("Location: index.php");
exit;

?>