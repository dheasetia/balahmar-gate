var OfficeShow = function() {
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
            handleOfficeMap();
        }
    };
}();

jQuery(document).ready(function() {
    OfficeShow.init();
});