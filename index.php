<?php
// Add this code at the top of your index.php file
$name = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the token from the POST data
    $token = isset($_POST['token']) ? $_POST['token'] : '';
	$name = isset($_POST['name']) ? $_POST['name'] : ''; // Bonus task fram customization
    $email = isset($_POST['email']) ? $_POST['email'] : ''; // Bonus task fram customization
	
	echo $name;
	echo $email;
	
    // Check if the token is not empty
    if (!empty($token)) {
        // Add your API request code here using $token
        // Example:
		$apiEndpoint = 'https://api.sandbox.checkout.com/payments';
        $apiKey = 'Bearer sk_sbox_o2nulev2arguvyf6w7sc5fkznas';

        $headers = array(
            'Authorization: ' . $apiKey,
            'Cko-Idempotency-Key: CheckoutFrameRequest',
            'Content-Type: application/json'
        );

        $postData = json_encode(array(
            'source' => array(
                'type' => 'token',
                'token' => $token
            ),
            'amount' => 9,
            'currency' => 'EUR',
            'reference' => 'CheckoutFrameRequest',
            'customer' => array(
             //   'email' => $email,
             //   'name' => $name
			 'email' => "zohaib@gmail.com",
             'name' => 'Muhammad Zohaib'
            ),
			            'metadata' => array(
                'name' => $name,
                'email' => $email
            )
        ));
        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
        $apiResponse = curl_exec($ch);
        curl_close($ch);

        // Print the API response (modify as needed)
        echo $name;
		echo $email;
		echo $postData;
		echo $apiResponse;
		
			
		
    } else {
        // Handle the case where the token is empty
        echo 'Token is empty.';
    }

    // Terminate the script after handling the API request
    exit();
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8" />
    <title>T-Shirts Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="product-details">
        <h3>Product Summary:</h3>
        <p>T-Shirt - Black (Medium)...... 8 EUR</p>
		<p>T-Shirt - White (Large)....... 8 EUR</p>
        <p>Shipping ..................... 10 EUR</p>
        <p class="total">Total:  ............. 36 EUR</p>
    </div>
    	<form id="payment-form" method="POST" action="https://merchant.com/charge-card">
        <div class="payment-details">
            <h3>Payment Details:</h3>

			<label id="name-label">Cardholder Name</label>
            <input type="text" id="name-input" name="name" placeholder="First Name, Last Name"><br>

            <label id="email-label">Email Address</label>
            <input type="text" id="email-input" name="email" placeholder="name@domain.com"><br>

            <div class="card-frame"></div>
            <button id="pay-button" disabled>
               PAY 36 EUR
            </button>
        </div>
        <p class="error-message"></p>
        <p class="success-payment-message"></p>
    </form>



    <script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
    <script src="script.js"></script>
</body>

</html>