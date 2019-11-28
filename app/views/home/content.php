<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Happy Writer Webshop - Content List</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <h2>Auswahl des Inhalts</h2>
</div>
<div class="container">
    <h3>Gew&auml;hltes Etui</h3>
    <?php echo $selectedArticle[0]->name; ?>
</div>
<div class="container">
    <h3>Inhalte</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Preis</th>
        </tr>
        <?php foreach ($contents as $content) {
            echo "<tr>
                  <td>" . $content->name . "</td>
                  <td>" . $content->description . "</td>
                  <td>" . $content->price . "</td>
                  </tr>";
        } ?>
    </table>
</div>
<div class="container">
    <hr>
    <a href="/home">Home</a><br>
</div>
</body>
</html>