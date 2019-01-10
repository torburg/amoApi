<?php if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/cookie.txt')) {
    header('Location: /src/pages/authorization.php');
}; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Закрытие задачи</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/src/js/scripts.js"></script>
</head>
<body>
    <h1>Закрытие задачи</h1>
    <span id="error_text"></span>
    <form id="task_close_form">
        <div class="container_input">
            <input type="text" name="task_id" class="input" placeholder="Введите ID задачи для закрытия"/>
        </div>
        <input type="submit" class="submit" id="submit" value="Закрыть">
    </form>
</body>
</html>