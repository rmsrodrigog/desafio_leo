$(document).ready(function() 
{
    var swiper = new Swiper(".mySwiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination"
        }
    });

    var backPath = 'http://localhost/desafio_leo/backend/';

    document.getElementById('preview').src = backPath+'images/insert-image.png';

    $.getJSON( backPath + 'route/course.php', function(json) {
        var courseCard=[];
        for (var i = 0; i < json.length; i++) {
            courseCard.push("<div class='course-card'>");
            courseCard.push(`<div class='course-img'><img src="${backPath+/images/+json[i].imagem}" /></div>`);
            courseCard.push("<div class='course-desc'><h2>"+json[i].nome+"</h2><p>"+json[i].info+"</p></div>");
            courseCard.push("<div class='course-view-more'><button class='course-view-more-button'>VER CURSO</button></div>");
            courseCard.push("</div>"); 
        }
        $('#courses-grid').prepend($(courseCard.join('')));
    });
    
    $(document).delegate('#createCourse', 'click', function(event) {
        event.preventDefault();
        
        var nome = $('#nomeCurso').val();
        var info = $('#info').val();
        var novo = $('#novo').val();
        var background = $('#background-img').val();
        
        if(nome == null || nome == "") {
            alert("Campo nome é obrigatório");
            return;
        }

        if(info == null || info == "") {
            alert("Campo descrição é obrigatório");
            return;
        }

        if(novo == null || novo == "") {
            alert("Campo novo é obrigatório");
            return;
        }
        
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: backPath + "route/course.php",
            data: JSON.stringify({'nome': nome, 'info': info, 'novo': novo, 'imagem': background}),
            cache: false,
            success: function(result) {
                console.log(result);
                alert('Curso criado com sucesso');
                location.reload(true);
            },
            error: function(err) {
                alert(err);
            }
        });
    });
    
    // USUARIO ---------------------------------------------
    $(document).delegate('#createUser', 'click', function(event) {
        event.preventDefault();
        
        var nome = $('#nome').val();
        var email = $('#email').val();
        var usuario = $('#usuario').val();
        var senha = $('#senha').val();
        var imagem = $('#imagem').val();
        
        if(nome == null || nome == "") {
            alert("Campo nome é obrigatório");
            return;
        }

        if(email == null || email == "") {
            alert("Campo email é obrigatório");
            return;
        }

        if(usuario == null || usuario == "") {
            alert("Campo usuario é obrigatório");
            return;
        }

        if(senha == null || senha == "") {
            alert("Campo senha é obrigatório");
            return;
        }
        
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: backPath + "route/usuario.php",
            data: JSON.stringify({'nome': nome, 'email': email, 'usuario': usuario, 'senha': senha}),
            cache: false,
            success: function(result) {
                console.log(result);
                alert('Usuario criado com sucesso');
                location.reload(true);
            },
            error: function(err) {
                alert(err);
            }
        });
    });

    $(document).delegate('#loginUser', 'click', function(event) {
        event.preventDefault();
        
        var usuarioLogin = $('#usuarioLogin').val();
        var senhaLogin = $('#senhaLogin').val();
        
        if(usuarioLogin == null || usuarioLogin == "") {
            alert("Campo Usuario é obrigatório");
            return;
        }

        if(senhaLogin == null || senhaLogin == "") {
            alert("Campo senha é obrigatório");
            return;
        }
        
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: backPath + "route/usuario.php?login=true",
            data: JSON.stringify({'usuario': usuarioLogin, 'senha': senhaLogin}),
            cache: false,
            success: function(result) {
                console.log(result);
                if(result != false) {
                    alert('Bem-vindo');
                    location.reload(true);
                }else{
                    alert('Usuario ou senha incorretos');  
                }
            },
            error: function(err) {
                alert(err);
            }
        });
    });

    /*$(document).delegate('.delete', 'click', function() { 
        if (confirm('Do you really want to delete record?')) {
            var id = $(this).attr('id');
            var parent = $(this).parent().parent();
            $.ajax({
                type: "DELETE",
                url: "http://localhost/php-ajax-jquery-mysql-crud/delete.php?id=" + id,
                cache: false,
                success: function() {
                    parent.fadeOut('slow', function() {
                        $(this).remove();
                    });
                    location.reload(true)
                },
                error: function() {
                    alert('Error deleting record');
                }
            });
        }
    });
    
    $(document).delegate('.edit', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(3)");
        
        name.html("<input type='text' id='txtName' value='" + name.html() + "'/>");
        buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
    });
    
    $(document).delegate('#save', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(3)");
        
        $.ajax({
            type: "PUT",
            contentType: "application/json; charset=utf-8",
            url: "http://localhost/php-ajax-jquery-mysql-crud/update.php",
            data: JSON.stringify({'id' : id.html(), 'name' : name.children("input[type=text]").val()}),
            cache: false,
            success: function() {
                name.html(name.children("input[type=text]").val());
                buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
            },
            error: function() {
                alert('Error updating record');
            }
        });
    });*/

    $("#hide").click(function(){
        $("p").hide();
    });
    
    $("#show").click(function(){
        $("p").show();
    });

});
