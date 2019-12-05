<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etui-Inhalte editieren</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_CSS ?>">
    <script src="<?php echo BOOTSTRAP_JS ?>"></script>
</head>
<body>
<div class="container">
    <h1>Etui inhalte bearbeiten</h1>
</div>
<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Name</th>
            <th scope="col">Beschreibung</th>
            <th scope="col">Preis</th>
            <th scope="col">Bearbeiten / L&ouml;schen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($contents as $content) {
            echo "<tr>
                      <th scope='row'>$content->id</th>
                      <td>$content->name</td>
                      <td>$content->description</td>
                      <td>$content->price</td>
                      <td>
                      <button type='button' class='btn btn-primary' onclick='editContent($content->id)'>Bearbeiten</button>
                      <button type='button' class='btn btn-danger' onclick='deleteContent($content->id)'>L&ouml;schen</button>
                      </td>
                      </tr>";
        }
        ?>
        </tbody>
    </table>
    <hr>
    <button class="btn btn-danger" type="button" onclick="goBack()">Zurück</button><br><br>
</div>
<script>
    function editContent(args) {
        window.location.href = '/admin/edit_content/'+args;
    }

    function deleteContent(args) {
        let confirmed = confirm('Eintrag löschen?');
        if (confirmed) {
            window.location.href = '/admin/delete_content/'+args;
        }
    }

    function goBack() {
        window.location.href = '/admin';
    }
</script>
</body>
</html>
