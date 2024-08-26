document.getElementById("productType").addEventListener("change", function () {
  var dynamicForm = document.getElementById("dynamic-form");
  dynamicForm.innerHTML = ""; // Clear the form

  if (this.value == "DVD") {
    dynamicForm.innerHTML =
      '<label for="size">Size (MB)</label><input type="number" id="size" name="size" required>';
  } else if (this.value == "Book") {
    dynamicForm.innerHTML =
      '<label for="weight">Weight (KG)</label><input type="number" id="weight" name="weight" required>';
  } else if (this.value == "Furniture") {
    dynamicForm.innerHTML =
      '<label for="height">Height (CM)</label><input type="number" id="height" name="height" required><label for="width">Width (CM)</label><input type="number" id="width" name="width" required><label for="length">Length (CM)</label><input type="number" id="length" name="length" required>';
  }
});
