<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <h1>Bestätige deine Angaben</h1>
</div>
<div class="container">
    <p><strong>Vorname: </strong><?php echo $_POST['first-name'] ?></p>
    <p><strong>Nachname: </strong><?php echo $_POST['last-name'] ?></p>
    <p><strong>Strasse: </strong><?php echo $_POST['street'] ?></p>
    <p><strong>Ort: </strong><?php echo $_POST['city'] ?></p>
    <p><strong>Postleitzahl: </strong><?php echo $_POST['zipcode'] ?></p>
    <p><strong>Telefon: </strong><?php echo $_POST['telephone'] ?></p>
    <p><strong>Bemerkungen: </strong><?php echo $_POST['annotations'] ?></p>
    <br>
    <form action="/home/thankyou" method="post">
        <button type="submit">Bestätigen</button>
    </form>
</div>
</body>
</html>