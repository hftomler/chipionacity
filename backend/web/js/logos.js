$(document).ready(function() {
    var folder = "imagenes/logos/";
    $.ajax({
        url : folder,
        success: function (data) {
            $(data).find("a").attr("href", function (i, val) {
                if( val.match(/\.(jpe?g|png|gif)$/) ) {
                    $("#titulo").after ("<div id=" + i + " class='col-xs-6'>");
                    $("#" +  i).append( "<img src='"+ folder + val +"' class='swLogoHomeft'>" );
                    $("#" +  i).append( "<br>" );
                    $("#" +  i).append("<p class='text-center'>" + val + "</p>");
                    $("#" +  i).click(function () {
                        //alert($(this).children('img').attr('src'));
                        window.opener.document.getElementById("valueLogo").value = $(this).children('img').attr('src');
                        window.opener.$("#valueLogo").trigger("change");
                        window.close();
                    })
                }
            });
        }
    });
});
