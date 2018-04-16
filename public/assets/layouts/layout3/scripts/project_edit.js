var ProjectEdit = function() {

    jQuery.validator.addMethod('hijri_valid', function (value, element) {
        var numbers = value.split('/'),
            day = parseInt(numbers[0]),
            month = parseInt(numbers[1]),
            year = parseInt(numbers[2]),
            ummalqura_cal = $.calendars.instance('ummalqura', 'ar'),
            result = true;

        if (ummalqura_cal.isValid(year, month, day) == false) {
            result = false;
        }
        return result;
    }, 'التاريخ الهجري غير صحيح.');

    var handleHijri = function () {
        var uq_cal = $.calendars.instance('ummalqura');
        var uq_date = uq_cal.newDate();
        var str_hijri = uq_cal.formatDate('dd/ mm/ yyyy', uq_date);
        $('#hijri_created').val(str_hijri);
    };

    var handleInputMasks = function () {
        var input = $("#execution_date");
        input.inputmask('99/ 99/ 9999');

    };

    var handleValidation = function() {
        var form1 = $('#form_edit_project');

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                responsible_person: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                execution_date: {
                    required: true,
                    hijri_valid: true
                },
                kind_id: {
                    required: true
                },
                city_id: {
                    required: true
                },
                video_link: {
                    url: true
                }

            },
            messages: {
                number: {
                    required: 'رقم المعاملة مطلوب.'
                },
                name: {
                    required: 'مطلوب'
                },
                description: {
                    required: 'مطلوب'
                },
                responsible_person: {
                    required: 'مطلوب'
                },
                email: {
                    required: 'مطلوب',
                    email: 'الإيميل خطأ'
                },
                kind_id: {
                    required: 'مطلوب'
                },
                city_id: {
                    required: 'مطلوب'
                },
                execution_date: {
                    required: 'مطلوب',
                    hijri_valid: 'غير صحيح'
                },
                video_link: {
                    url: 'الربط غير صحيح. الرجاء لصق الرابط كاملا.'
                }
            },

            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function(element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function(form1) {
                form1.submit();
            }
        });
    };


    return {
        //main function to initiate the module
        init: function() {
            handleHijri();
            handleInputMasks();
            handleValidation();



        }
    };
}();

jQuery(document).ready(function() {
    ProjectEdit.init();
});