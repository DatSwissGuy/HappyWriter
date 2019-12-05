<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php /** @var $metadata MetadataModel */
        echo $metadata['name']
        ?>
    </title>
    <link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_CSS ?>">
    <script src="<?php echo BOOTSTRAP_JS ?>"></script>
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
        echo "<h2>Deine aktuelle Bestellung</h2>";
        /** @var Order $articleById */
        echo $articleById[0]->name.": <strong>".$articleById[0]->price."</strong><br>";
        /** @var Content $orderContents */
        foreach ($orderContents as $orderContent) {
            echo $orderContent->name.": <strong>".$orderContent->price."</strong><br>";
            /** @var $sumContents Sum */
            $sumContents += $orderContent->price;
        }
        echo "<hr>";
        echo "Summe: <strong>".number_format($sumContents+$articleById[0]->price, 2,'.', '')."</strong>";
        echo "<hr>";
        echo "<form action='/customer/new_customer/' method='post'>
              <button type='submit' class='btn btn-primary'>Bestellen</button>
              <input type='hidden' name='order-id' value='{$orderId}'>
              </form>";
    }
    ?>
    <br>
    <br>
</div>
</body>
</html>
