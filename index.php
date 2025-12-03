<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tracker";

      $sql_con = new mysqli($servername, $username, $password, $dbname);
      if ($sql_con->connect_error) {
    die("Connection failed: " . $sql_con->connect_error);
}

$sql_inc = "SELECT * FROM income_tracker";
$result_inc = $sql_con->query($sql_inc);

$sql_sumInc = "SELECT SUM(Income) AS total_income FROM income_tracker";
$sumIncResult = $sql_con->query($sql_sumInc);
$total_income = ($sumIncResult && $row = $sumIncResult->fetch_assoc()) ? $row['total_income'] : 0;



$sql_exp = "SELECT * FROM expences_trakcer";
$result_exp = $sql_con->query($sql_exp);

$sql_sumExp = "SELECT SUM(Expences) AS total_expenses FROM expences_trakcer";
$sumExpResult = $sql_con->query($sql_sumExp);
$total_expenses = ($sumExpResult && $row = $sumExpResult->fetch_assoc()) ? $row['total_expenses'] : 0;

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Money Track</title>
<link rel="shortcut icon" href="297-2977261_wallet-budget-tracker-budgetbakers-icon-app.png" type="image/png">
<link rel="icon" href="297-2977261_wallet-budget-tracker-budgetbakers-icon-app.png" type="image/png">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-grey">




  <div id="incomes" class="bgblur hidden  fixed grid justify-center items-center border-1 border-black h-screen w-screen bg-white/25 backdrop-blur-sm md:text-lg lg:text-xs">
    <div class="cont flex justify-center bg-white h-40 w-80">
      <form class="" action="Income.php" method="post">
        <label for="Incomes">Add Income</label><br>
        <input type="text" name = "Incomes" required><br>
        <input type="submit" name = "submit-btn" value="submit">  
      </form>
    </div>
  </div>
  <div id="expences" class="bgblur hidden fixed grid justify-center items-center border-1 border-black h-screen w-screen bg-white/25 backdrop-blur-sm md:text-lg lg:text-xs">
    <div class="cont flex justify-center bg-white h-40 w-80">
      <form class="" action="Expences.php" method="post">
        <label for="Expences">Add expence</label><br>
        <input type="text" name = "Expences" required><br>
        <input type="submit" name = "submit-btn" value="submit">  
      </form>
    </div>
  </div>
<div  class="h-screen w-full flex gap-12 justify-center items-center">
  <button id="expences-btn" class="bg-gred rounded-md p-1">
    Add An expence 🥲
  </button>
  <button id="incomes-btn"  class="bg-uncommon rounded-md p-1">
    Add An Income 🥲
  </button>
</div>






<table class="min-w-full border-collapse border border-gray-400 mb-10">
  <thead class='bg-gray-200'>
    <tr>
      <th class='border p-2'>Income</th>
      <th class='border p-2'>Date</th>
      <th class='border p-2'>Description</th>
    </tr>
  </thead>

  <tbody>
    <?php
      if ($sumExpResult && $sumExpResult->num_rows > 0) {
        // reset pointer (important if you echo before)
        $sumExpResult->data_seek(0);

        while($total_income = $sumExpResult->fetch_assoc()){
          echo "
            <tr>
              <td class='border p-2'>{$row['Income']}</td>
              <td class='border p-2'>{$row['Date']}</td>
              <td class='border p-2'>{$row['descr']}</td>
            </tr>
          ";
        }
      } else {
        echo "<tr><td colspan='3' class='p-2'>No data</td></tr>";
      }
    ?>
  </tbody>

  <tfoot class='bg-gray-100'>
    <tr>
      <td class='border p-2 font-bold'>Total:</td>
      <td class='border p-2' colspan='2'>
        <?php echo $total_income['total_income'] ?? ''; ?>
      </td>
    </tr>
  </tfoot>
</table>



<table class="min-w-full border-collapse border border-gray-400">
  <thead class='bg-gray-200'>
    <tr>
      <th class='border p-2'>Expense</th>
      <th class='border p-2'>Date</th>
      <th class='border p-2'>Description</th>
    </tr>
  </thead>

  <tbody>
    <?php
      if ($result_exp && $result_exp->num_rows > 0) {

        while($row_exp = $result_exp->fetch_assoc()){
          echo "
            <tr>
              <td class='border p-2'>{$row_exp['Expences']}</td>
              <td class='border p-2'>{$row_exp['Date']}</td>
              <td class='border p-2'>{$row_exp['descr']}</td>
            </tr>
          ";
        }

      } else {
        echo "<tr><td colspan='3' class='p-2'>No data</td></tr>";
      }
    ?>
  </tbody>

  <tfoot class='bg-gray-100'>
    <tr>
      <td class='border p-2 font-bold'>Total:</td>
      <td class='border p-2' colspan='2'>
        <?php echo $row_exp['total_expenses'] ?? ''; ?>
      </td>
    </tr>
  </tfoot>
</table>

  







<script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'press-start': ['"Press Start 2P"', 'cursive'],
            'K2D': ['"K2D"', 'cursive'],
          },
          colors: {
            red: '#A63348',
            magenta: '#5F425F',
            blue: '#3B4A6B',
            cyan: '#1B7C97',
            myblue: '#3B4A6B',
            gred: '#FF0000',
            legendary: '#FFD400',
            rare: '#0C0091',
            uncommon: '#00FF11',
            common: '#FFFFFF',
            tblue: '#1F2937',
            grey: '#6B7280',
            gblue: '#374151',
            stroke: '#4B5563',
            underbg: '#E5E7EB',
            grayish: '#374151',
            brownish: '#EEB76B',
            orangish: '#E2703A',
            redmagenta: '#9C3D54',
            dark_brown: '#310B0B',
          }
        }
      }
    }
  </script>

  <script type="text/javascript" src="script.js"></script>
</body>
</html>