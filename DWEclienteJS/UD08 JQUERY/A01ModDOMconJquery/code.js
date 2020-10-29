$(document).ready(function(){

    $("#esconder").click(function(){
        $("article").hide();
    })
    $("#enseno").click(function(){
        $("article").show();
    })
    $("#anado").click(function(){
        $("section").append("<article>Esto es un article dentro de section<br></article>");
    })
    $("#quitp").click(function(){
        $("article: last-child").remuve();
    })
    
});