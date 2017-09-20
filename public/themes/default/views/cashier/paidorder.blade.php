<style>
    .serve{
        background: green;
    }
</style>
<div class="list-box-container">

</div>

<script>
    $(document).ready(function(){

        loadAjax();

        var socket = io.connect('http://127.0.0.1:8080');


        socket.on('new_data', function(msg) {
            loadAjax();
        });



    })

    function loadAjax(){
        var BASEURL = $("#baseURL").val();
        $.ajax({
            url:BASEURL + '/cashier/paidorder-list',
            type: 'GET',
            success: function (data){
                $('.list-box-container').html(data);
            }
        });
    }
</script>

