<?php

// Set the ticket price and maximum number of tickets available
$ticketPrice = 10.00;
$maxTickets = 100;

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $quantity = $_POST['quantity'];
  $payment = $_POST['payment'];

  // Validate the form data
  $errors = array();
  if (empty($name)) {
    $errors[] = 'Please enter your name.';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
  }
  if (empty($quantity)) {
    $errors[] = 'Please enter the number of tickets you want to purchase.';
  }
  if ($quantity > $maxTickets) {
    $errors[] = "You can't buy more than $maxTickets tickets.";
  }
  if (empty($payment)) {
    $errors[] = 'Please select a payment method.';
  }

  // If there are no errors, process the payment
  if (empty($errors)) {

    // Calculate the total price
    $totalPrice = $ticketPrice * $quantity;

    // Process the payment using the selected method
    if ($payment == 'paypal') {
      // Code to process payment via PayPal
      // Redirect to PayPal payment page
      header('Location: https://www.paypal.com');
      exit();
    } elseif ($payment == 'credit-card') {
      // Code to process payment via credit card
      // Redirect to payment confirmation page
      header('Location: payment-confirmation.php');
      exit();
    }

  }

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Buy Movie Tickets</title>
</head>
<body>

  <h1>Buy Movie Tickets</h1>

  <?php if (!empty($errors)): ?>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo $error; ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <br>
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
    <br>
    <label for="payment">Payment Method:</label>
    <select id="payment" name="payment">
      <option value="">Select a payment method</option>
      <option value="paypal">PayPal</option>
      <option value="credit-card">Credit Card</option>
    </select>
    <br>
    <input type="submit" value="Buy">
  </form>

</body>
</html>
