$(document).ready(function(){

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
                        document.location.href='/src/pages/note_add.html';
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
            console.log('adwwdw');
            $("#error_text").empty();/*.append("Введите ID сущности").css("display", "block");*/
        } else {
            $.ajax({
                url: '/src/php/note_add.php',
                data: $(this).serialize(),
                method: 'POST',
                success: function (response) {
                    console.log(response);
                    alert(response);
                    // var note = quantity + ' сущностей каждого типа добавлено';
                    // setTimeout(function(){
                    //     alert(note);
                    //     document.location.href='/src/pages/note_add.html';
                    // }, 3000);
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    });
});
