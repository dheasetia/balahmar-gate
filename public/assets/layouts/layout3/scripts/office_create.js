var OfficeCreate = function() {
    jQuery.validator.addMethod('saudi_iban', function (value, element) {
        return this.optional(element) || /SA\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d\d/.test(value);
    }, 'رقم الأيبان غير صحيح.');

    jQuery.validator.addMethod("hijri", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30)\/\s(0[1-9]|1[0-2])\/\s(13[3-9][0-9]|14[0-4][0-9])$/.test( value );
    }, 'تاريخ الهجري غير صحيح');

    jQuery.validator.addMethod("abah_date", function(value, element) {
        return this.optional( element ) || /(0[1-9]|[1-2][0-9]|30|31)\/\s(0[1-9]|1[0-2])\/\s((19[6-9]|20[0-3])[0-9])$/.test( value );
    }, 'تاريخ الميلادي غير صحيح');

    jQuery.validator.addMethod("saudimobile", function(value, element) {
        return this.optional( element ) || /^05\d\d\d\d\d\d\d\d/.test( value );
    }, 'رقم الجوال غير صحيح');


    var handleValidation = function() {
        var form1 = $('#form_create_office');

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    required: true,
                    minlength: 6
                },
                description: {
                    required: true,
                    minlength: 6
                },
                advisor_id: {
                    required: true,
                    number: true
                },
                manager_name: {
                    required: true,
                    minlength: 6
                },
                license_no: {
                    required: true,
                    number: true
                },
                license_date: {
                    required: true,
                    hijri: true
                },
                license_file: {
                    required: true,
                    accept: 'application/pdf',
                    maxFileSize: {
                        "unit": "KB",
                        "size": 2000
                    }

                },
                bank_file: {
                    required: true,
                    accept: 'application/pdf',
                    maxFileSize: {
                        "unit": "KB",
                        "size": 2000
                    }
                },
                representative: {
                    required: true,
                    minlength: 6
                },
                role: {
                    required: true
                },
                mobile: {
                    required: true,
                    saudimobile: true
                },
                email: {
                    required: true,
                    email: true
                },
                bank_id: {
                    required: true,
                    number: true
                },
                iban: {
                    required: true,
                    saudi_iban: true
                },
                phone: {
                    number: true,
                    required: true
                },
                second_phone: {
                    number: true
                },
                fax: {
                    required: true,
                    number: true
                },
                area_id: {
                    required: true,
                    number: true
                },
                city_id: {
                    required: true,
                    number: true
                },
                street: {
                    required: true
                },
                building_no: {
                    number: true
                },
                additional_no: {
                    number: true
                },
                zip_code: {
                    required: true,
                    number: true
                }
            },
            messages: {
                name: {
                    required: 'مطلوب',
                    minlength: 'الاسم يلزم أن يكون أكثر من ٦ أحرف'
                },
                description: {
                    required: 'مطلوب',
                    minlength: 'التعريف يلزم أن يكون أكثر من ٦ أحرف'
                },
                advisor_id: {
                    required: 'مطلوب',
                    number: true
                },
                manager_name: {
                    required: 'مطلوب',
                    minlength: 'الاسم يلزم أن يكون أكثر من ٦ أحرف'
                },
                license_no: {
                    required: 'مطلوب',
                    number: 'الرقم غير صحيح'
                },
                license_date: {
                    required: 'مطلوب',
                    hijri: 'تاريخ الترخيص خطأ'
                },
                license_file: {
                    required: 'مطلوب',
                    accept: 'صيغة الملف غير صحيح',
                    maxFileSize: 'حجم الملف يلزم أن يكون أقل من ٢ ميغا'

                },
                bank_file: {
                    required: 'مطلوب',
                    accept: 'صيغة الملف غير صحيح',
                    maxFileSize: 'حجم الملف يلزم أن يكون أقل من ٢ ميغا'

                },
                representative: {
                    required: 'مطلوب',
                    minlength: 'الاسم يلزم أن يكون أكثر من ٦ أحرف'
                },
                role: {
                    required: 'صفة ممثل الجهة مطلوب'
                },
                mobile: {
                    required: 'مطلوب',
                    saudimobile: 'رقم الجوال غير صحيح'
                },
                email: {
                    required: 'مطلوب',
                    email: 'البريد الإلكتروني غير صحيح'
                },
                bank_id: {
                    required: 'مطلوب',
                    number: 'الرقم غير صحيح'
                },
                iban: {
                    required: 'مطلوب',
                    saudi_iban: 'الرقم غير صحيح'
                },
                phone: {
                    number: 'الرقم غير صحيح',
                    required: 'مطلوب'
                },

                second_phone: {
                    number: 'الرقم غير صحيح'
                },
                fax: {
                    required: 'مطلوب',
                    number: 'الرقم غير صحيح'
                },
                area_id: {
                    required: 'مطلوب',
                    number: 'الرقم غير صحيح'
                },
                city_id: {
                    required: 'مطلوب',
                    number: 'الرقم غير صحيح'
                },
                street: {
                    required: 'مطلوب'
                },
                building_no: {
                    number: 'الرقم غير صحيح'
                },
                additional_no: {
                    number: 'الرقم غير صحيح'
                },
                zip_code: {
                    required: 'مطلوب',
                    number: 'الرقم غير صحيح'
                }
            },

            errorPlacement: function(error, element) {
                if (element.is(':checkbox')) {
                    error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                } else if (element.is(':radio')) {
                    error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                }  else if (element.is(':file')) {
                    error.append(".error_file_input");
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

    var handleOfficeMap = function () {
        var map;
        var myPos = new google.maps.LatLng({
            lat: 26.437214,
            lng: 50.110941
        });

        var coordinate = $('#coordinate').val();
        if (coordinate.length > 0) {
            var temp = coordinate.split(', ');
            var lat = temp[0];
            var lng = temp[1];
            myPos = new google.maps.LatLng({
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            });
        }

        function initMap() {
            map = new google.maps.Map(document.getElementById('office_map'), {
                center: myPos,
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            var marker = new google.maps.Marker({
                position: myPos,
                animation: google.maps.Animation.DROP,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                document.getElementById('coordinate').value = marker.position.lat() + ', ' + marker.position.lng();
            });


            var geocoder = new google.maps.Geocoder();
            document.getElementById('city_id').addEventListener('change', function() {
                geocodeAddress(geocoder, map);
            });

        }

        function geocodeAddress(geocoder, resultsMap) {
            var city_select = document.getElementById('city_id');
            if (city_select.value != '') {
                address = city_select.options[city_select.selectedIndex].text;
            } else {
                address = 'المملكة العربية السعودية';
            }
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    resultsMap.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        animation: google.maps.Animation.DROP,
                        map: resultsMap,
                        draggable: true
                    });

                    google.maps.event.addListener(marker, 'dragend', function() {
                        document.getElementById('coordinate').value = marker.position.lat() + ', ' + marker.position.lng();
                    });

                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }


        return initMap();
    };



    var handleSelect = function () {
        $('select').select2({
            language: 'ar'
        });
    };

    var handleInputMasks = function () {
        var input = $("#license_date");
        input.inputmask('99/ 99/ 9999');

    };

    return {
        init: function() {
            handleSelect();
            handleValidation();
            handleInputMasks();
            handleOfficeMap();
        }
    };
}();

jQuery(document).ready(function() {
    OfficeCreate.init();
});