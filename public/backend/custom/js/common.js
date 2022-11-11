/* global notie, full_path, grecaptcha */
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #4179eb;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

$(document).ready(function () {
    $(document).on('change','#cat',function () {
        var link = $(this).find(':selected').attr('data-href');
        if(link != "")
        {
          $('#subcat').load(link);
          $('#subcat').prop('disabled',false);
        }
      });
});
function error_msg(msg) {
    notie.alert({
        type: 'error',
        text: '<i class="fa fa-times"></i> ' + msg,
        time: 3
    });
}
function success_msg(msg) {
    notie.alert({
        type: 'success',
        text: '<i class="fa fa-check"></i> ' + msg,
        time: 3
    });
}
function loader_start() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #3c8dbc;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}
function loader_stop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

var $ = jQuery;
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#scroll_top').show();
        } else {
            $('#scroll_top').hide();
        }
    });
    $('#scroll_top').click(function () {
        $("html, body").animate({scrollTop: 0}, 1500);
        return false;
    });

    $(".cust-scroll-table").niceScroll({touchbehavior: false, cursorcolor: "#439DD1", cursoropacitymax: 0.7, cursorwidth: 5, background: "#fff", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
    $(window).scroll(function () {
        $(".cust-scroll-table").getNiceScroll().resize();
    });
    $(window).resize(function () {
        $(".cust-scroll-table").getNiceScroll().resize();
    });
    var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#439DD1", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
    $(window).scroll(function () {
        $(".field-scroll").getNiceScroll().resize();
    });
    $(window).resize(function () {
        $(".field-scroll").getNiceScroll().resize();
    });

    $("#sidebarToggle").on('click', function (e) {
        e.preventDefault();
        $("body").toggleClass("sidebar-toggled");
        $(".user-dash-right").toggleClass("slide-right-side");
        $(".user-left-side").toggleClass("toggled");
    });
    $("#MobilesidebarToggle").click(function () {
        $(".mobile-menu-link").toggle('2000');
    });

    $("#nav-toggle_two").click(function () {
        $(".search_on_two").slideToggle('slow');
        $("#navigation-icon_two").toggle();
        $("#times-icon_two").toggle();
    });
    $('.accordion-menu').click(function () {
        $(this).find('.submenu').slideToggle('slow');
    });
    $('.accordion-menu').click(function () {
        //$('.header-nav-item').removeClass('openmenu');
        //$('.dropdown-menu').hide();
        var menusection = $(this).attr('data-section');
        if ($(this).hasClass('openmenu')) {
            $(this).removeClass('openmenu');
            //$('#' + menusection).hide();
        } else {
            //$('#' + menusection).show();
            $(this).addClass('openmenu');

        }
        $('#' + menusection).slideToggle('slow');
    });
    
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}


$(function () {

    // We can attach the `fileselect` event to all file inputs on the page
    $(document).on('change', ':file', function () {
        var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    // We can watch for our custom `fileselect` event like this
    $(document).ready(function () {
        $(':file').on('fileselect', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) {
//
                }
            }

        });
    });

    $('.btn-next').click(function () {
        $(this).closest('.screen').removeClass('active');
        $(this).closest('.screen').next().addClass('active');
    });
    $('.btn-back').click(function () {
        $(this).closest('.screen').removeClass('active');
        $(this).closest('.screen').prev().addClass('active');
    });
    $('.prev').click(function () {
        $(this).closest('.screen').removeClass('active');
        $(this).closest('.screen').prev().addClass('active');
    });
    $(".js-example-basic-multiple").select2();
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Pick services*"

    });

});

$(document).on('submit', '#add-product-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                success_msg(resp.msg);
                $('#add-product-form')[0].reset();
                setTimeout(function () {
                    window.location.href = resp.link;
                }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    if (key === 'image') {
                        $("#add-product-form").find("#error_image").html(val[0]);
                        $("#add-product-form").find("#error_image").closest('.form-group').addClass('has-error');
                    }
                    $("#add-product-form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#add-product-form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        })
    });



function deleteUser(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete User',
        content: 'Are you sure to Delete this User?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#users-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}
function deleteCategory(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Category',
        content: 'Are you sure to Delete this Category',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#category-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}
function deleteSubCategory(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Subcategory',
        content: 'Are you sure to Delete this Subcategory',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#subcategory-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}
function deleteBlog(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Blog',
        content: 'Are you sure to Delete this Blog',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#blog-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}
function deleteSlider(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Slider',
        content: 'Are you sure to Delete this Slider',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#slider-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}
function deleteCourse(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Course',
        content: 'Are you sure to Delete this Course',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#course-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}

function deleteCourseWeek(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Course Week',
        content: 'Are you sure to Delete this Course Week',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#course-week-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}

function deleteCourseWeekLesson(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Course Week Lesson',
        content: 'Are you sure to Delete this Course Week Lesson',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#course-week-lessons-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}

function deleteCourseWeekLessonChapter(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Course Week Lesson Chapter',
        content: 'Are you sure to Delete this Course Week Lesson Chapter',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#course-week-lessons-chapter-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}

function deleteCourseWeekLessonChapterTopic(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Course Week Lesson Chapter Topic',
        content: 'Are you sure to Delete this Course Week Lesson Chapter Topic',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#course-week-lessons-chapter-topic-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}

function deleteTestimonial(obj) {
    var url = $(obj).data('href');
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.confirm({
        title: 'Delete Testimonial',
        content: 'Are you sure to Delete this Testimonial',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: {
                text: '<i class="fa fa-check" aria-hidden="true"></i> Confirm',
                btnClass: 'btn-red',
                action: function () {
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        dataType: 'json',
                        success: function (resp) {
                            if (resp.status && resp.status === 200) {
                                $('.page-content').prepend('<div class="alert alert-success mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');

                                $('#tesimonial-management').DataTable().ajax.reload();

                            } else {
                                $('.page-content').prepend('<div class="alert alert-danger mt-2"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                                        + '<span>' + resp.msg + '</span></div>');
                            }
                        }
                    });
                }
            },
            cancel: function () {}
        }
    });

}