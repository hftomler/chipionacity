$(document).ready(function() {
    var folder = "imagenes/imgAva/";
    $.ajax({
        url : folder,
        success: function (data) {
            $(data).find("a").attr("href", function (i, val) {
                if( val.match(/\.(jpe?g|png|gif)$/) ) {
                    $("#titulo").after ("<div id=" + i + " class='col-md-2 col-sm-3 col-xs-4'>");
                    $("#" +  i).append( "<img src='"+ folder + val +"' class='img-circle imgPerfil-sm'>" );
                    $("#" +  i).append( "<br>" );
                    $("#" +  i).append("<p>" + val + "</p>");
                    $("#" +  i).click(function () {
                        //alert($(this).children('img').attr('src'));
                        window.opener.document.getElementById("valueAvatar").value = $(this).children('img').attr('src');
                        window.opener.$("#valueAvatar").trigger("change");
                        window.close();
                    })
                }
            });
        }
    });
});
