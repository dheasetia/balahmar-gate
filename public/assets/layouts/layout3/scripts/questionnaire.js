var Questionnaire = function() {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    var handleStarRating = function () {
        $(".rateyo").rateYo({
            rtl: true,
            fullStar: true,
            onSet: function (rating, rateYoInstance) {
                var parent = $(this).parent('.rating');

                var question_id = parent.data('question_id');
                App.blockUI({
                    target: '#answer_' + question_id,
                    boxed: true,
                    message: 'جاري عملية الحفظ ...'
                });
                $.ajax({
                    url: '/abahapi/setquestionnaire',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        question_id: question_id,
                        rating: rating
                    },
                    success: function(data) {
                        toastr['success']("تم الحفظ", "استبيان");
                        App.unblockUI('#answer_' + question_id);
                    },
                    error: function (err) {
                        toastr['error']("خطأ في عملية الحفظ", "استبيان");
                        App.unblockUI('#answer_' + question_id);
                    }
                })
            },
            onChange: function (rating, rateYoInstance) {
                $(this).next().text(rating);
            }
        });
    };

    var handleDescriptionRating = function () {
        var timeout = null;
        $('.textarea_description').on('keyup', function () {
            var that = $(this);
            var question_id = that.closest('.form-group').data('question_id');

            clearTimeout(timeout);
            // Make a new timeout set to go off in 800ms
            timeout = setTimeout(function () {
                App.blockUI({
                    target: '#answer_' + question_id,
                    boxed: true,
                    message: 'جاري عملية الحفظ ...'
                });
                $.ajax({
                    url: '/abahapi/setquestionnairedescription',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        question_id: question_id,
                        description: that.val()
                    },
                    success: function(data) {
                        toastr['success']("تم الحفظ" , "استبيان");
                        App.unblockUI('#answer_' + question_id);
                    },
                    error: function (err) {
                        toastr['error']("خطأ في عملية الحفظ", "استبيان");
                        App.unblockUI('#answer_' + question_id);
                    }
                })
            }, 2000);
        })
    };


    return {
        //main function to initiate the module
        init: function() {
            handleStarRating();
            handleDescriptionRating();
        }
    };
}();

jQuery(document).ready(function() {
    Questionnaire.init();
});