/* No back button */
window.location.hash = "gestion";
window.location.hash = "Again-gestion"; // again because google chrome don't insert first hash into history
window.onhashchange = function () {
    window.location.hash = "gestion";
};

/* Vars */
$body = $('body');
$loading = $('#loading-spinner');
$modal = $('#util-modal-lg');
$modal_sm = $('#util-modal-sm');
$modal_xl = $('#util-modal-xl');
$modal_st = $('#util-modal-st');
$main_content = $('#main_content');
$loadingCount = 0;

/* Modals */
$modal.on('hidden.bs.modal', function () {
    $('.modal-dialog', $modal).empty();
});

$modal_sm.on('hidden.bs.modal', function () {
    $('.modal-dialog', $modal_sm).empty();
});

$modal_xl.on('hidden.bs.modal', function () {
    $('.modal-dialog', $modal_xl).empty();
});

$modal_st.on('hidden.bs.modal', function () {
    $('.modal-dialog', $modal_st).empty();
});

/* Logout */
$body.on('click', '.logout', function (e) {
    e.preventDefault();
    $('#logout-form').submit();
});

/* Loading */
function showLoading() {
    $loading.show();
    NProgress.start();
    $loadingCount++;
}

function hideLoading() {
    if ($loadingCount == 0) {
        $loading.hide();
        NProgress.done();
    } else if ($loadingCount > 0) {
        $loadingCount--;
        if ($loadingCount == 0) {
            $loading.hide();
            NProgress.done();
        }
    } else {
        $loading.hide();
        NProgress.done();
    }
}

/* Ajaxify */
function pushRequest(url, target, callback, method, data, scrollTop = true, options = null) {

    let config = {
        type: method || 'get',
        data: data || {},
        beforeSend: function () {
            $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
            showLoading();
        }
    };

    if (options && options.file === true) {
        config.processData = false;
        config.contentType = false;
        config.enctype = 'multipart/form-data';
    } else if (options && options.form === true) {
        config.processData = false;
        config.contentType = false;
    }

    $.ajax(url, config).done(function (response) {
        processResponse(response, target, callback);
        $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
    }).fail(function (request, error) {
        notify('Ha ocurrido un error al intentar realizar la transacci&#243;n', 'error', 'Error!');
        console.error(error);
    }).always(function () {
        if (scrollTop) {
            $('html, body').animate({scrollTop: 0}, 500);
        }
        hideLoading();
        $('[data-toggle="tooltip"]', $main_content).tooltip('hide');
    });
}

function processResponse(response, target, callback) {

    if (response.no_auth)
        window.location = '/login';

    if (response.view) {
        target = target || '#main_content';
        var $target = $(target);
        $target.empty().html(response.view);
        init_switchery($target);
        init_icheck($target);
        init_tooltip();
    } else if (response.modal) {
        var $target_md = $modal.find('.modal-dialog');
        $target_md.html(response.modal);
        init_switchery($target_md);
        init_icheck($target_md);
        init_tooltip();
        $modal.modal('show');
    } else if (response.modal_sm) {
        var $target_sm = $modal_sm.find('.modal-dialog');
        $target_sm.html(response.modal_sm);
        init_switchery($target_sm);
        init_icheck($target_sm);
        init_tooltip();
        $modal_sm.modal('show');
    } else if (response.modal_xl) {
        var $target_xl = $modal_xl.find('.modal-dialog');
        $target_xl.html(response.modal_xl);
        init_switchery($target_xl);
        init_icheck($target_xl);
        init_tooltip();
        $modal_xl.modal('show');
    } else if (response.modal_st) {
        var $target_st = $modal_st.find('.modal-dialog');
        $target_st.html(response.modal_st);
        init_switchery($target_st);
        init_icheck($target_st);
        init_tooltip();
        $modal_st.modal('show');
    }

    if (response.download) {
        let link_class = 'download_link_unique';
        $("body").append('<a href="' + response.download.url + '"  class="' + link_class + '"></a>');

        let $click_link = $('.' + link_class);

        $click_link.on('click', function (e) {
            window.open($(this).attr('href'));
        });

        $click_link.trigger('click').unbind('click').remove();
    }

    if (response.message) {
        var message = response.message;
        notify(message.text, message.type, message.title);
    }

    if (response.exception) {
        var exception = response.exception;
        notify(exception.message, 'error', 'Error!');
        console.log(exception);
    }


    typeof callback === 'function' && callback(response);
    typeof setContentHeight === 'function' && setContentHeight();
}

