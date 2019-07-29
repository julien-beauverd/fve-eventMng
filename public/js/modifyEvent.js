window.onload = function () {
    createProgram();
    detectIfeventOK();
};

$(document).ready(function () {

    //if the user click to add a banner, it shows the input that was disabled
    $(document).on('click', '#addBanner', function (e) {
        var btnBanner = document.getElementById('inputImg');
        var dimensionBanner = document.getElementById("dimensionImg");
        var currentImg = document.getElementById('currentImg');
        var btnImg = document.getElementById('addBanner');
        currentImg.style.display = 'none';
        btnImg.style.display = 'none';
        btnBanner.style.display = '';
        btnBanner.childNodes[3].required = true;
        dimensionBanner.style.display = '';
        //assign the change bind to detect the size of the file
        $('#image').bind('change', function () {

            if (this.files.length != 0 && this.files[0].size >= '2097152') {

                $('#ModalImage').modal();
                $('#submitButton')[0].disabled = true;

            } else if (document.getElementById('document_1').files.length != 0 && document.getElementById('document_1').files[0].size < '8388608') {
                $('#submitButton')[0].disabled = false;
            }
        });
    });

    //if the user click to add a document, it creates a input from a template and add a unique id
    $(document).on('click', '#addDocument', function (e) {
        var select = document.getElementById('DocumentParent');
        var inputDoc = document.getElementById("documentTemplate");
        var newDocument = inputDoc.cloneNode(true);
        newDocument.style.cssText = '';
        newDocument.id = "";
        select.querySelector('#docCount').value++;
        newDocument.querySelector("#document").name = "document_" + (select.querySelector('#docCount').value);
        newDocument.querySelector("#document").id = "document_" + (select.querySelector('#docCount').value);
        let idDoc = "document_" + (select.querySelector('#docCount').value);
        select.appendChild(newDocument);
        let inputFile = document.getElementById(idDoc);

        $(inputFile).bind('change', function () {

            if (inputFile.files.length != 0 && inputFile.files[0].size >= '8388608') {

                $('#ModalDocument').modal();
                $('#submitButton')[0].disabled = true;

            } else {
                $('#submitButton')[0].disabled = false;
            }
        });
    });

    //if the user click to delete the doc, the value of the input switch to 1
    $(document).on('click', '.btn-doc', function (e) {
        var idDocToDelete = 'delDoc_' + e.target.id;
        e.target.parentNode.style.display = 'none';
        var inputDocToDelete = document.getElementById(idDocToDelete);
        inputDocToDelete.value = 1;
    });

    //test if the time input is sorted by time 
    $("#time_topic_2").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_1').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_2").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_1').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_3").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_2').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_3").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_2').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_4").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_3').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_4").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_3').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })
    $("#time_topic_5").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_4').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_5").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_4').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_6").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_5').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_6").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_5').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_7").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_6').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_7").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_6').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_8").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_7').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_8").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_7').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_9").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_8').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_9").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_8').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_10").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_9').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_10").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_9').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    $("#time_topic_11").on("change keyup paste", function () {

        if (this.value > document.getElementById('time_topic_10').value) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('errorTime').style.display = 'none';
        }
    })
    $("#time_topic_11").on("focusout", function () {

        if (this.value <= document.getElementById('time_topic_10').value) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('errorTime').style.display = 'flex';
        }
    })

    //test if the zip code is OK
    $("#zip_code").on("change keyup paste", function () {

        if (this.value.length == 4) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
        }
    })
    $("#zip_code").on("focusout", function () {

        if (this.value.length != 4) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
        }
    })

    //test if the date is on the future
    $("#date").on("change keyup paste", function () {

        console.log(this.style.color)
        if (this.value >= moment().format("YYYY-MM-DD")) {
            this.style.backgroundColor = '#FFFFFF';
            this.style.color = "#495057";
            document.getElementById('pastEvent').style.display = 'none';
        }
    })
    $("#date").on("focusout", function () {

        if (this.value < moment().format("YYYY-MM-DD")) {
            this.style.backgroundColor = '#dc3545';
            this.style.color = "#FFFFFF";
            document.getElementById('pastEvent').style.display = 'flex';
        }
    })
});

//create the program if the event has already topics
function createProgram() {
    var topicCount = document.getElementById('topicCount');
    var topicNumber = document.getElementById('topicNumber');
    if (topicNumber.value == "") {
        topicNumber.value = "3";
        topicCount.value = "11";
    } else {
        var select = document.getElementById('parent');
        var count = 11;
        if (topicCount.value >= 11) {
            while (count < topicCount.value) {
                select.childNodes[count].childNodes[1].childNodes[1].childNodes[3].required = true;
                select.childNodes[count].childNodes[3].childNodes[1].childNodes[3].required = true;
                select.childNodes[count].style.display = '';
                count++;
                count++;
            }
        } else {
            while (count >= topicCount.value) {
                select.childNodes[count].childNodes[1].childNodes[1].childNodes[3].required = false;
                select.childNodes[count].childNodes[3].childNodes[1].childNodes[3].required = false;
                select.childNodes[count].style.display = 'none';
                count--;
                count--;
            }
        }

    }
}


function detectIfeventOK() {
    var topicCount = document.getElementById('eventOK');
    if (topicCount.innerHTML.indexOf("OK") !== -1) {
        $("#Modalevent").modal();
    }
}
