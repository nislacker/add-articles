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
            border: 1px groove #ddd !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;

            width: inherit; /* Or auto */
            padding: 0 10px; /* To give a bit of padding on the left and right */
            border-bottom: none;
        }

        #index1, #index2 {
            width: 80px;
        }
    </style>
</head>
<body>

<?php if (count($articles) > 0): ?>

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

    <form action="" method="post" class="form col-sm-8">
        <fieldset class="border">
            <legend>Выбор строк БД для генерации статей</legend>
            <label for="index1">От id = </label>
            <input type="number" id="index1" name="index1"
                   value="<?= isset($_POST['index1']) ? $_POST['index1'] : '' ?>">
            <label for="index2">, до id = </label>
            <input type="number" id="index2" name="index2"
                   value="<?= isset($_POST['index2']) ? $_POST['index2'] : '' ?>">
            <button type="submit">Создать файлы статей!</button>
        </fieldset>
    </form>

<?php else: ?>
    <p>В БД пока нет ни одной статьи...</p>
<?php endif; ?>

</body>
</html>