<!DOCTYPE html>
<html lang="en">
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
    <h1><?php echo $metadata['name'] ?></h1>
</div>
<div class="container">
    <table>
        <tr>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Preis</th>
        </tr>
        <?php /** @var $articles Article[] */
        foreach ($articles as $article) {
            echo "<tr>
                  <td>" . $article->name . "</td>
                  <td>" . $article->description . "</td>
                  <td>" . $article->price . "</td>
                  </tr>";
        } ?>
    </table>
</div>
<div class="container">
    <hr>
    <a href="/home">Home</a><br>
    <a href="/home/content">Content</a><br>
    <a href="/home/new_customer/">Neukunde</a><br>
    <hr>
    <a href="/home/edit">Edit</a><br>
    <hr>
    <strong>Version: <?php echo $metadata['version'] ?></strong>
</div>
</body>
</html>
