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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Lexend:wght@100..900&family=Press+Start+2P&family=Volkhov:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>
<body class="bg-grey">


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
            myblue: '#3B4A6B',
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



<header>
  <div class=" flex bg-gradient-to-r from-green-600 via-green-300 to-blue-600 h-14 w-full flex items-center">
    <h1 class="ml-4 font-semibold font-[Inter] text-2xl text-white">
      Smart Wallet <img src="2dde7ddf-9a38-400b-94d2-c90c14b33677.jpg" class="rounded-full object-fit w-12">
    </h1>
  </div>
</header>


    <div  id="incomes" class="hidden w-full bg-grey">
        <div class="bgblur fixed backdrop-blur-sm bg-white/15 flex h-screen w-[100%] justify-center items-center ">
            <div  class="cont w-96 mx-auto bg-white rounded shadow">

                <div class="mx-16 py-4 px-8 text-black text-xl font-bold border-b border-grey-500 flex justify-center">Add Income
                </div>

                <form id="inc-form" action="Income.php" method="post">
                    <div class="py-4 px-8">

                        <div class="mb-4">
                            <label for="Incomes" class="block text-grey-darker text-sm font-bold mb-2">Add Income:</label>
                            <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                                name="Incomes" id="student_id" value="" placeholder="Enter Your Income amount">
                        </div>


                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2">Description: </label>
                            <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                                name="descreption" id="descreption" value="" placeholder="Enter a descreption">
                      
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2">Date: </label>
                            <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="date"
                                name="date" id="date" value="" placeholder="Enter Your date">
                            <p id=error_creater_id></p>
                        </div>



                        <div class="mb-4">
                            <button
                                class="mb-2 mx-16 rounded-full py-3 px-24 bg-gradient-to-r from-uncommon to-rare ">
                                Save
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
        <div id="expences" class=" hidden w-full bg-grey-500">
        <div  class="bgblur fixed backdrop-blur-sm bg-white/15 flex h-screen w-[100%] justify-center items-center">
            <div id="" class="cont w-96 mx-auto bg-white rounded shadow">

                <div class="mx-16 py-4 px-8 text-black text-xl font-bold border-b border-grey-500 flex justify-center">Add Expence
                </div>

                <form id="exp-form" action="Expences.php" method="post">
                    <div class="py-4 px-8">

                        <div class="mb-4">
                            <label for="Incomes" class="block text-grey-darker text-sm font-bold mb-2">Add Expence:</label>
                            <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                                name="Expences" id="student_id" value="" placeholder="Enter Your Expence amount">
                              </div>


                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2">Description: </label>
                            <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                                name="descreption_exp" id="descreption" value="" placeholder="Enter a descreption">
                      
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-sm font-bold mb-2">Date: </label>
                            <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="date" name="Date_exp1" id="date_exp" value="" placeholder="Enter Your date">
                            <p id=error_creater_id></p>
                        </div>



                        <div class="mb-4">
                            <button
                                class="mb-2 mx-16 rounded-full py-1 px-24 bg-gradient-to-r from-green-400 to-blue-500 ">
                                Save
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
                    </div>
                </form>

            </div>

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
      if ($result_inc && $result_inc->num_rows > 0) {
        // reset pointer (important if you echo before)
        $result_inc->data_seek(0);

        while($row_inc = $result_inc->fetch_assoc()){
          echo "
            <tr>
              <td class=' text-uncommon font-semibold'>$ {$row_inc['Income']}</td>
              <td class=''>{$row_inc['Date']}</td>
              <td class=''>{$row_inc['descr']}</td>
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
        <?php echo "<h1 class = 'font-bold text-md'>$ " . $total_income . "</h1>" ?? ''; ?>
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
              <td class='border p-2 text-gred font-semibold'>$ {$row_exp['Expences']}</td>
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
        <?php echo "<h1 class = 'font-bold text-md'>$ " . $total_expenses . "</h1>" ?? ''; ?>
      </td>
    </tr>
  </tfoot>
</table>

  








  <script type="text/javascript" src="script.js"></script>
</body>
</html>