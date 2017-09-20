$(document).ready(function(){
    var BASEURL = $("#baseURL").val();


    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $('.datepicker').datepicker({autoclose:true});
    $('.datepicker').on('focus',function(){
        $(this).blur();
    });

    $('#graph-filter').on('click',function() {
            $.ajax({
                url : BASEURL + '/admin/loadGraph',
                type : 'POST',
                data:{
                    '_token': $('meta[name="csrf_token"]').attr('content'),
                    'from': $('#date_from').val(),
                    'to': $('#date_to').val()
                },
                success : function(data){
                    loadChart(data['transaction_date'],data['total']);
                }
            });

    });

    $('#graph-filter_new').on('click',function() {
        $.ajax({
            url : BASEURL + '/admin/loadGraph_new',
            type : 'POST',
            data:{
                '_token': $('meta[name="csrf_token"]').attr('content'),
                'from': $('#date_from_new').val(),
                'to': $('#date_to_new').val()
            },
            success : function(data){
                loadChart_new(data['menu'],data['quantity']);
            }
        });

    });

    function loadChart(dataLabel,dataList){
        var myChart = new Chart($('#myChart'), {
            type: 'bar',
            data: {
                labels: dataLabel,
                datasets: [{
                    data: dataList,
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                showTooltips: false
            }
        });

        myChart.canvas.parentNode.style.height = '400px';
    }

    function loadChart_new(dataLabel,dataList){
        var myChart_new = new Chart($('#myChart_new'), {
            type: 'bar',
            data: {
                labels: dataLabel,
                datasets: [{
                    data: dataList,
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                showTooltips: false
            }
        });

        myChart_new.canvas.parentNode.style.height = '400px';
    }
})