$('.main_container').on('click', '.ajaxify', function (e) {
    e.preventDefault();

    var url = $(this).attr('href') || $(this).attr('data-href');
    if (!url)
        return;

    var target = $(this).attr('data-ajaxify') || '#main_content';

    pushRequest(url, target, null, null, null, !$(this).hasClass('no-scroll-top'));
});

/* Form validation methods */

var onlyNumbersRegex = new RegExp('^\\d+$');
var alphanumericRegex = new RegExp('^[a-zA-Z0-9]*$');

$.validator.addMethod("onlyIntegers", function (value, element) {
    if (value !== '') {
        return onlyNumbersRegex.test(value);
    } else
        return true;
}, 'Por favor, ingrese solamente números enteros');

$.validator.addMethod('lettersOnly', function (value, element) {
    if (value !== '') {
        return this.optional(element) || /^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/i.test(value);
    } else
        return true;
}, 'Por favor, ingrese solamente letras');

$.validator.addMethod('emailChecker', function (value) {
    if (value !== '') {
        const email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
        return email.test(value);
    } else
        return true;
}, 'Por favor, ingrese una dirección de correo válida');

$.validator.addMethod("passport", function (value) {
    if (value !== '') {
        return alphanumericRegex.test(value);
    } else
        return true;
}, 'Por favor, ingrese un pasaporte válido');

$.validator.addMethod('cedula', function (value) {
    if (value !== '') {

        let provinceCode = value.substring(0, 2);
        if ((provinceCode >= 1 && provinceCode <= 24) || provinceCode == 30) {

            let [sum, mul, index] = [0, 1, value.length];
            while (index--) {
                let num = value[index] * mul;
                sum += num - (num > 9) * 9;
                mul = 1 << index % 2;
            }
            return (sum % 10 === 0) && (sum > 0) && value.length === 10;
        } else {
            return false;
        }

    } else {
        return true;
    }
}, 'Por favor, ingrese una cédula válida');

$.validator.addMethod('MayorTo', function (value, param) {
    if (value !== '') {
        if (value > $(param).val())
            return true;
        else
            return false;
    } else {
        return false;
    }
}, 'Por favor, este valor debe ser mayor a linea base');

$.validator.addMethod('spaceChecker', (value) => {
    if (value !== '') {
        const input = /^\w*[\-_.@)\w]*$/;
        return input.test(value);
    } else
        return true;
}, 'Por favor, no coloque espacios ni caracteres inválidos');

