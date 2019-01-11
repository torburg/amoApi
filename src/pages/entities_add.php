<?php if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/cookie.txt')) {
    header('Location: /src/pages/authorization.php');
}; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление сущности</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/src/js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Добавление сущностей:</h1>
        <span id="error_text"></span>
        <form id="entities_form">
            <div class="container_input">
                <input type="text" name="count" class="input" placeholder="Введите количество создаваемых сущностей (от 1 до 10000)"/>
            </div>
            <img id="loading" src="/src/images/loading.gif" />
            <input type="submit" class="submit" id="submit" value="Создать">
        </form>
    </div>
</body>
</html>