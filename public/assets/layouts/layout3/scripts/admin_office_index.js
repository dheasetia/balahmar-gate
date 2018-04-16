var AdminIndex = function () {
    var handleApprovalModal = function () {

        $("#approval_modal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var fullname = button.data("fullname");
            var url = button.data("url");
            var office_id = button.data("id");
            var modal = $(this);
            modal.find(".modal-body #modal_office_name").html("<strong>" + fullname + "</strong>؟");
            var form = modal.find("#form_approval");
            form.attr("action", url);
            $('input#office_id').val(office_id);
        });
    };

    var handleUnapprovalModal = function () {
        $("#unapproval_modal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var fullname = button.data("fullname");
            var url = button.data("url");
            var office_id = button.data("id");
            var modal = $(this);
            modal.find(".modal-body #modal_unapproval_office_name").html("<strong>" + fullname + "</strong>؟");
            var form = modal.find("#form_unapproval");
            form.attr("action", url);
            $('input#unapproval_office_id').val(office_id);
        });
    };

    var handleOfficeDeleteModal = function () {
        $("#office_delete_modal").on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget);
            var fullname = button.data("fullname");
            var office_id = button.data("id");
            var modal = $(this);
            modal.find(".modal-body #modal_office_name").html("<strong>" + fullname + "</strong>؟");
            var form = modal.find("#form_delete_office");
            form.attr("action", '/admin/offices/' + office_id);
        });

        $("#office_delete_modal").on('hidden.bs.modal', function (event) {
            var modal = $(this);
            modal.find(".modal-body #modal_office_name").text('');
            var form = modal.find("#form_delete_office");
            form.attr("action", '');
        })
    };

    var handleDataTables = function () {
        var table = $('#office_list_table');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": تفعيل الترتيب الأبجدي",
                    "sortDescending": ": تفعيل الترتيب الأبجدي من الأخير"
                },
                "emptyTable": "لا توجد جهة مسجلة",
                "info": "إظهار _START_ إلى _END_ من مجموع _TOTAL_ جهات",
                "infoEmpty": "لا يوجد",
                "infoFiltered": "(تصفية من _MAX_ جهات)",
                "lengthMenu": "_MENU_  أسطر لكل صفحة",
                "search": "بحث شامل:",
                "zeroRecords": "لا يوجد نتيجة مطابقة للبحث"
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [4]
            }],
            buttons: [

            ],
            "pageLength": 20,
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: true,

            "ordering": true, //disable column ordering
            //"paging": false, disable pagination

            // "order": [
            //     [0, 'asc']
            // ],



            "lengthMenu": [
                [10, 20, 30, 40, 50, -1],
                [10, 20, 30, 40, 50, "الكل"] // change per page values here
            ],
            // set the initial value


            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
        });
    };

    return {
        init: function () {
            handleApprovalModal();
            handleUnapprovalModal();
            handleOfficeDeleteModal();
            handleDataTables();
        }
    };
}();

jQuery(document).ready(function () {
    AdminIndex.init();
});