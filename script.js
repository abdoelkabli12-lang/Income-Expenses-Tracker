const incomeBTN = document.getElementById("incomes-btn");
const expencesBTN = document.getElementById("expences-btn");
const incomeForm = document.getElementById("incomes");
const expencesForm = document.getElementById("expences");
const Blur = document.querySelectorAll(".bgblur");
const cont = document.querySelectorAll(".cont");
const editBtn = document.querySelectorAll(".edit_btn");
const ha3 = document.getElementById("ha3");

editBtn.forEach(btn => {
  btn.addEventListener("click", (e) => {
    let row = e.target.closest(".element");
    let div = document.createElement("div");
    div.classList.add("w-full");

    let editForm = `
   <div class="bgblur fixed backdrop-blur-sm bg-white/15 flex h-screen w-[100%] justify-center items-center ">
      <div class="cont w-96 mx-auto bg-white rounded shadow">

        <div class="mx-16 py-4 px-8 text-black text-xl font-bold border-b border-grey-500 flex justify-center">Add Income
        </div>

        <form id="edit-inc-form" action="Income.php" method="post">
          <div class="py-4 px-8">

            <div class="mb-4">
              <label for="edit-Incomes" class="block text-grey-darker text-sm font-bold mb-2">Edit Income:</label>
              <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                name="edit-Incomes" id="edit-Incomes" value="" placeholder="Enter Your Income amount">
            </div>


            <div class="mb-4">
              <label class="block text-grey-darker text-sm font-bold mb-2">Edit Description: </label>
              <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                name="edit-descreption" id="edit-descreption" value="" placeholder="Enter a descreption">
            </div>

            <input value = '${row.dataset.id}' name = 'id' type = 'hidden'>

            <div class="mb-4">
              <label class="block text-grey-darker text-sm font-bold mb-2">Edit Date: </label>
              <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="date"
                name="edit-date" id="edit-date" value="" placeholder="Enter Your date">
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
    `;

    div.innerHTML = editForm;
    ha3.appendChild(div);
  });
});
incomeBTN.addEventListener("click", () => {
  incomeForm.classList.remove("hidden");
})

expencesBTN.addEventListener("click", () => {
  expencesForm.classList.remove("hidden");
})


Blur.forEach(blur => {
  blur.addEventListener("click", () => {
    expencesForm.classList.add("hidden");
    incomeForm.classList.add("hidden");
  })
})
cont.forEach(cont => {
  cont.addEventListener("click", (e) => {
    e.stopPropagation();
  })
})






