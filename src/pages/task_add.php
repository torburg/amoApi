<?php if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/cookie.txt')) {
    header('Location: /src/pages/authorization.php');
}; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление задачи</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/src/js/scripts.js"></script>
</head>
<body>
<div class="container">
    <h1>Добавление задачи:</h1>
    <span id="error_text"></span>
    <form id="task_form">
        <div class="input entity_id">
            <input type="text" name="entity_id" class="input_id" placeholder="Введите ID элемента">
        </div>
        <div class="input entity_code">
            <p class="input_note">Тип сущности:</p>
            <select type="text" name="entity_code">
                <option value="1">Контакт</option>
                <option value="2">Сделка</option>
                <option value="3">Компания</option>
                <option value="12">Покупатель</option>
            </select>
        </div>
        <div class="input">
            <p>Дата завершения задачи:</p>
            <input type="date" class="date" name="complete_till_at" placeholder="Дата завершения задачи  ">
        </div>
        <div class="input">
            <input type="text" class="input responsible_user_id" name="responsible_user_id" placeholder="Введите ID ответственного">
        </div>
        <div class="input note_text">
            <textarea name="task_text" class="input_text" placeholder="Текст задачи" autocomplete="off"></textarea>
        </div>
        <input type="submit" class="submit" value="Добавить задачу">
    </form>
</div>
</body>
</html>