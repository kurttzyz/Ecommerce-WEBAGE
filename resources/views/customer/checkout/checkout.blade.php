<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>GCash Checkout</h2>
  

    <form action="{{ route('customer.checkout') }}" method="POST">
        @csrf
        <!-- your inputs here -->

        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br><br>

        <button type="submit">Pay with GCash</button>
    </form>
</body>
</html>
