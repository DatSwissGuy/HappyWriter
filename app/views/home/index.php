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
    <h1><?php
        echo $metadata['name']
        ?>
    </h1>
</div>
<div class="container">
    <?php
    /** @var Article[] $articles */
    foreach ($articles as $article) {
        echo "<div><a href='/shop/content/" . $article->id . "'>" . $article->name . "</a></div>";
    }
    ?>
</div>
<div class="container">
    <br>
    <?php
    /** @var OrderModel $orderId */
    if ($orderId !== null) {
    echo "<a href='/customer/new_customer/" . $orderId . "'>Place Order</a>";
    }
    ?>
    <br>
    <br>
</div>
</body>
</html>
