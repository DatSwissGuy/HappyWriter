<?php session_start() ?>
<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php /** @var $metadata MetadataModel */
            echo $metadata['name']
        ?>
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <h1>[Table] Article List</h1>
</div>
<div class="container">
    <table>
        <tr>
            <th>Model</th>
            <th>View</th>
            <th>Controller</th>
        </tr>
        <tr>
            <td>app/models/article-model.php</td>
            <td>app/views/home/article-list.php</td>
            <td>app/controller/home-controller.php</td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Preis</th>
        </tr>
        <?php foreach ($articles as $article) {
            echo "<tr>
                  <td>" . $article->name . "</td>
                  <td>" . $article->description . "</td>
                  <td>" . $article->price . "</td>
                  </tr>";
            echo "<br>";
        } ?>
    </table>
    <hr>
    <a href="/home">Home</a><br>
    <a href="/home/edit">Edit</a><br>
    <a href="/home/article">Article List</a><br>
    <a href="/home/content">Content List</a><br>
</div>
</body>
</html>