var ProjectShow = function () {

    var handleApprovalHijri = function () {
        var uq_cal = $.calendars.instance('ummalqura');
        var uq_date = uq_cal.newDate();
        var str_hijri = uq_cal.formatDate('dd/ mm/ yyyy', uq_date);
        $('#hijri_approval').val(str_hijri);
    };

    var handleApprovalForm = function () {
        var ban_reason_area = $('#ban_reason_area');
        var donation_amount_area = $('#donation_amount_area');
        var other_project_area = $('#other_project_area');
        var pended_area = $('#pended_area');
        var requested_area = $('#requested_area');

        $('input[type=radio][name=approval_status]').on('click', function () {
            switch($(this).val()) {
                case '1':
                    ban_reason_area.hide();
                    other_project_area.hide();
                    pended_area.hide();
                    requested_area.hide();
                    donation_amount_area.slideDown();
                    break;
                case '2':
                    donation_amount_area.hide();
                    other_project_area.hide();
                    pended_area.hide();
                    requested_area.hide();
                    ban_reason_area.slideDown();
                    break;
                case '4':
                    donation_amount_area.hide();
                    ban_reason_area.hide();
                    pended_area.hide();
                    requested_area.hide();
                    other_project_area.slideDown();
                    break;
                case '5':
                    donation_amount_area.hide();
                    ban_reason_area.hide();
                    other_project_area.hide();
                    requested_area.hide();
                    pended_area.slideDown();
                    break;
                case '6':
                    donation_amount_area.hide();
                    ban_reason_area.hide();
                    other_project_area.hide();
                    pended_area.hide();
                    requested_area.slideDown();
                    break;
                
                default:
                    donation_amount_area.hide();
                    other_project_area.hide();
                    ban_reason_area.hide();
                    break;
            }
        });
    };

    return {
        init: function () {
            handleApprovalHijri();
            handleApprovalForm();
        }
    }
}();

jQuery(document).ready(function () {
    ProjectShow.init()
});