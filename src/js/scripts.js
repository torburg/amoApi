$(document).ready(function(){

    $("#note_type").change(function(){
        $("#error_text").empty();
        var selected = $(this).val();
        if (selected === '4') {
            $('#call_form').hide();
            $('#note_form').show();
        }
        if (selected === '6'){
            $('#note_form').hide();
            $('#call_form').show();
        }
    });

    $("#auth_form").submit(function(event){
        event.preventDefault();
        var login = $("#login").val();
        var password = $("#password").val();
        if (!login || !password) {
            $("#error_text").show().text('Введите логин и пароль.');
        } else {
            $.ajax({
                url: '/src/handlers/authorization.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response === "authorized") {
                        document.location.href='/src/pages/entities_add.php'
                    } else {
                        $("#error_text").empty().append(response).css("display", "block");
                    }
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            });
        }
    });
    $("#entities_form").submit(function (event) {
        event.preventDefault();
        var quantity = parseInt($("input").val());
        if (isNaN(quantity) || quantity <= 0 || quantity > 10000) {
            $("#error_text").text("Введите верное количество").css("display", "block");
        } else {
            $("#error_text").hide();
            $("#submit").hide();
            $("#loading").show();
            $.ajax({
                url: '/src/handlers/entities_add.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    $("#loading").hide();
                    var note = quantity + ' сущностей каждого типа добавлено';
                    alert(note);
                    document.location.href='/src/pages/field_changing.php';
                },
                error: function (response) {
                    $("#loading").hide();
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
    $("#field_form").submit(function (event) {
        event.preventDefault();
        var id = parseInt($(".input_id").val());
        if (isNaN(id)) {
            $("#error_text").text("Введите цифровой ID элемента").css("display", "block");
        } else if (id <= 0) {
            $("#error_text").text("Введите положительный ID элемента").css("display", "block");
        } else if (!$(".input_text").val()) {
            $("#error_text").text("Введите значение поля").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/handlers/field_changing.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    if (response === "Значение поля обновлено") {
                        alert(response);
                        document.location.href='/src/pages/event_add.php';
                    } else {
                        alert(response);
                    }
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
    $("#note_form").submit(function (event) {
        event.preventDefault();
        if (!$(".input_id").val()) {
            $("#error_text").text("Введите ID сущности").css("display", "block");
        } else if (!$(".input_text").val()) {
            $("#error_text").text("Введите текст примечания").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/handlers/note_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    alert(response);
                    if (response === 'Ваше примечание добавлено') {
                        document.location.href='/src/pages/task_add.php';
                    }
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
    $("#call_form").submit(function(event) {
        event.preventDefault(event);
        if (!$(".input_phone").val()) {
            $("#error_text").text("Введите номер телефона").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/handlers/phone_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    alert(response);
                    if (!(response === 'Required field missed phone_number')) {
                        document.location.href='/src/pages/task_add.php';
                    }
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }

    });
    $("#task_form").submit(function (event) {
        event.preventDefault();
        var current_date = new Date();
        var task_date = new Date(Date.parse($(".date").val()));
        if (!$(".input_id").val()) {
            $("#error_text").text("Введите ID сущности").css("display", "block");
        } else if (!$(".date").val() || current_date > task_date) {
            $("#error_text").text("Введите корректную дату").css("display", "block");
        } else if (!$(".responsible_user_id").val()) {
            $("#error_text").text("Введите ответственного пользователя").css("display", "block");
        } else if (!$(".input_text").val()) {
            $("#error_text").text("Введите текст задачи").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/handlers/task_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    alert(response);
                    if (response === "Задача добавлена") {
                        document.location.href='/src/pages/task_close.php';
                    }
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
    $("#task_close_form").submit(function (event) {
        event.preventDefault();
        if (!$(".input").val()) {
            $("#error_text").text("Введите ID задачи").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/handlers/task_close.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    alert(response);
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
});
