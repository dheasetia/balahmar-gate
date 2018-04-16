var ProjectShow = function() {
    var hidePortletDocument = function () {
        $('#document_portlet_body').addClass('portlet-collapsed');
    };

    return {
        init: function() {
            //hidePortletDocument();
        }
    };
}();

jQuery(document).ready(function() {
    ProjectShow.init();
});