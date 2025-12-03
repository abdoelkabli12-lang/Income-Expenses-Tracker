const incomeBTN = document.getElementById("incomes-btn");
const expencesBTN = document.getElementById("expences-btn");
const incomeForm = document.getElementById("incomes");
const expencesForm = document.getElementById("expences");
const Blur = document.querySelectorAll(".bgblur");
const cont = document.querySelectorAll(".cont");

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

