<?php
include('partials-front/header.php');
?>






<script src="https://khalti.com/static/khalti-checkout.js"></script>

<link rel="stylesheet" href="../css/admin.css">

<body class="bg">
<div class="login_container">
        <div class="myform">
             <form id="payment-form">
                <input type="text" id="name" name="username" placeholder="Enter username" required>
                <input type="text" id="amount" name="amount" placeholder="Enter amount" required>
                <button type="button" onclick="makePayment()">Pay with Khalti</button>
             </form>
        </div>
        </div>
</body>
        
    <script>
        var config = {
            publicKey: "merchant_public_key",
            productIdentity: "your_product_identity",
            productName: "Product Name",
            productUrl: "https://yourwebsite.com/product",
            eventHandler: {
                onSuccess(payload) {
                    console.log(payload);
                    // Handle the success event
                },
                onError(error) {
                    console.log(error);
                    // Handle the error event
                },
                onClose() {
                    console.log("Checkout closed.");
                    // Handle the close event
                }
            }
        };

        var checkout = new KhaltiCheckout(config);

        function makePayment() {
            var amount = document.getElementById("amount").value;
            checkout.show({ amount });
        }
    </script>
        <div class="clearfix"></div>

<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>

<?php
    
    include("partials-front/footer.php");
    ?>  