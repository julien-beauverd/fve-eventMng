$(document).ready(function () {

    //switch the content of the bloc if the admin click on allmembers or specificEvent
    $(document).on('click', '#allMembers', function (e) {
        $("#allMembers").attr('class', 'btn btn-success');
        $("#specificEvent").attr('class', 'btn btn-outline-success');
        $('#selectEvent').css('display', 'none');
        document.getElementById('mailType').value = 'all';
        document.getElementById('titleSelect').style.display = 'none';
    });

    $(document).on('click', '#specificEvent', function (e) {
        $("#allMembers").attr('class', 'btn btn-outline-success');
        $("#specificEvent").attr('class', 'btn btn-success');
        $('#selectEvent').css('display', 'flex');
        document.getElementById('mailType').value = 'specific';
        document.getElementById('titleSelect').style.display = 'flex';
    });
});

window.onload = function () {
    detectIfmailOK();
};

//if the mail was correctly sent, a pop-up appear 
function detectIfmailOK() {
    var topicCount = document.getElementById('mailOK');
    if (topicCount.innerHTML.indexOf("OK") !== -1) {
        $("#ModalMail").modal();
    }
}