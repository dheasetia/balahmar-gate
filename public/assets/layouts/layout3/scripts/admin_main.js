var AdminMain = function () {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    var fetchUnapprovedOfficeCount = function () {
        var unapproved_office_count_span = $('span#admin_unapproved_office_count_badge');

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: '/admin/api/office/updatecount',
            success: function (data) {
                if (data.unapproved_offices_count > 0) {
                    unapproved_office_count_span.text(data.unapproved_offices_count);
                } else {
                    unapproved_office_count_span.text('');
                }
                console.log('Update unapproved office succeeded');
            },
            error: function (err) {

            }
        });
    };

    var updateUnapprovedOfficeCount = function() {
        if ($('#admin_unapproved_offices_notification_bar').length) {
            setInterval(fetchUnapprovedOfficeCount, 10000);
        }

    };

    return {
        init: function () {
            updateUnapprovedOfficeCount();
        }
    }
}();
$(document).ready(function () {
    AdminMain.init();
});