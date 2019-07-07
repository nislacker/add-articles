<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Articles Generator 1.0</title>

    <style>

        form {
            margin: 0 auto;
            padding: 20px;
        }

        legend.border {
            margin: 0 0 1em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;

            width: inherit; /* Or auto */
            padding: 0 10px; /* To give a bit of padding on the left and right */
            border-bottom: none;
        }

        #start_index {
            width: 80px;
        }
    </style>
</head>
<body>

<?php if (count($articles) > 0): ?>

    <form action="create_articles_from_DB" method="post" class="form col-sm-5">
        <fieldset class="border">
            <legend class="border">Выбор строк БД для генерации статей</legend>
            <label for="start_index">От id = </label>
            <input type="number" id="start_index" name="start_index"
                   value="<?= isset($_POST['start_index']) ? $_POST['start_index'] : '' ?>">
            <button type="submit" name="submit">Создать файлы статей!</button>
        </fieldset>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <?php foreach ($articles[0] as $article_key => $article_value): ?>
                <th scope="col"><?= $article_key ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>

            <tr>
                <?php foreach ($article as $article_key => $article_value): ?>

                    <?php if ($article_key === 'id'): ?>
                        <th><?= $article_value ?></th>
                    <?php else: ?>
                        <td><?= $article_value ?></td>
                    <?php endif; ?>

                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>В БД пока нет ни одной статьи...</p>
<?php endif; ?>

</body>
</html>
