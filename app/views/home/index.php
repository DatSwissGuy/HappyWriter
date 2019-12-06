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
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
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
    /** @var OrderModel $orderId */
    if ($orderId === null) {
        echo "<h3>Etui auswählen:</h3>";
        /** @var Article[] $articles */
        foreach ($articles as $article) {
            echo "<a href='/shop/content/" . $article->id . "'><img class='article' src='/public/assets/images/" . $article->icon . "'></a>";
        }
    }
    ?>
</div>
<div class="container">
    <?php
    /** @var OrderModel $orderId */
    if ($orderId !== null) {
        echo "<h3>Deine aktuelle Bestellung:</h3>";
        /** @var Order $articleById */
        echo $articleById[0]->name . ": <strong>" . $articleById[0]->price . "</strong><br>";
        /** @var Content $orderContents */
        foreach ($orderContents as $orderContent) {
            echo $orderContent->name . ": <strong>" . $orderContent->price . "</strong><br>";
            /** @var $sumContents Sum */
            $sumContents += $orderContent->price;
        }
        echo "<hr>";
        echo "Summe: <strong>" . number_format($sumContents + $articleById[0]->price, 2, '.', '') . "</strong>";
        echo "<hr>";
        echo "
              <form style='display: inline' action='/shop/abort/' method='post'>
              <button type='submit' class='btn btn-danger'>Stornieren</button>
              <input type='hidden' name='order-id' value='{$orderId}'>
              </form>
              <form style='display: inline' action='/customer/new_customer/' method='post'>
              <button type='submit' class='btn btn-primary'>Bestellen</button>
              <input type='hidden' name='order-id' value='{$orderId}'>
              </form>
              ";
    }
    ?>
    <br>
    <br>
</div>
</body>
</html>
