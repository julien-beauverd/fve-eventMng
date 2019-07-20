$(document).ready(function () {

    if ($(window).width() >= 992) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
    } else {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").addClass("toggled");
    }
    if ($(window).width() < 992) {
        document.getElementById('logo').style.display = 'none';

    } else {
        document.getElementById('logo').style.display = 'flex';
    };
    // Toggle the side navigation
    $("#sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {};
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 992) {
            $(".sidebar").addClass("toggled");
            document.getElementById('logo').style.display = 'none';
        };
        if ($(window).width() >= 992) {
            $("body").removeClass("sidebar-toggled");
            $(".sidebar").removeClass("toggled");
            document.getElementById('logo').style.display = 'flex';
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 992) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

    $(document).on('click', '#addTopic', function (e) {
        var select = document.getElementById('parent');
        if (select.querySelector('#topicCount').value < 35) {
            select.childNodes[select.querySelector('#topicCount').value].childNodes[1].childNodes[1].childNodes[3].required = true;
            select.childNodes[select.querySelector('#topicCount').value].childNodes[3].childNodes[1].childNodes[3].required = true;
            select.childNodes[select.querySelector('#topicCount').value].style.display = '';
            select.querySelector('#topicCount').value++;
            select.querySelector('#topicCount').value++;
            select.querySelector('#topicNumber').value++;
        } else {
            var topic = document.getElementById("template");
            var newTopic = topic.cloneNode(true);
            newTopic.style.cssText = '';
            newTopic.id = "";
            select.querySelector('#topicNumber').value++;
            newTopic.querySelector("#time_topic").name = "time_topic_" + (select.querySelector('#topicNumber').value + 1);
            newTopic.querySelector("#time_topic").id = "time_topic_" + select.querySelector('#topicNumber').value;
            newTopic.querySelector("#title_topic").name = "title_topic_" + select.querySelector('#topicNumber').value;
            newTopic.querySelector("#title_topic").id = "title_topic_" + select.querySelector('#topicNumber').value;
            newTopic.querySelector("#speaker_topic").name = "speaker_topic_" + select.querySelector('#topicNumber').value;
            newTopic.querySelector("#speaker_topic").id = "speaker_topic_" + select.querySelector('#topicNumber').value;
            newTopic.querySelector("#description_topic").name = "description_topic_" + select.querySelector('#topicNumber').value;
            newTopic.querySelector("#description_topic").id = "description_topic_" + select.querySelector('#topicNumber').value;
            
            select.appendChild(newTopic);
            select.querySelector('#topicCount').value++;
            select.querySelector('#topicCount').value++;
        }
    });

    $(document).on('click', '#removeTopic', function (e) {
        var select = document.getElementById('parent');
        if (select.querySelector('#topicCount').value > 7) {
            select.querySelector('#topicCount').value--;
            select.querySelector('#topicCount').value--;
            select.querySelector('#topicNumber').value--;
            select.childNodes[select.querySelector('#topicCount').value].style.display = 'none';
            select.childNodes[select.querySelector('#topicCount').value].childNodes[1].childNodes[1].childNodes[3].required = false;
            select.childNodes[select.querySelector('#topicCount').value].childNodes[3].childNodes[1].childNodes[3].required = false;
        }
    });

});
