$(document).ready(function(){

    $("#note_type").change(function(){
        $("#error_text").empty();
        var selected = $(this).val();
        console.log(selected);
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
        $.ajax({
            url: '/src/php/authorization.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response === "authorized") {
                    document.location.href='/src/pages/add_entities.html'
                } else {
                    $("#error_text").empty().append(response).css("display", "block");
                }
            },
            error: function (response) {
                alert("Ошибка сервера " + response.status);
            }
        });
    });
    $("#entities_form").submit(function (event) {
        event.preventDefault();
        var quantity = $("input").val();
        if (quantity < 0 || quantity > 10000) {
            $("#error_text").empty().append("Введите верное количество").css("display", "block");
        } else {
            $.ajax({
                url: '/src/php/add_entities.php',
                data: $(this).serialize(),
                success: function (response) {
                    var note = quantity + ' сущностей каждого типа добавлено';
                    setTimeout(function(){
                        alert(note);
                        document.location.href='/src/pages/event_add.html';
                    }, 3000);
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
            $("#error_text").empty().append("Введите номер телефона").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/php/phone_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    setTimeout(function(){
                        alert(note);
                        document.location.href='/src/pages/task_add.html';
                    }, 3000);
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
            $("#error_text").empty().append("Введите ID сущности").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/php/note_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    setTimeout(function(){
                        alert(response);
                        document.location.href='/src/pages/task_add.html';
                    }, 3000);
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
    $("#task_form").submit(function (event) {
        event.preventDefault();
        if (!$(".input_id").val()) {
            $("#error_text").empty().append("Введите ID сущности").css("display", "block");
        } else {
            $("#error_text").empty();
            $.ajax({
                url: '/src/php/note_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    setTimeout(function(){
                        alert(response);
                        document.location.href='/src/pages/task_add.html';
                    }, 3000);
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });

});
