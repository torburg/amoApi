<?php if(!file_exists($_SERVER['DOCUMENT_ROOT'] . '/cookie.txt')) {
    header('Location: /src/pages/authorization.php');
}; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление поля</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/src/js/scripts.js"></script>
<body>
<div class="container">
    <h1>Изменение значения поля</h1>
    <span id="error_text"></span>
    <form id="field_form">
        <div class="field_block">
            <div class="input entity_id">
                <input type="text" name="element_id" class="input_id" placeholder="Введите ID элемента">
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
            <div class="input note_text">
                <textarea name="field_text" class="input_text" placeholder="Значение поля" autocomplete="off"></textarea>
            </div>
        </div>
        <input type="submit" class="submit" value="Изменить поле">
    </form>
</div>
</body>
</html>