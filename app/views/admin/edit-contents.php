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
    <h1>Neuen Etui-Inhalt hinzufügen</h1>
</div>
<div class="container">
    <form class="needs-validation" action="/admin/add_content" method="post" novalidate>
        <div class="form-row">
            <div class="form-group col">
                <label for="name">Produktname</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Produktname" required>
            </div>
            <div class="form-group col">
                <label for="price">Preis</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Preis" required>
            </div>
            <div class="form-group col">
                <label for="icon">Bild</label>
                <input type="text" class="form-control" id="icon" name="icon" placeholder="Bild" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <label for="description">Beschreibung</label>
                <textarea class="form-control" id="description" name="description" placeholder="Beschreibung"
                          required></textarea>
            </div>
        </div>
        <p>Verfügbarkeit für folgende Artikel:</p>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="article-1" value="article-1">
            <label class="form-check-label" for="article-1">Holzetui</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="article-2" value="article-2">
            <label class="form-check-label" for="article-2">Stoffetui</label>
        </div>
</div>
    <hr>
    <div class="container">
        <button class="btn btn-danger" type="button" onclick="goBack()">Zurück</button>
        <button class="btn btn-primary" type="submit">Inhalt anlegen</button>
    </div>
</form>
<script>
    (function () {
        window.addEventListener('load', function () {
            let forms = document.getElementsByClassName('needs-validation');
            let number = document.getElementById('price');
            let validation = Array.prototype.filter.call(forms, function (form) {
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
        window.location.href = '/admin';
    }
</script>
</body>
</html>