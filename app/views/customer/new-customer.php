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
    <h1>Gib deine Personalien an</h1>
</div>
<div class="container">
    <form action="/customer/verify_customer" method="post">
        <label for="first-name">Vorname</label>
        <input type="text" name="first-name" placeholder="Vorname"><br>
        <label for="last-name">Nachname</label>
        <input type="text" name="last-name" placeholder="Nachname"><br>
        <label for="street">Strasse</label>
        <input type="text" name="street" placeholder="Street"><br>
        <label for="city">Ort</label>
        <input type="text" name="city" placeholder="Ort"><br>
        <label for="zipcode">Postleitzahl</label>
        <input type="text" name="zipcode" placeholder="Postleitzahl"><br>
        <label for="telephone">Telefonnummer</label>
        <input type="text" name="telephone" placeholder="Telefonnumer"><br>
        <label for="annotations">Bemerkungen</label>
        <textarea name="annotations" placeholder="Bemerkungen"></textarea>
        <br>
        <button type="reset">Zurücksetzen</button>
        <button type="submit">OK</button>
    </form>
</div>
</body>
</html>