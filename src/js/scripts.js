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
                    $("#error_text").empty();
                    $("#error_text").append(response).css("display", "block");
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
            $("#error_text").empty();
            $("#error_text").append("Введите верное количество").css("display", "block");
        } else {
            $.ajax({
                url: '/src/php/add_entities.php',
                data: $(this).serialize(),
                success: function (response) {
                    // document.location.href='/src/pages/add_entities.html';
                },
                error: function (response) {
                    alert("Ошибка сервера " + response.status);
                }
            })
        }
    })
});
