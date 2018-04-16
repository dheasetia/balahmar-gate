var ProposalShow = function () {

    var handleApprovalHijri = function () {
        var uq_cal = $.calendars.instance('ummalqura');
        var uq_date = uq_cal.newDate();
        var str_hijri = uq_cal.formatDate('dd/ mm/ yyyy', uq_date);
        $('#hijri_approval').val(str_hijri);
    };


    return {
        init: function () {
            handleApprovalHijri();
        }
    }
}();

jQuery(document).ready(function () {
    ProposalShow.init()
});