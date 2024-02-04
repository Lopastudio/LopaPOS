const itemsTable = document.getElementById('items-table');
let items = [];

// Load items from localStorage if available, PS, IDK IF This is still used, but let's let it exist, for compatibility reasons 
const storedItems = localStorage.getItem('items');
if (storedItems) {
  items = JSON.parse(storedItems);
  items.forEach(item => addItemToTable(item));
}

function addItem() {
  const nameInput = document.getElementById('item-name');
  const priceInput = document.getElementById('item-price');
  const name = nameInput.value.trim();
  const price = parseFloat(priceInput.value.trim());

  if (name && !isNaN(price)) {
    const newItem = { name, price };
    items.push(newItem);
    addItemToTable(newItem);
    updateJson();
    saveItemsToLocalStorage();
    nameInput.value = '';
    priceInput.value = '';
  }
}

function addItemToTable(item) {
  const newRow = itemsTable.insertRow();
  const nameCell = newRow.insertCell(0);
  const priceCell = newRow.insertCell(1);
  const deleteCell = newRow.insertCell(2);
  nameCell.innerHTML = item.name;
  priceCell.innerHTML = `$${item.price.toFixed(2)}`;
  deleteCell.innerHTML = `<button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>`;
  const deleteButton = deleteCell.querySelector('.delete-btn');
  deleteButton.addEventListener('click', () => {
    const rowIndex = newRow.rowIndex - 1;
    items.splice(rowIndex, 1);
    newRow.remove();
    updateJson();
    saveItemsToLocalStorage();
  });
}

function updateJson() {
  const jsonOutput = document.getElementById('json-output');
  jsonOutput.textContent = JSON.stringify(items, null, 2);
}

function saveItemsToLocalStorage() {
  localStorage.setItem('items', JSON.stringify(items));
  updateJson();
}