$.validator.addMethod('wordChecker', (value) => {
    if (value !== '') {
        const input = /^[\wÑñ\-,;:'"_.áéíóúÁÉÍÓÚ ]{1,19}(\s[\wÑñ\-,;:'"_.áéíóúÁÉÍÓÚ ]{1,19})*$/;
        return input.test(value);
    } else
        return true;
}, 'Por favor, las palabras deben tener máximo 18 caracteres');

$.validator.addMethod("ruc", function (value) {
    if (value !== '') {
        return onlyNumbersRegex.test(value) && value.length === 13;
    } else
        return true;
}, 'Por favor, ingrese un RUC válido');

$.validator.addMethod("wordLowercase", function (value) {
    if (value !== '') {
        const input = /[a-z]/;
        return input.test(value);
    } else
        return true;
}, 'Por favor, ingresa al menos una letra minúscula');

$.validator.addMethod("wordUppercase", function (value) {
    if (value !== '') {
        const input = /[A-Z]/;
        return input.test(value);
    } else
        return true;
}, 'Por favor, ingresa al menos una letra Mayúscula');

$.validator.addMethod("wordOneNumber", function (value) {
    if (value !== '') {
        const input = /\d+/;
        return input.test(value);
    } else
        return true;
}, 'Por favor, ingresa al menos un número');

$.validator.addMethod("wordOneSpecialChar", function (value) {
    if (value !== '') {
        var special = '[!,@,#,$,%,^,&,*,?,_,~]';
        var specialCharRE = new RegExp(special);
        return specialCharRE.test(value);
    } else
        return true;
}, 'Por favor, ingresa al menos un caracter especial');

/* Form */
$validateDefaults = {
    ignore: [],
    rules: {},
    messages: {},

    highlight: function (element, errorClass, validClass) {
        $(element).addClass(errorClass).removeClass(validClass);
        if ($(element.form).find("label[for='" + element.id + "']").length)
            $(element.form).find("label[for='" + element.id + "']")
                .addClass(errorClass);
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass(errorClass).addClass(validClass);
        if ($(element.form).find("label[for='" + element.id + "']").length)
            $(element.form).find("label[for='" + element.id + "']")
                .removeClass(errorClass);
    },

    errorElement: 'span',
    errorClass: 'help-block',

    errorPlacement: function (error, element) {
        if (element.hasClass('select2-hidden-accessible'))
            error.insertAfter(element.next('span'));
        else {
            if (element.parent('.input-group').length)
                error.insertAfter(element.parent());
            else
                error.insertAfter(element);
        }

    }
};

$formAjaxDefaults = {
    dataType: 'json',

    beforeSubmit: function (formData, jqForm) {

        if (jqForm.valid()) {

            showLoading();
            return true;
        }

        return false;
    },

    success: function (response) {
        processResponse(response, '#main_content', function () {
            $validateDefaults.rules = {};
            $validateDefaults.messages = {};
        });
    },

    error: function (param1, param2, param3) {
        notify('Ha ocurrido un error al intentar realizar la transacci&#243;n', 'error', 'Error!');
        $validateDefaults.rules = {};
        $validateDefaults.messages = {};
        console.log(param3);
    },

    complete: function () {
        hideLoading();
    }
};

// Clean form validations
function cleanFormValidations(formId) {
    $('.has-error', $('#' + formId)).removeClass('has-error');
    $('.has-success', $('#' + formId)).removeClass('has-success');
    $('.help-block', $('#' + formId)).remove();
}

/* Password */
$('#change-passwd-top').on('click', function () {
    $('.modal-dialog', $modal).load('/profile/password', function () {
        $modal.modal('show');
    });
});

$('#change-passwd-left').on('click', function () {
    $('.modal-dialog', $modal).load('/profile/password', function () {
        $modal.modal('show');
    });
});

function checkNoPassword() {
    var $noPassword = $('.no-passwd', $modal);
    if ($noPassword) {
        $noPassword.load('/profile/password', function () {
            $modal.attr('data-backdrop', 'static');
            $modal.attr('data-keyboard', 'false');
            $modal.modal('show');
            hideLoading();
        });
    }
}

/* On Ready */
$(document).ready(function () {
    $('.ajaxify.start').click();

    checkNoPassword();

    // hide select2 on click menu
    if ($("#sidebar-menu")) {

        $("#sidebar-menu .menu_section ul li").click(function () {
            if ($(this).children('a').hasClass('ajaxify')) {
                if ($('.select2-container--default')) {
                    $('.select2-container--default').select2().on('select2:closing', () => {
                    });
                }
            }
        });
    }
});

/* Bootbox Modal */

function confirmModal(message, callback, callback_cancel = null) {

    bootbox.confirm({
        title: '<i class="fa fa-exclamation-circle"></i> Confirmación',
        backdrop: true,
        className: 'bootbox-modal',
        closeButton: false,
        buttons: {
            confirm: {
                label: 'Aceptar',
                className: 'btn-success'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-danger'
            }
        },
        message: message,
        callback: function (result) {
            if (result) {
                typeof callback === 'function' && callback();
            } else {
                typeof callback_cancel === 'function' && callback_cancel();
            }
        }
    })
}

function messageModal(message, callback) {

    bootbox.alert({
        title: '<i class="fa fa-exclamation-circle"></i> Mensaje',
        backdrop: true,
        className: 'bootbox-modal',
        closeButton: false,
        buttons: {
            ok: {
                label: 'Aceptar',
                className: 'btn-success'
            }
        },
        message: message,
        callback: function (result) {
            if (result) {
                callback();
            }
        }
    })
}

(function (global) {

    if (typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }

    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";

        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };

    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };

    global.onload = function () {
        noBackPlease();

        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.key === 'Backspace' && (elm !== 'input' && elm !== 'textarea')) {
                e.preventDefault();
            }
            if (e.key === 'Enter' && elm === 'input') {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };
    }

})(window);

// convert image to base64
const imgToBase64 = (url, callback) => {
    if (!window.FileReader) {
        callback(null)
        return
    }
    let xhr = new XMLHttpRequest()
    xhr.responseType = 'blob'
    xhr.onload = () => {
        let reader = new FileReader()
        reader.onloadend = () => {
            callback(reader.result.replace('text/xml', 'image/jpeg'))
        };
        reader.readAsDataURL(xhr.response)
    };
    xhr.open('GET', url)
    xhr.send()
}

