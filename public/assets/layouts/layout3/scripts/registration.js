var FormValidationMd = function() {

    var handleValidation = function() {
        // for more info visit the official plugin documentation:
        // http://docs.jquery.com/Plugins/Validation
        var form1 = $('#form_registration');
        var error1 = $('.alert-danger', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input

            rules: {
                name: {
                    minlength: 2,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                national_id:{
                    required: true,
                    digits: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    minlength: 'الاسم غير صحيح. ',
                    required: 'الاسم مطلوب. '
                },
                email: {
                    required: 'البريد الإلكتروني مطلوب',
                    email: 'البريد الإلكتروني غير صحيح'
                },
                mobile: {
                    required: 'رقم الجوال مطلوب',
                    digits: 'رقم الجوال غير صحيح',
                    minlength: 'رقم الجوال غير صحيح',
                    maxlength: 'رقم الجوال غير صحيح'
                },
                national_id:{
                    required: 'رقم الهوية الوطنية مطلوب',
                    digits: 'رقم الهوية الوطنية غير صحيح'
                },
                password: {
                    required: ' كلمة المرور مطلوب',
                    minlength: 'يجب أن لا يكون أقل من ٦ أحرف'
                },
                password_confirmation: {
                    required: 'تأكيد كلمة المرور مطلوب',
                    equalTo: 'تأكيد كلمة المرور غير مطابق'
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit
                error1.show();
                App.scrollTo(error1, -200);
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

            submitHandler: function(form) {
                error1.hide();
                form.submit();
            }
        });
    };

    return {
        //main function to initiate the module
        init: function() {
            handleValidation();
        }
    };
}();

jQuery(document).ready(function() {
    FormValidationMd.init();
});