<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Articles Generator 1.0</title>

    <style>
        form {
            padding: 20px;
            background-color: #EEE;
        }
    </style>
</head>
<body>

<form action="save_form_data_to_db" method="post">

    <div class="form-group row">
        <label for="fileName" class="col-sm-2 col-form-label">File name: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control"
                   id="fileName" name="fileName"
                   readonly
                   placeholder="registratsiya-lekarstvennyh-sredstv-v-ukraine-registratsiya-lekarstv"
                   size="75" maxlength="256"
                   value="<?= isset($_POST['fileName']) ? $_POST['fileName'] : '' ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Title: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control"
                   id="title" name="title"
                   placeholder="Регистрация лекарственных средств в Украине, регистрация лекарств"
                   size="75" maxlength="200"
                   value="<?= isset($_POST['title']) ? $_POST['title'] : '' ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">Description: </label>
        <div class="col-sm-10">
        <textarea name="description" class="form-control"
                  id="description" cols="40" rows="10"
                  placeholder="В соответствии с Законом Украины «О лекарственных средствах» обращение лекарственных средств на территории Украины возможно только после прохождения процедуры государственной регистрации."
                  maxlength="500"><?= isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="h1" class="col-sm-2 col-form-label">H1: </label>
        <div class="col-sm-10">
            <input type="text" class="form-control"
                   id="h1" name="h1"
                   placeholder="Государственная регистрация лекарственных средств в Украине"
                   size="60" maxlength="200"
                   value="<?= isset($_POST['h1']) ? $_POST['h1'] : '' ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="text" class="col-sm-2 col-form-label">Text: </label>
        <div class="col-sm-10">
        <textarea name="text" class="form-control"
                  id="text" cols="40"
                  rows="10"><?= isset($_POST['text']) ? $_POST['text'] : '' ?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2"></div>
        <div class="form-check">
            <div class="col-sm-12">
                <input class="form-check-input" type="checkbox" value="" id="showPlaceholders"
                       checked
                       name="showPlaceholders">
                <label class="form-check-label" for="showPlaceholders">
                    show placeholders
                </label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success btn-lg btn-primary"
                    name="submit" id="submit">Add article to DB
            </button>
        </div>

        <div class="col-sm-4 text-center">
            <a onclick="return false" href="http://add-articles/create">
                <button type="button" class="btn btn-secondary btn-lg"
                        name="submit" id="createArticlesFromDB">Create new article(s) from DB
                </button>
            </a>
        </div>

        <div class="col-sm-3">
            <button type="reset" class="btn btn-danger btn-lg float-right"
                    name="reset" id="reset">Clear form
            </button>
        </div>
    </div>

</form>

