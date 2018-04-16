var ReportShow = function () {

    var handleShowDocument = function () {
        $('#show_document').on('click', function (e) {
            e.preventDefault();
            $('#document').slideDown();
        })
    };

    var handleModal = function () {
        if($('#picture_error').length) {
            $('#add_picture_modal').modal('show');
        }
    };

    return {
        init: function () {
            handleShowDocument();
            handleModal();
        }
    }
}();

jQuery(document).ready(function () {
    ReportShow.init();
});