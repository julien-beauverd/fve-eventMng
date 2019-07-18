window.onload = function () {
    detectIfdocsOK();
};

$(document).ready(function () {

    $(document).on('click', '.btn-doc', function (e) {
        var idDocToDelete = 'delDoc_' + e.target.id;
        e.target.parentNode.parentNode.style.display = 'none';
        var inputDocToDelete = document.getElementById(idDocToDelete);
        inputDocToDelete.value = 1;
    });

    $(document).on('click', '#addDocument', function (e) {
        var select = document.getElementById('DocumentParent');
        var inputDoc = document.getElementById("documentTemplate");
        var newDocument = inputDoc.cloneNode(true);
        newDocument.style.cssText = '';
        newDocument.id = "";
        select.querySelector('#docCount').value++;
        newDocument.querySelector("#document").name = "document_" + (select.querySelector('#docCount').value);
        newDocument.querySelector("#document").id = "document_" + (select.querySelector('#docCount').value);
        newDocument.querySelector("#title_document").name = "title_document_" + (select.querySelector('#docCount').value);
        newDocument.querySelector("#title_document").id = "title_document_" + (select.querySelector('#docCount').value);
        newDocument.querySelector("#description_document").name = "description_document_" + (select.querySelector('#docCount').value);
        newDocument.querySelector("#description_document").id = "description_document_" + (select.querySelector('#docCount').value);
        select.appendChild(newDocument);
        let idDoc = "document_" + (select.querySelector('#docCount').value);
        let inputFile = document.getElementById(idDoc);
        $(inputFile).bind('change', function () {

            if (this.files.length != 0 && this.files[0].size >= '8388608') {

                $('#ModalDocument').modal();
                $('#submitButton')[0].disabled = true;

            } else {
                $('#submitButton')[0].disabled = false;
            }
        });
    });
});

function detectIfdocsOK() {
    var topicCount = document.getElementById('docsOK');
    if (topicCount.innerHTML.indexOf("OK") !== -1) {
        $("#Modaldocs").modal();
    }
}
