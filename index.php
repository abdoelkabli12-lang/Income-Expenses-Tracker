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

$sql_inc = "SELECT * FROM income_tracker WHERE MONTH(Date) = MONTH(CURRENT_DATE) AND YEAR(Date) = YEAR(CURRENT_DATE) AND Date = CURRENT_DATE";
$result_inc = $sql_con->query($sql_inc);

$sql_sumInc = "SELECT SUM(Income) AS total_income FROM income_tracker";
$sumIncResult = $sql_con->query($sql_sumInc);
$total_income = ($sumIncResult && $row = $sumIncResult->fetch_assoc()) ? $row['total_income'] : 0;



$sql_exp = "SELECT * FROM expences_trakcer WHERE MONTH(Date) = MONTH(CURRENT_DATE) AND YEAR(Date) = YEAR(CURRENT_DATE) AND Date = CURRENT_DATE";
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
  <link rel="stylesheet" href="/dist/styles/webawesome.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body class="m-0 font-sans antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 ">


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
            myred: '#A63348',
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
            mygrey: '#6B7280',
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
    <div class=" flex gap-4 bg-gradient-to-r from-green-600 via-green-300 to-blue-600 h-14 w-full flex items-center">
      <h1 class="ml-4 font-semibold font-[Inter] text-2xl text-white">
        Smart Wallet
      </h1>
      <img src="2dde7ddf-9a38-400b-94d2-c90c14b33677.jpg" class="rounded-full object-fit w-12">
    </div>
  </header>


<div id="cont_inc">

</div>
<div id="cont_exp">

