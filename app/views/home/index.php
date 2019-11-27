<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Happy Writer Webshop</title>
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
            <th>Model</th>
            <th>View</th>
            <th>Controller</th>
        </tr>
        <tr>
            <td>app/models/metadata-model.php</td>
            <td>app/views/home/index.php</td>
            <td>app/controller/home-controller.php</td>
        </tr>
    </table>
    <hr>
    <a href="/home">Home</a><br>
    <a href="/home/edit">Edit</a><br>
    <a href="/home/listArticle">Article List</a><br>
    <a href="/home/listContent">Content List</a><br>
    <hr>
    <strong>Version: <?php echo $metadata['version'] ?></strong>
</div>
</body>
</html>
