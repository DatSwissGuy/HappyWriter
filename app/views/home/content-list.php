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
    <h1>[Table] Content List</h1>
</div>
<div class="container">
    <table>
        <tr>
            <th>Model</th>
            <th>View</th>
            <th>Controller</th>
        </tr>
        <tr>
            <td>No model</td>
            <td>app/views/home/content-list.php</td>
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
        <?php foreach ($contents as $content) {
            echo "<tr>
                  <td>" . $content->name . "</td>
                  <td>" . $content->description . "</td>
                  <td>" . $content->price . "</td>
                  </tr>";
            echo "<br>";
        } ?>
    </table>
    <hr>
    <a href="/home">Home</a><br>
    <a href="/home/edit">Edit</a><br>
    <a href="/home/listArticle">Article List</a><br>
    <a href="/home/listContent">Content List</a><br>
</div>
</body>
</html>