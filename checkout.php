<!DOCTYPE html>
<html>
<head>
    <title>Buy my new product</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<section>
    <div class="product">
        <img src="https://i.imgur.com/EHyR2nP.png" alt="The cover of Stubborn Attachments" />
        <div class="description">
            <h3>Skyesol Test Product</h3>
            <h5>Rs 500.00</h5>
        </div>
    </div>
    <form action="stripe_session.php" method="POST">
        <input type="number" name="qty" >
        <button type="submit" id="checkout-button">Checkout</button>
    </form>
</section>
</body>
</html>