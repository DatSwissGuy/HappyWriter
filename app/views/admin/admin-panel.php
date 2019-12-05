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
    <h1>Adminpanel</h1>
</div>
<div class="container">
    <div><a href="/admin/edit_contents">Etui-Inhalt hinzufügen</a></div>
</div>
<hr>
<div class="container">
    <button class="btn btn-danger" type="button" onclick="logout()">Logout</button>
</div>
<script>
    function logout() {
        window.location.href = '/admin/logout/';
    }
</script>
</body>
</html>