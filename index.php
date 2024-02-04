<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LopaPOS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="./login.css" rel="stylesheet">

  <link rel="icon" type="image/x-icon" href="./favicon.ico">
</head>

<body class="bg-gray-900 text-white p-8">
  <div class="container mx-auto mt-5">
    <?php
    //Check if user is logged in
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        //Show if user logged in
        ?>
        <h1 class="text-4xl mb-5">LopaPOS System</h1>

        <form action="logout.php" method="post">
          <input type="submit" value="Logout" class="bg-red-500 text-white px-4 py-2 rounded-md">
          <br></br>
        </form>




        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Search products..."
               class="w-full px-4 py-2 rounded-lg border border-gray-800 focus:outline-none focus:border-blue-500 text-black">

        <table id="products" class="w-full mt-5 table-auto">
          <thead class="bg-gray-800">
          <tr>
            <th class="px-4 py-2">Product Name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Quantity</th>
            <th class="px-4 py-2">Action</th>
          </tr>
          </thead>
          <tbody>
          <!-- Product rows here :) -->
          </tbody>
        </table>

        <hr class="my-8">

        <h2 class="text-2xl">Checkout</h2>

        <table id="checkout" class="w-full mt-5 table-auto">
          <thead class="bg-gray-800">
          <tr>
            <th class="px-4 py-2">Product Name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Quantity</th>
            <th class="px-4 py-2">Total</th>
          </tr>
          </thead>
          <tbody>
          <!-- Checkout rows here :) -->
          </tbody>
          <tfoot>
          <tr>
            <td colspan="3" class="text-right">Total:</td>
            <td id="checkout-total" class="px-4 py-2">0.00€</td>
          </tr>
          </tfoot>
        </table>

        <hr class="my-8">

        <div id="payment" class="card mb-5">
          <div class="card-body flex items-center">
            <div class="form-group mr-4">
              <label for="amount">Amount of given money:</label>
              <input type="number" id="amount" name="amount" min="0" step="0.01"
                     class="w-48 px-4 py-2 rounded-lg border border-gray-800 focus:outline-none focus:border-blue-500 text-gray-900">
            </div>
            <button id="cash-payment-button" class="btn btn-primary mr-2 bg-green-500 hover:bg-green-600">Cash
              Payment</button>
            <button id="button-clear" class="btn btn-danger mr-2 bg-gray-600 hover:bg-gray-700">Clear Basket</button>
            <button id="card-payment-button" class="btn btn-primary bg-red-500 hover:bg-red-600">Pay with Card</button>
          </div>
        </div>
        <br></br>
        <footer class="text-center">
          <h4 class="mb-4">Made with ❤️ by <a href="https://lopastudio.sk"><u>Patrik Nagy</u></a></h4>
          <h4>(C) Lopastudio 2023 - 2024</h4>
        </footer>


        <?php
    } else {
        ?>

        <div class="login-container">
          <div class="login-form bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-semibold mb-6 text-black">User Login</h2>
            <form action="login.php" method="post">
              <div class="mb-4">
                  <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                  <input type="text" id="username" name="username" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 text-gray-900" required>
              </div>
              <div class="mb-6">
                  <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                  <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 text-gray-900" required>
              </div>
              <div class="flex items-center justify-between">
                  <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                  <a href="register.php" class="text-blue-500 hover:underline">Don't have an account? Register</a>
              </div>
          </form>
          </div>
        </div>
        <?php
    }
    ?>
    <script src="script.js"></script>
  </div>
</body>
 
</html>
