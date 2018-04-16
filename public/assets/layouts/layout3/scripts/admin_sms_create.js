var MessageCreate = function () {
    var handleHijri = function () {
        var uq_cal = $.calendars.instance('ummalqura');
        var uq_date = uq_cal.newDate();
        var str_hijri = uq_cal.formatDate('dd/ mm/ yyyy', uq_date);
        $('#hijri_created').val(str_hijri);
    };

    var handleValidation = function() {
        var form1 = $('#form_message_create');

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                text: {
                    required: true
                }
            },
            messages: {
                text: {
                    required: 'نص الرسالة مطلوب.'
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
                var berapa = $('input.user_checkbox').filter(':checked').length;
                if (berapa === 0) {
                    $('#no_user_selected_warning').removeClass('display-hide');
                } else {
                    $('#no_user_selected_warning').addClass('display-hide');
                    form1.submit();
                }
            }
        });
    };


    handleRadio = function () {
        var radios =  $('input:radio[name=user_group]');

       radios.change(function () {
          var checked = radios.filter(':checked');
          var group = checked.data(('slug'));
          if (checked.data('slug') == 'all') {
              $('input.user_checkbox').each(function () {
                  this.checked = true;
              });
          } else {
              $('input.user_checkbox').each(function () {
                  this.checked = false;
                  var group_array = $(this).data('group');
                  if (group_array.indexOf(group) > 0) {
                      this.checked = true;
                  }
              });
          }

           var txt_count = $(this).val().length;
           var sms_count = Math.floor(txt_count / 60) + 1;
           $('span#discounted').text(getRecipients() * sms_count);
       });
    };

    handleCharacterCount = function () {
        $('#sms_text').on('keyup', function() {
            var txt_count = $(this).val().length;
            var sms_count = Math.floor(txt_count / 60) + 1;

            $('span#characters').text(txt_count);
            $('span#point').text(sms_count);
            $('span#discounted').text(getRecipients() * sms_count);
        });
    };

    var handleCheckboxChange = function()
    {
        $('input.user_checkbox').on('change', function () {
            var txt_count = $(this).val().length;
            var sms_count = Math.floor(txt_count / 60) + 1;
            $('span#discounted').text(getRecipients() * sms_count);
        });
    };



    var getRecipients = function () {
        var radios =  $('input.user_checkbox');
        var checked = radios.filter(':checked');
        return checked.length;
    };

    return {
        init: function () {
            handleRadio();
            handleHijri();
            handleValidation();
            handleCharacterCount();
            handleCheckboxChange();
        }
    };
}();

jQuery(document).ready(function () {
    MessageCreate.init();
});