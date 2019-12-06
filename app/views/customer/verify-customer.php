<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angaben best&auml;tigen</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_CSS ?>">
    <script src="<?php echo BOOTSTRAP_JS ?>"></script>
</head>
<body>
<div class="container">
    <h2>Bestätige deine Angaben</h2>
</div>
<div class="container">
    <p>
        <strong>Vorname: </strong>
        <?php
        /** @var $customer Customer */
        echo $customer->firstname
        ?>
    </p>
    <p>
        <strong>Nachname: </strong>
        <?php
        /** @var $customer Customer */
        echo $customer->lastname
        ?>
    </p>
    <p>
        <strong>Strasse: </strong>
        <?php
        /** @var $customer Customer */
        echo $customer->street
        ?>
    </p>
    <p>
        <strong>Ort: </strong>
        <?php
        /** @var $customer Customer */
        echo $customer->city
        ?>
    </p>
    <p>
        <strong>Postleitzahl: </strong>
        <?php
        /** @var $customer Customer */
        echo $customer->zipcode
        ?>
    </p>
    <p>
        <strong>Telefon: </strong>
        <?php
        /** @var $customer Customer */
        echo $customer->telephone
        ?>
    </p>
    <p>
        <strong>Bemerkungen: </strong>
        <?php
        /** @var Order $order */
        echo $order->annotations
        ?>
    </p>
    <form action="/shop/order_complete" method="post">
        <input type="hidden" name="first-name" value="<?php echo $customer->firstname ?>">
        <input type="hidden" name="last-name" value="<?php echo $customer->lastname ?>">
        <input type="hidden" name="street" value="<?php echo $customer->street ?>">
        <input type="hidden" name="city" value="<?php echo $customer->city ?>">
        <input type="hidden" name="zipcode" value="<?php echo $customer->zipcode ?>">
        <input type="hidden" name="telephone" value="<?php echo $customer->telephone ?>">
        <input type="hidden" name="annotations" value="<?php echo $order->annotations ?>">
        <input type="hidden" name="order-id" value="<?php echo /** @var Order $orderId */ $orderId ?>">
        <hr>
        <button class="btn btn-danger" type="button" onclick="goBack()">Zurück</button>
        <button class="btn btn-primary" type="submit" >Best&auml;tigen</button>
    </form>
</div>
<script>
    function goBack() {
        history.back();
    }
</script>
</body>
</html>