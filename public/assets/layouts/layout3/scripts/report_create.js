var ProposalCreate = function() {

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

    var handleHijriReportFromConversion = function () {
        var input   = $('#hijri_report_from');
        input.on('blur', function () {
            var numbers = input.val().split('/'),
                day     = parseInt(numbers[0]),
                month   = parseInt(numbers[1]),
                year    = parseInt(numbers[2]);
            try {
                var greg_input  = $('#report_from');
                var ummalqura_cal   = $.calendars.instance('ummalqura');
                var hijri_date      = ummalqura_cal.newDate(year, month, day);
                var jd              = hijri_date.toJD();
                var gc              = $.calendars.instance('gregorian');
                var gregorian_date  = gc.fromJD(jd);
                var gd_string       = gc.formatDate('dd/ mm/ yyyy', gregorian_date);
                greg_input.val(gd_string);
            }
            catch (e) {
                console.log(e);
            }
        });
    };

    var handleHijriReportToConversion = function () {
        var input   = $('#hijri_report_to');
        input.on('blur', function () {
            var numbers = input.val().split('/'),
                day     = parseInt(numbers[0]),
                month   = parseInt(numbers[1]),
                year    = parseInt(numbers[2]);
            try {
                var greg_input  = $('#report_to');
                var ummalqura_cal   = $.calendars.instance('ummalqura');
                var hijri_date      = ummalqura_cal.newDate(year, month, day);
                var jd              = hijri_date.toJD();
                var gc              = $.calendars.instance('gregorian');
                var gregorian_date  = gc.fromJD(jd);
                var gd_string       = gc.formatDate('dd/ mm/ yyyy', gregorian_date);
                greg_input.val(gd_string);
            }
            catch (e) {
                console.log(e);
            }
        });
    };



    var handleInputMasks = function () {
        var input1 = $("#hijri_report_from");
        input1.inputmask('99/ 99/ 9999');

        var input2 = $("#hijri_report_to");
        input2.inputmask('99/ 99/ 9999');

    };



    var handleValidation = function() {
        var form1 = $('#form_create_report');

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                hijri_created: {
                    required: true,
                    hijri_valid: true
                },
                project_id: {
                    required: true
                },
                nth: {
                    required: true
                },
                hijri_report_from: {
                    required: true,
                    hijri_valid: true
                },
                hijri_report_to: {
                    required: true,
                    hijri_valid: true
                },
                video_link: {
                    url: true
                },
                document_path: {
                    required: true
                }
            },
            messages: {
                hijri_created: {
                    required: 'مطلوب.',
                    hijri_valid: 'خطأ'
                },
                project_id: {
                    required: 'مطلوب.'
                },
                nth: {
                    required: 'مطلوب.'
                },
                hijri_report_from: {
                    required: 'مطلوب.',
                    hijri_valid: 'خطأ.'
                },
                hijri_report_to: {
                    required: 'مطلوب.',
                    hijri_valid: 'خطأ'
                },
                video_link: {
                    url: 'الرابط خطأ. الرجاء نسخ الرابط كاملا.'
                },
                document_path: {
                    required: 'مطلوب.'
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
            handleHijriReportFromConversion();
            handleHijriReportToConversion();



        }
    };
}();

jQuery(document).ready(function() {
    ProposalCreate.init();
});