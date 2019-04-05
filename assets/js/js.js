$(document).ready(function(){
    $( ".clickbutton" ).on( "click", function() {
        var titelName = $(this).attr("value");
        $('.modal-content .respondModalInput').val(titelName);
    });
});