// set default header and footer configurations for downloadable pdf file
const setDocHeaderAndFooter = (data, doc, logoBase64, title, gad, date, totalPagesExp) => {

    // Header
    doc.setFontSize(15)
    doc.setTextColor(40)
    doc.setFontStyle('normal')

    if (logoBase64) {
        doc.addImage(logoBase64, 'PNG', data.settings.margin.left, 15, 50, 14)
    }
    doc.text(gad, data.settings.margin.left, 38)
    doc.text(date, data.settings.margin.left, 48)
    doc.text(title, data.settings.margin.left, 58, {'maxWidth': 400})

    // Footer
    let str = 'Página ' + doc.internal.getNumberOfPages()

    if (typeof doc.putTotalPages === 'function') {
        str = str + ' de ' + totalPagesExp
    }
    doc.setFontSize(10)

    let pageSize = doc.internal.pageSize
    let pageHeight = pageSize.getHeight()
    doc.text(str, data.settings.margin.left, pageHeight - 10)

    return doc
}

/**
 * Verificar si dos arrays son iguales
 *
 * @param value
 * @param other
 * @returns {boolean}
 */
const equalArrays = (value, other) => {

    // Get the value type
    let type = Object.prototype.toString.call(value)

    // If the two objects are not the same type, return false
    if (type !== Object.prototype.toString.call(other)) return false

    // If items are not an object or array, return false
    if (['[object Array]', '[object Object]'].indexOf(type) < 0) return false

    // Compare the length of the length of the two items
    let valueLen = type === '[object Array]' ? value.length : Object.keys(value).length
    let otherLen = type === '[object Array]' ? other.length : Object.keys(other).length
    if (valueLen !== otherLen) return false

    // Compare two items
    let compare = (item1, item2) => {

        // Get the object type
        let itemType = Object.prototype.toString.call(item1)

        // If an object or array, compare recursively
        if (['[object Array]', '[object Object]'].indexOf(itemType) >= 0) {
            if (!equalArrays(item1, item2)) return false
        }

        // Otherwise, do a simple comparison
        else {

            // If the two items are not the same type, return false
            if (itemType !== Object.prototype.toString.call(item2)) return false

            // Else if it's a function, convert to a string and compare
            // Otherwise, just compare
            if (itemType === '[object Function]') {
                if (item1.toString() !== item2.toString()) return false
            } else {
                if (item1 !== item2) return false
            }

        }
    };

    // Compare properties
    if (type === '[object Array]') {
        for (let i = 0; i < valueLen; i++) {
            if (compare(value[i], other[i]) === false) return false;
        }
    } else {
        for (let key in value) {
            if (value.hasOwnProperty(key)) {
                if (compare(value[key], other[key]) === false) return false;
            }
        }
    }

    // If nothing failed, return true
    return true;
};

// Overrides toFixed javascript function to have more precision
Number.prototype.toFixed = function (fractionDigits) {
    var f = parseInt(fractionDigits) || 0;
    if (f < -20 || f > 100) {
        throw new RangeError("Precision of " + f + " fractional digits is out of range");
    }
    var x = Number(this);
    if (isNaN(x)) {
        return "NaN";
    }
    var s = "";
    if (x < 0) {
        s = "-";
        x = -x;
    }
    if (x >= Math.pow(10, 21)) {
        return s + x.toString();
    }
    var m;
// 10. Let n be an integer for which the exact mathematical value of
// n Ã· 10^f - x is as close to zero as possible.
// If there are two such n, pick the larger n.
    n = Math.round(x * Math.pow(10, f));

    if (n == 0) {
        m = "0";
    } else {
        // let m be the string consisting of the digits of the decimal representation of n (in order, with no leading zeroes).
        m = n.toString();
    }
    if (f == 0) {
        return s + m;
    }
    var k = m.length;
    if (k <= f) {
        var z = Math.pow(10, f + 1 - k).toString().substring(1);
        m = z + m;
        k = f + 1;
    }
    if (f > 0) {
        var a = m.substring(0, k - f);
        var b = m.substring(k - f);
        m = a + "." + b;
    }
    return s + m;
};

(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };
}(jQuery));

$(document.body).on('hide.bs.modal,hidden.bs.modal', function () {
    $('body').css('padding-right', '0');
});