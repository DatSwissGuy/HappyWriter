<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Happy Writer Webshop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<div class="container">
    <h3><?php echo $metadata['name'] ?></h3>
</div>

<div class="container">
    <h2>Model: app/models/metadata-model.php</h2>
    <h2>View: app/views/home.php</h2>
    <h2>Controller: app/controller/home-controller.php</h2>
    <a href="/home/edit">Home Edit</a><br>
    <strong>Version: <?php echo $metadata['version'] ?></strong>
</div>
</body>
</html>
