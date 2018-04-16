var AdminProjectIndex = function () {
    var handleDataTables = function () {
        var table = $('#projects_table');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": تفعيل الترتيب الأبجدي",
                    "sortDescending": ": تفعيل الترتيب الأبجدي من الأخير"
                },
                "emptyTable": "لا توجد مشروع مسجل",
                "info": "إظهار _START_ إلى _END_ من مجموع _TOTAL_ مشاريع",
                "infoEmpty": "لا يوجد",
                "infoFiltered": "(تصفية من _MAX_ مشاريع)",
                "lengthMenu": "_MENU_  أسطر لكل صفحة",
                "search": "بحث شامل:",
                "zeroRecords": "لا يوجد نتيجة مطابقة للبحث"
            },
            "columnDefs": [
                {  // set default column settings
                    'orderable': false,
                    'targets': [2,6,7,8]
                }
            ],
            buttons: [

            ],
            "pageLength": 20,
            // setup responsive extension: http://datatables.net/extensions/responsive/
            // "ordering": true, //disable column ordering
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
            handleDataTables();
        }
    };
}();

jQuery(document).ready(function () {
    AdminProjectIndex.init();
});