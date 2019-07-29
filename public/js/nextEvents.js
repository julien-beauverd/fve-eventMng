$(document).ready(function () {

    //open the popover if the user click on the button
    $("html").on("mouseup", function (e) {
        var l = $(e.target);
        if (l[0].className != 'btn btn-success btn-circle p-1') {
            $(".popover").each(function () {
                $(this).popover("hide");
            });
        }
        $('[data-toggle="popover-'+e.target.id+'"]').popover({
            html: true,
            content: function () {
                
                return $('#popover-content-'+e.target.id+'').html();
            }
        });
    });
});


window.onload = function () {
    createPopover();
};

//create popover
function createPopover() {
    var select = document.getElementById('parent');
    var count = 1;
    for (i = 3; i < select.childNodes.length; i++) {
        select.childNodes[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1].childNodes[5].attributes[2].value = 'popover-' + count;
        select.childNodes[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1].childNodes[3].id = 'popover-content-' + count;
        select.childNodes[i].childNodes[1].childNodes[1].childNodes[1].childNodes[1].childNodes[5].childNodes[1].id = count;
        count++;
        i++;
    }
}
