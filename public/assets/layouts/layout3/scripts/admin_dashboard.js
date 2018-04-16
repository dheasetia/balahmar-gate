//TODO
/*
1. Loading approved projects
    - descending list starting from the last projects

    - load last 10 projects approved
    - if make button 'more project' at the bottom of list
2. Loading waiting for approval projects
    - create api
    - descending list starting from the last projects
    - load last 10 projects approved
    - if make button 'more project' at the bottom of list
3. Loading waiting for denied
    - create api
    - descending list starting from the last projects
    - load last 10 projects approved
    - if make button 'more project' at the bottom of list



*/

var AdminDashboard = function () {
    var start = 2;
    var fetchApprovedProjects = function() {

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/admin/api/projects/approved',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                start: start
            },
            success: function (data) {
                //console.log(data);
                var table = $('.general-item-list#approved_projects_list');
                if (data) {
                    table.append(data);
                }
            },
            error: function (err) {

            }
        })
    };

    var handleOfficeByCityChart = function () {
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: '/admin/api/reports/officecountbycity',
            success: function (data) {
                if(data.length > 1) {
                    $('#office_count').text(' (' + data.length + ' جهة)');
                }
                var chart = AmCharts.makeChart( "chartdiv1", {
                    "type": "pie",
                    "theme": "light",
                    "balloonText": "مدينة [[title]]<br><span style='font-size:14px'><b>[[value]] جهة </b> ([[percents]]%)</span>",
                    "labelRadius": 50,
                    "dataProvider": data,
                    "labelText": "[[title]]: [[value]]",
                    "valueField": "count",
                    "titleField": "city",
                    "balloon":{
                        "fixedPosition":true
                    }
                } );
            }
        });
    };

    var handleDonationByMonths = function () {
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: '/admin/api/reports/donationbymonthcurrentyear',
            success: function (data) {
                var chart2 = AmCharts.makeChart( "chartdiv2", {
                    "type": "serial",
                    "theme": "light",
                    "marginRight": 70,
                    "dataProvider": data,
                    "startDuration": 1,
                    "graphs": [{
                        "balloonText": "<b>[[category]]: [[value]] ريال سعودي</b>",
                        "fillColorsField": "color",
                        "fillAlphas": 0.9,
                        "lineAlpha": 0.2,
                        "type": "column",
                        "valueField": "total"
                    }],
                    "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                    },
                    "categoryField": "category",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "labelRotation": 45
                    }
                });
            }
        });
    };

    return {
        init: function () {
            // fetchApprovedProjects();
            handleOfficeByCityChart();
            handleDonationByMonths();
        }
    }
}();
$(document).ready(function () {
    AdminDashboard.init();
});