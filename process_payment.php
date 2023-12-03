
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credit Card Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .credit-card {
            width: 400px;
            background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjd41SEbzbOn3cbQFjSQ-JfA-2zAWHDhqRzclhmz84YmKZGEwf9sEdYM5a_fjMFD2k_1w&usqp=CAU') no-repeat;
            background-size: cover;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .credit-card h1 {
            color: #fff;
            text-align: center;
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            color: #fff;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        input[type="text"]:focus, input[type="email"]:focus {
            background: rgba(255, 255, 255, 1);
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="credit-card">
        <h1>Credit Card Payment</h1>
        <form action="my_bookings.php?payment_success=true" method="post">
            <div class="form-group">
                <label for="name">Name on Card:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" required>
            </div>

            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
            </div>

            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <input type="submit" value="Submit Payment">
        </form>
    </div>
</body>
</html>
