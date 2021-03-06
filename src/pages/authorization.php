<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/src/js/scripts.js"></script>
</head>
<body>
<div class="container">
    <span id="error_text"></span>
    <form id="auth_form" method="post">
            <div class="container_input">
                <input type="text" id="login" name="login" class="input" placeholder="Введите логин"/>
                <input type="password" id="password" name="password" class="input" placeholder="Введите ключ пользователя"/>
            </div>
            <input type="submit" class="submit" value="Войти">
        </form>
    </div>
</body>
</html>
