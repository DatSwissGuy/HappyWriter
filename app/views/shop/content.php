<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auswahl des Inhalts</title>
    <link rel="stylesheet" type="text/css" href="<?php echo BOOTSTRAP_CSS ?>">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <script src="<?php echo BOOTSTRAP_JS ?>"></script>
</head>
<body>
<div class="container">
    <h1>Auswahl des Inhalts</h1>
</div>
<div class="container">
    <h3>Gew&auml;hltes Etui: <?php echo /** @var Article $selectedArticle */
        $selectedArticle[0]->name ?></h3>
</div>
<div class="container">
    <form method="post" action="/shop/order_summary">
        <?php
        /** @var Content[] $contentsForArticle */
        foreach ($contentsForArticle as $content) {
            echo "<div class='form-check'>
                  <input class='form-check-input' type='checkbox' name='content-id-" . $content->id . "' id='content-id-" . $content->id . "' value='" . $content->id . "'>
                  <label class='form-check-label' for='content-id-" . $content->id . "'>
                  <img src='/public/assets/images/" . $content->icon . "'>
                  <strong>" . $content->name . "</strong>: " . $content->description . "
                  </label>
                  </div>";
        }
        ?>
        <input type="hidden" name="article-id" value="<?php echo $selectedArticle[0]->id ?>">
        <hr>
        <button class="btn btn-danger" type="button" onclick="abort()">Abbrechen</button>
        <button class="btn btn-primary" type="submit" >Best&auml;tigen</button>
    </form>
</div>
<script>
    function abort() {
        window.location.href = '/';
    }
</script>
</body>
</html>