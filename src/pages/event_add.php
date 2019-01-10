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
    <h1>Добавление примечания</h1>
    <span id="error_text"></span>
    <div class="input note_type">
        <p class="input_note">Тип примечания:</p>
        <select type="text" id="note_type" autocomplete="off">
            <option value="4">Обычное примечание</option>
            <option value="6">Входяший звонок</option>
        </select>
    </div>
    <form id="note_form">
        <div class="note_block">
            <div class="input entity_id">
                <input type="text" name="entity_id" class="input_id" placeholder="Введите ID сущности">
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
            <textarea name="note_text" class="input_text" placeholder="Текст заметки" autocomplete="off"></textarea>
        </div>
        </div>
        <input type="submit" class="submit" value="Добавить примечание">
    </form>
    <form id="call_form">
        <div class="phone_block">
            <input class="input_phone" type="tel" name="phone_number" placeholder="Введите номер телефона">
            <div class="input call_status">
                <select type="text" name="call_status">
                    <option value="1">Оставил голосовое сообщение</option>
                    <option value="2">Перезвонить позже</option>
                    <option value="4">Разговор состоялся</option>
                </select>
            </div>
            <textarea name="note_text" class="input" placeholder="Результат звонка"></textarea>
        </div>
        <input type="submit" class="submit" value="Добавить звонок">
    </form>

</div>
</body>


</html>