</div>

  <div id="incomes" class="hidden w-full bg-grey z-[100]">
    <div class="bgblur fixed backdrop-blur-sm bg-white/15 flex h-screen w-[100%] justify-center items-center z-[999]">
      <div class="cont w-96 mx-auto bg-white rounded shadow">

        <div class="mx-16 py-4 px-8 text-black text-xl font-bold border-b border-grey-500 flex justify-center">Add Income
        </div>

        <form id="inc-form" action="Income.php" method="post">
          <div class="py-4 px-8">

            <div class="mb-4">
              <label for="Incomes" class="block text-grey-darker text-sm font-bold mb-2">Add Income:</label>
              <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                name="Incomes" id="Incomes" value="" placeholder="Enter Your Income amount">
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


  <div id="expences" class=" hidden w-full bg-grey-500 z-[100]">
    <div class="bgblur fixed backdrop-blur-sm bg-white/15 flex h-screen w-[100%] justify-center items-center z-[999]">
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
  <div class="h-screen w-full flex gap-12 justify-center items-center">
    <button id="expences-btn" class="bg-gred rounded-md p-1">
      Add An expence 🥲
    </button>
    <button id="incomes-btn" class="bg-uncommon rounded-md p-1">
      Add An Income 🥲
    </button>
  </div>

  <div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3 z-[10]">
      <!-- card1 -->
      <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-black dark:opacity-60">Today's Money</p>
                  <h5 class="mb-2 font-bold dark:text-black"><?php echo "<h1 class = 'font-bold text-md text-gred'>$ " . $total_expenses . "</h1>" ?? ''; ?></h5>
                  <p class="mb-0 dark:text-white dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-gred">-5%</span>
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                  <i class="leading-none text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- card2 -->
      <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-black dark:opacity-60">Today's Users</p>
                  <h5 class="mb-2 font-bold dark:text-black"><?php echo "<h1 class = 'font-bold text-md text-uncommon'>$ " . $total_income . "</h1>" ?? ''; ?></h5>
                  <p class="mb-0 dark:text-white dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-emerald-500">+3%</span>
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-uncommon to-legendary">
                  <i class="fa-solid fa-arrow-trend-up"></i>
                  <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="flex-auto p-4">
            <div class="flex flex-row -mx-3">
              <div class="flex-none w-2/3 max-w-full px-3">
                <div>
                  <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-black dark:opacity-60">Net profit</p>
                  <h5 class="mb-2 font-bold dark:text-black"><?php echo "<h1 class = 'font-bold text-md text-gred'>$ " . $total_income - $total_expenses . "</h1>" ?? ''; ?></h5>
                  <p class="mb-0 dark:text-gray dark:opacity-60">
                    <span class="text-sm font-bold leading-normal text-gred ">-5%</span>
                    Than last month's
                  </p>
                </div>
              </div>
              <div class="px-3 text-right basis-1/3">
                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                  <i class="leading-none text-lg relative top-3.5 text-white"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="flex gap-12 w-full justify-around">
      <div class="overflow-x-auto overflow-y-scroll [scrollbar-width:none] bg-gray-700 rounded-xl w-[30rem] mt-2">
        <table class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
          <!-- <thead class='bg-gray-500'>
    <tr>
      <th class='border p-2 text-white'>Income</th>
      <th class='border p-2 text-white'>Date</th>
      <th class='border p-2 text-white'>Description</th>
    </tr>
  </thead> -->

          <tbody>
            <?php
            if ($result_inc && $result_inc->num_rows > 0) {
              // reset pointer (important if you echo before)
              $result_inc->data_seek(0);

              while ($row_inc = $result_inc->fetch_assoc()) {
                echo "
<tr class = 'element' data-id = $row_inc[id]>
  <td class='p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40'>
    <div class='flex items-center px-2 py-1'>
      <div class='ml-6'>
        <p class='mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60'>Income:</p>
        <h6 class='mb-0 text-sm leading-normal dark:text-uncommon font-semibold'>$ $row_inc[Income]</h6>
      </div>
    </div>
  </td>
  <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <div class='text-center'>
      <p class='mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60'>Date:</p>
      <h6 class='mb-0 text-sm leading-normal dark:text-white'>$row_inc[Date]</h6>
    </div>
  </td>
  <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <div class='text-center'>
      <p class='mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60'>Descreption</p>
      <h6 class='mb-0 text-sm leading-normal dark:text-white'>$row_inc[descr]</h6>
    </div>
  </td>
    <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <button class = 'edit_btn_inc text-cyan'>Edit</button>
    </td>
    <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <button class = 'delet_btn_inc text-gred'>Delete</button>
    </td>
</tr>
          ";
              }
            } else {
              echo "<tr><td colspan='3' class='p-2'>No data</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>


          <div class="overflow-x-auto overflow-y-scroll [scrollbar-width:none] bg-gray-700 rounded-xl w-[30rem] mt-2">
        <table class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">        <tbody>
          <?php
          if ($result_exp && $result_exp->num_rows > 0) {

            while ($row_exp = $result_exp->fetch_assoc()) {
              echo "
<tr class = 'Eelement' data-id = $row_exp[id]>
  <td class='p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40'>
    <div class='flex items-center px-2 py-1'>
      <div class='ml-6'>
        <p class='mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60'>Income:</p>
        <h6 class='mb-0 text-sm leading-normal dark:text-gred font-semibold'>$ $row_exp[Expences]</h6>
      </div>
    </div>
  </td>
  <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <div class='text-center'>
      <p class='mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60'>Date:</p>
      <h6 class='mb-0 text-sm leading-normal dark:text-white'>$row_exp[Date]</h6>
    </div>
  </td>
  <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <div class='text-center'>
      <p class='mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60'>Descreption</p>
      <h6 class='mb-0 text-sm leading-normal dark:text-white'>$row_exp[descr]</h6>
    </div>
  </td>
    </td>
    <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <button class = 'edit_btn_exp text-cyan'>Edit</button>
    </td>
    <td class='p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40'>
    <button class = 'delet_btn_exp text-gred'>Delete</button>
    </td>
</tr>
          ";
            }
          } else {
            echo "<tr><td colspan='3' class='p-2'>No data</td></tr>";
          }
          ?>
        </tbody>
      </table>
      </div>
    </div>

      <script type="text/javascript" src="script.js"></script>
</body>

</html>