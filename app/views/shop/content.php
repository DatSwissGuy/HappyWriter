<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_CSS ?>">
    <script src="<?php echo BOOTSTRAP_JS ?>"></script>
</head>
<body>
<div class="container">
    <h2>Auswahl des Inhalts</h2>
</div>
<div class="container">
    <h3>Gew&auml;hltes Etui: <?php echo /** @var Article $selectedArticle */$selectedArticle[0]->name ?></h3>
</div>
<div class="container">
    <form method="post" action="/shop/order_summary"
    <h3>Inhalte</h3>
    <?php
    /** @var Content[] $contentsForArticle */
    foreach ($contentsForArticle as $content) {
        echo "<div>
                  <input type='checkbox' name='content-id-" . $content->id . "' value='" . $content->id . "'>" . $content->name . "
              </div>";
    }
    ?>
    <br>
    <input type="hidden" name="article-id" value="<?php echo $selectedArticle[0]->id ?>">
    <button type="submit">Best&auml;tigen</button>
    </form>
</div>
</body>
</html>