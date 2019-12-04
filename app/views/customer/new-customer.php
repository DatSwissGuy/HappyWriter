<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_CSS ?>">
    <script src="<?php echo BOOTSTRAP_JS ?>"></script>
</head>
<body>
<div class="container">
    <h1>Gib deine Personalien an</h1>
</div>
<div class="container">
    <form class="needs-validation" action="/customer/verify_customer" method="post" novalidate>
        <div class="form-row">
            <div class="form-group col">
                <label for="first-name">Vorname</label>
                <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Vorname"
                       required>
            </div>
            <div class="form-group col">
                <label for="last-name">Nachname</label>
                <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Nachname" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="street">Strasse</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Strasse" required>
            </div>
            <div class="form-group col">
                <label for="city">Ort</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Ort" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="zipcode">Postleitzahl</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Postleitzahl" required>
            </div>
            <div class="form-group col">
                <label for="telephone">Telefonnummer</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telefonnumer" required>
            </div>
        </div>
        <div class="form-group">
            <label for="annotations">Bemerkungen</label>
            <textarea class="form-control" id="annotations" name="annotations" placeholder="Bemerkungen"></textarea>
        </div>
        <hr>
        <button class="btn btn-danger" type="button" onclick="goBack()">Zurück</button>
        <button class="btn btn-warning" type="reset">Formular zurücksetzen</button>
        <button class="btn btn-primary" type="submit">Senden</button>
        <input type="hidden" name="order-id" value="<?php echo $order->id ?>">
    </form>
</div>
<script>
    (function () {
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    }) ();
    
    function goBack() {
        history.back();
    }
</script>
</body>
</html>