<script>

    document.getElementById('title').oninput = function () {
            let text = document.getElementById('title').value;
            let transl = [];

            // укр. алфавит
            transl['Ґ'] = 'g';
            transl['Є'] = 'Ie';
            transl['є'] = 'a';
            transl['І'] = 'I';
            transl['і'] = 'i';
            transl['Ї'] = 'I';
            transl['ї'] = 'i';

            // рус. алфавит
            transl['А'] = 'a';
            transl['а'] = 'a';
            transl['Б'] = 'b';
            transl['б'] = 'b';
            transl['В'] = 'v';
            transl['в'] = 'v';
            transl['Г'] = 'g';
            transl['г'] = 'g';
            transl['Д'] = 'd';
            transl['д'] = 'd';
            transl['Е'] = 'e';
            transl['е'] = 'e';
            transl['Ё'] = 'yo';
            transl['ё'] = 'yo';
            transl['Ж'] = 'zh';
            transl['ж'] = 'zh';
            transl['З'] = 'z';
            transl['з'] = 'z';
            transl['И'] = 'i';
            transl['и'] = 'i';
            transl['Й'] = 'j';
            transl['й'] = 'j';
            transl['К'] = 'k';
            transl['к'] = 'k';
            transl['Л'] = 'l';
            transl['л'] = 'l';
            transl['М'] = 'm';
            transl['м'] = 'm';
            transl['Н'] = 'n';
            transl['н'] = 'n';
            transl['О'] = 'o';
            transl['о'] = 'o';
            transl['П'] = 'p';
            transl['п'] = 'p';
            transl['Р'] = 'r';
            transl['р'] = 'r';
            transl['С'] = 's';
            transl['с'] = 's';
            transl['Т'] = 't';
            transl['т'] = 't';
            transl['У'] = 'u';
            transl['у'] = 'u';
            transl['Ф'] = 'f';
            transl['ф'] = 'f';
            transl['Х'] = 'h';
            transl['х'] = 'h';
            transl['Ц'] = 'ts';
            transl['ц'] = 'ts';
            transl['Ч'] = 'ch';
            transl['ч'] = 'ch';
            transl['Ш'] = 'sh';
            transl['ш'] = 'sh';
            transl['Щ'] = 'sch';
            transl['щ'] = 'sch';
            transl['Ъ'] = '';
            transl['ъ'] = '';
            transl['Ь'] = '';
            transl['ь'] = '';
            transl['Ы'] = 'y';
            transl['ы'] = 'y';
            transl['Э'] = 'e';
            transl['э'] = 'e';
            transl['Ю'] = 'yu';
            transl['ю'] = 'yu';
            transl['Я'] = 'ya';
            transl['я'] = 'ya';
            transl[' '] = '-';

            transl['A'] = 'a';
            transl['N'] = 'n';
            transl['B'] = 'b';
            transl['O'] = 'o';
            transl['C'] = 'c';
            transl['P'] = 'p';
            transl['D'] = 'd';
            transl['Q'] = 'q';
            transl['E'] = 'e';
            transl['R'] = 'r';
            transl['F'] = 'f';
            transl['S'] = 's';
            transl['G'] = 'g';
            transl['T'] = 't';
            transl['H'] = 'h';
            transl['U'] = 'u';
            transl['I'] = 'i';
            transl['V'] = 'v';
            transl['J'] = 'j';
            transl['W'] = 'w';
            transl['K'] = 'k';
            transl['X'] = 'x';
            transl['L'] = 'l';
            transl['Y'] = 'y';
            transl['M'] = 'm';
            transl['Z'] = 'z';

            transl['.'] = '';
            transl[','] = '';
            transl['!'] = '';
            transl['?'] = '';
            transl[';'] = '';
            transl[':'] = '';
            transl['/'] = '';
            transl['_'] = '';
            transl['('] = '';
            transl[')'] = '';
            transl['-'] = '-';
            transl['"'] = '';

            let result = '';
            for (let i = 0; i < text.length; i++) {
                if (transl[text[i]] !== undefined) {
                    result += transl[text[i]];
                }
                else {
                    result += text[i];
                }
            }
            document.getElementById('fileName').value = result;
        };

        document.getElementById('createArticlesFromDB').onclick = function () {
            if ((document.getElementById('fileName').value !== '') ||
                (document.getElementById('title').value !== '') ||
                (document.getElementById('description').value !== '') ||
                (document.getElementById('h1').value !== '') ||
                (document.getElementById('text').value !== '')) {

                if (confirm('Form is not empty. Are you sure to go creating article(s) from DB?')) {
                    window.location.href = window.location.origin + '/create';
                    // window.open(window.location.origin + '/create', '_self');
                }
            }
            else {
                window.location.href = window.location.origin + '/create';
                // window.open(window.location.origin + '/create', '_self');
            }
        };

        document.getElementById('reset').onclick =
            function () {
                document.getElementById('fileName').setAttribute('value', '');
                document.getElementById('title').setAttribute('value', '');
                document.getElementById('description').innerText = '';
                document.getElementById('h1').setAttribute('value', '');
                document.getElementById('text').innerText = '';
            };

        document.getElementById('showPlaceholders').onchange =
            function () {
                if (document.getElementById('showPlaceholders').checked === true) {
                    document.getElementById('fileName').setAttribute('placeholder', 'registratsiya-lekarstvennyh-sredstv-v-ukraine-registratsiya-lekarstv');
                    document.getElementById('title').setAttribute('placeholder', 'Регистрация лекарственных средств в Украине, регистрация лекарств');
                    document.getElementById('description').setAttribute('placeholder', 'В соответствии с Законом Украины «О лекарственных средствах» обращение лекарственных средств на территории Украины возможно только после прохождения процедуры государственной регистрации.');
                    document.getElementById('h1').setAttribute('placeholder', 'Государственная регистрация лекарственных средств в Украине');
                    document.getElementById('text').setAttribute('placeholder', '');
                }
                else {
                    document.getElementById('fileName').setAttribute('placeholder', '');
                    document.getElementById('title').setAttribute('placeholder', '');
                    document.getElementById('description').setAttribute('placeholder', '');
                    document.getElementById('h1').setAttribute('placeholder', '');
                    document.getElementById('text').setAttribute('placeholder', '');
                }
            }
</script>
