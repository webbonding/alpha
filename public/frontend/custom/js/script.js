/* global full_path */

// window height //
var currentRequest = null;
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none;"><div><img style="font-size: 46px;color: #B40B2B;" src="' + full_path + 'public/frontend/images/Loader.gif" class="" aria-hidden="true"></div><div class="bg"></div></div>');
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
        'height': '210px',
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

function success_msg(msg) {
    $.iaoAlert({
        type: "success",
        position: "top-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "3000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
    });
}
function  error_msg(msg) {
    $.iaoAlert({
        type: "error",
        position: "top-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "3000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
    });
}

$(document).ready(function () {

    $('#signup-form').submit(function (event) {
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
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                    zIndex: '9999'
                });
                $('#signup-form')[0].reset();
                $('.modal').modal('hide');
//                $('#resend-activation-form').find('[name="id"]').val(resp.u_id);
//                $('#resend_activation_modal').modal('show');
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#login-form').submit(function (event) {
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
                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#forgot-form').submit(function (event) {
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
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $('#forgot-form')[0].reset();
                $('.modal').modal('hide');
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#er-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#reset-password-frm').submit(function (event) {
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
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $('#reset-password-frm')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#reset-password-frm").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#reset-password-frm").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#reset-password-form').submit(function (event) {
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
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $('.modal').modal('hide');
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#erro-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#check-out-form').submit(function (event) {
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
//                alert(1);
                // success_msg('Thank You');
                ajaxindicatorstop();
                window.location.href = resp.link;
                    // dopayment(resp.amount);
                

            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    

    $('#customer-editprofile-form').submit(function (event) {
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
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                ajaxindicatorstop();
//                window.location.href = resp.link;
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });

                ajaxindicatorstop();
            }
        });
    });

    $('.cart-form').submit(function (event) {
        // alert(1);
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        // var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: full_path + 'add-cart',
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            beforeSend: function () {
                if (currentRequest !== null) {
                    currentRequest.abort();
                }
            },
            success: function (resp) {
                if (resp.type === 1) {
                    $('.cart_count').html(resp.cart_count);
                    success_msg(resp.msg);
                } else {
                    error_msg(resp.msg);
                }
                ajaxindicatorstop();
            }
        });
    });


});
$(document).on('submit', '#contact-us-form', function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('');
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
            $('#contact-us-form')[0].reset();
            success_msg(resp.msg, 5000);
            ajaxindicatorstop();
        },
        error: function (resp) {
            $.each(resp.responseJSON.errors, function (key, val) {
                // $('#contact-us-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                // $('#contact-us-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
            });
            ajaxindicatorstop();
        }
    });
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function chooseImage(id) {
    $("#is_default").attr("value", id);
}


$(document).on("click", ".browse", function () {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});
$('input[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);
});

function change_picture()
{
    var file = $('#change_picture')[0].files[0];
    if (file.size > 2097152)
    {
        $("#progressOuter").hide();
        $("#progressBar").css("width", "0%");
        notie.alert({
            type: 'error',
            text: '<i class="fa fa-close"></i> File cannot be upload greater then 2 MB',
            time: 3
        });
        return false;
    }
    var csrf_token = $('input[name=_token]').val();
    var formdata = new FormData();
    formdata.append("image", file);
    var percentComplete = 0;
    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $("#progressOuter").show();
                    $("#progressBar").css("width", Math.round(percentComplete) + "%");
                    $("#progressBar").html(Math.round(percentComplete) + "%");
                    if (percentComplete === 100) {
                    }
                }
            }, false);
            return xhr;
        },
        url: full_path + 'upload-picture',
        headers: {'X-CSRF-TOKEN': csrf_token},
        method: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: formdata,
        success: function (response) {
            console.log(response);
            if (response.status == "success")
            {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: response.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $("#progressOuter").hide();
                $("#progressBar").css("width", "0%");
                $("#progressBar").html("0%");
                window.location.href = response.link;
            } else if (response.status == "error")
            {
                $.iaoAlert({
                    type: "error",
                    position: "top-right",
                    mode: "dark",
                    msg: '<i class="fa fa-close"></i>' + response.errors.logo[0],
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $("#progressOuter").hide();
                $("#progressBar").css("width", "0%");
                $("#progressBar").html("0%");
            } else {
                $.iaoAlert({
                    type: "error",
                    position: "top-right",
                    mode: "dark",
                    msg: response.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $("#progressOuter").hide();
                $("#progressBar").css("width", "0%");
                $("#progressBar").html("0%");
            }
        }
    });
}

function AddtoCart(obj) {
    ajaxindicatorstart();
    var product_id = $(obj).data('product_id');
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'add-cart',
        dataType: 'json',
        data: {product_id: product_id},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.type === 1) {
                $('.cart_count').attr('data-count', resp.cart_count);
                success_msg(resp.msg);
            } else {
                error_msg(resp.msg);
            }
            ajaxindicatorstop();
        }
    });
}
function removeCart(id, obj) {
    $.confirm({
        title: 'Delete',
        content: 'Are you sure to delete this product from cart?',
        buttons: {
            confirm: {
                btnClass: 'btn-success',
                action: function () {
                    ajaxindicatorstart();
                    var csrf_token = $('input[name=_token]').val();
                    $.ajax({
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: full_path + 'remove-cart',
                        dataType: 'json',
                        data: {product_id: id},
                        success: function (resp) {
                            if (resp.type === 1) {
                                $(obj).closest('tr').remove();
                                $('.cart_count').html(resp.cart_count);
                                $('.total-amounts').html(resp.total);
                                if (resp.content) {
                                    location.reload();
                                }
                                success_msg(resp.msg);
                                setTimeout(function () {
                                    location.reload(true);
                                }, 1000);
                            } else {
                                error_msg(resp.msg);
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: {
                btnClass: 'btn-danger'
                        //
            },
        }
    });
}

function changeQuantity(obj, cartId) {
    var qty = $(obj).find('option:selected').val();
//    alert(cartId);
    ajaxindicatorstart();
    currentRequest = $.ajax({
        type: 'GET',
        url: full_path + 'update-cart',
        dataType: 'json',
        data: {qty: qty, cartId: cartId},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
                success_msg(resp.msg);
                setTimeout(function () {
                    location.reload(true);
                }, 1000);
            
            ajaxindicatorstop();
        }
    });
}












