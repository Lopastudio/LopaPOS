let products = [];

fetch('fetchdata.php')
  .then(response => response.json())
  .then(data => {
    products = data;
    displayProducts(filteredProducts.slice(0, displayCount));
  })
  .catch(error => console.error('Error fetching products:', error));


const checkout = {};

function savePurchaseInformation(callback) {
  const purchaseData = Object.values(checkout);

  fetch('save_purchase.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(purchaseData)
  })
  .then(response => response.text())
  .then(data => {
    console.log(data);
    if (callback) {
      callback();
    }
  })
  .catch(error => console.error('Error saving purchase information:', error));
}





function addToCheckout(product, amount) {
  if (checkout[product.name]) {
    checkout[product.name].quantity += amount;
    checkout[product.name].total = checkout[product.name].quantity * checkout[product.name].price;
    const row = document.querySelector(`#checkout tbody tr[data-name="${product.name}"]`);
    row.querySelector('.quantity').innerText = checkout[product.name].quantity;
    row.querySelector('.total').innerText = `€${checkout[product.name].total.toFixed(2)}`;
  } else {
    checkout[product.name] = {
      price: product.price,
      quantity: amount,
      total: product.price * amount
    };
    const checkoutTable = document.querySelector('#checkout tbody');
    const row = checkoutTable.insertRow();
    row.setAttribute('data-name', product.name);
    const nameCell = row.insertCell();
    const priceCell = row.insertCell();
    const quantityCell = row.insertCell();
    const totalCell = row.insertCell();
    nameCell.innerText = product.name;
    priceCell.innerText = `€${product.price.toFixed(2)}`;
    quantityCell.classList.add('quantity');
    quantityCell.innerText = amount;
    totalCell.classList.add('total');
    totalCell.innerText = `€${(product.price * amount).toFixed(2)}`;
  }
  updateCheckoutTotal();
}

function updateCheckoutTotal() {
  let total = 0;
  for (const productName in checkout) {
    total += checkout[productName].total;
  }
  const checkoutTotalCell = document.querySelector('#checkout-total');
  checkoutTotalCell.innerText = `€${total.toFixed(2)}`;
}

function handleCashPayment() {
  savePurchaseInformation(function() {
    window.location.reload();
  });
  const amountInput = document.querySelector('#amount');
  const amount = parseFloat(amountInput.value);
  const checkoutTotal = parseFloat(document.querySelector('#checkout-total').innerText.slice(1));
  if (amount < checkoutTotal) {
    alert('The amount is not enough!');
  } else {
    const change = amount - checkoutTotal;
    alert(`Change: €${change.toFixed(2)}`);
    clearCheckout();
  }
}

function handleCardPayment() {
  //Not finished, just a proof of concept. If you want, you can implement your own logic here
  savePurchaseInformation(function() {
    window.location.reload();
  });
  clearCheckout();
}

function clearCheckout() {
  const checkoutTable = document.querySelector('#checkout tbody');
  checkoutTable.innerHTML = '';
  const checkoutTotal = document.querySelector('#checkout-total');
  checkoutTotal.textContent = '€0.00';
  checkout = {};
}

const productTable = document.querySelector('#products tbody');
const displayCount = 5;
let filteredProducts = [];

fetch('fetchdata.php')
  .then(response => response.json())
  .then(data => {
    products = data;
    filteredProducts = products.slice(0, displayCount);
    displayProducts(filteredProducts);
  })
  .catch(error => console.error('Error fetching products:', error));


function displayProducts(products) {
  productTable.innerHTML = '';
  for (const product of products) {
    const row = productTable.insertRow();
    row.classList.add('border-b', 'border-gray-200');
    const nameCell = row.insertCell();
    nameCell.classList.add('px-4', 'py-2', 'text-center');
    const priceCell = row.insertCell();
    priceCell.classList.add('px-4', 'py-2', 'text-center');
    const quantityCell = row.insertCell();
    quantityCell.classList.add('px-4', 'py-2', 'text-center');
    const actionCell = row.insertCell();
    actionCell.classList.add('px-4', 'py-2', 'text-center');

    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.min = '1';
    quantityInput.max = '99';
    quantityInput.value = '1';
    quantityInput.classList.add('w-16', 'px-2', 'py-1', 'rounded', 'border', 'border-gray-300', 'focus:outline-none', 'focus:border-blue-500', 'text-black');

    const addButton = document.createElement('button');
    addButton.innerText = 'Add';
    addButton.classList.add('px-4', 'py-2', 'bg-blue-500', 'text-white', 'rounded', 'focus:outline-none', 'hover:bg-blue-600');
    addButton.addEventListener('click', () => {
      const quantity = parseInt(quantityInput.value);
      if (quantity > 0) {
        addToCheckout(product, quantity);
      }
    });

    nameCell.innerText = product.name;
    priceCell.innerText = `${product.price.toFixed(2)}`;
    quantityCell.appendChild(quantityInput);
    actionCell.appendChild(addButton);
  }
}

displayProducts(filteredProducts);


const searchInput = document.querySelector('#search');
searchInput.addEventListener('input', (event) => {
  const query = event.target.value.toLowerCase();
  filteredProducts = products.filter(product => product.name.toLowerCase().includes(query));
  displayProducts(filteredProducts.slice(0, displayCount));
});


const cashPaymentButton = document.querySelector('#cash-payment-button');
cashPaymentButton.addEventListener('click', handleCashPayment);

const cardPaymentButton = document.querySelector('#card-payment-button');
cardPaymentButton.addEventListener('click', handleCardPayment);