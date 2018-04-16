var AdminOfficeShow = function() {
    var updateReasons = function () {
        var reason_text = '',
            optionsCheck = $('input.reason_checkbox'),
            outCheck = $('input#out_of_service'),
            textArea = $('textarea#ban_reason');

        optionsCheck.on('click', function () {
            outCheck[0].checked = false;
            reason_text = '';
            $.each(optionsCheck, function (index, value) {
                if (value.checked === true) {
                   reason_text += '- ' + value.labels[0].innerText + '\n'
                }
            });
            textArea.val(reason_text);
        });

        outCheck.on('click', function () {
            if ($(this)[0].checked === true) {
                $.each(optionsCheck, function (index, value) {
                    value.checked = false;
                    reason_text = '';
                });
                var reason_text = '';
                textArea.val('- ' + this.labels[0].innerText);
            }
        })

    };

    var handleOfficeMap = function () {
        var map;
        var myPos = new google.maps.LatLng({
            lat: 26.437214,
            lng: 50.110941
        });

        var coordinate = $('#coordinate_value').text();
        if (coordinate.length > 5) {
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
                mapTypeId: google.maps.MapTypeId.HYBRID,
                scrollwheel: false
            });

            var marker = new google.maps.Marker({
                position: myPos,
                animation: google.maps.Animation.DROP,
                map: map
            });
        }
        return initMap();
    };

    return {
        init: function() {
            //handleOfficeMap();
            updateReasons();
        }
    };
}();

jQuery(document).ready(function() {
    AdminOfficeShow.init();
});