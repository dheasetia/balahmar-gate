var AdminUserIndex = function () {
    var handleDeleteUserModal = function () {
        $("#user_delete_modal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var fullname = button.data("fullname");
            var user_id = button.data("id");
            var modal = $(this);
            modal.find(".modal-body #modal_user_name").html("<strong>" + fullname + "</strong>؟");
            var form = modal.find("#form_delete_user");
            form.attr("action", '/admin/users/' + user_id);
        });

        $("#user_delete_modal").on('hidden.bs.modal', function (event) {
            var modal = $(this);
            modal.find(".modal-body #modal_user_name").text('');
            var form = modal.find("#form_delete_user");
            form.attr("action", '');
        })
    };
    return {
        init: function () {
            handleDeleteUserModal()
        }
    };
}();

jQuery(document).ready(function () {
    AdminUserIndex.init();
});