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
    <h1>Admin Login</h1>
</div>
<div class="container">
    <form action="/admin/admin_panel" method="post">
        <label for="username">Vorname</label>
        <input type="text" name="username" placeholder="Username"><br>
        <label for="password">Nachname</label>
        <input type="password" name="password" placeholder="Passwort"><br>
        <br>
        <button type="submit">OK</button>
    </form>
</div>
</body>
</html>