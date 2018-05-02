$("html").bind("mouseleave", function () {
    $('#mdl_saindo').modal('show');
    $("html").unbind("mouseleave");
});