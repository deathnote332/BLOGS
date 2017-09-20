{!! Theme::asset()->usePath()->add('order-css','/css/kitchen/order.css') !!}
{!! Theme::asset()->usePath()->add('socket-io','/js/components/socket.io.js') !!}
<div class="list-box-container">

</div>

<script>
    var BASEURL = $("#baseURL").val();
    $(document).ready(function(){



//        var socket = io.connect('http://127.0.0.1:8080');
        loadAjax();

//        socket.on('new_data', function(msg) {
//            loadAjax();
//        });

        function loadAjax(){
            $.ajax({
                url:BASEURL + '/switch-ajax-transaction',
                type: 'GET',
                success: function (data){
                    $('.list-box-container').html(data);
                }
            });
        }


        $('body').on('click','.box',function(){
            var id = $(this).data('id');
            swal({
                title: "Are you sure?",
                text: "You want to finish this menu.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: 'Okay',
                closeOnConfirm: false
            }).then(function () {
                $.ajax({
                    url: BASEURL + '/kitchen/finish_order',
                    type: 'POST',
                    data:{
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        id: id
                    },
                    success: function (data){

                        swal({
                            title: "",
                            text: "Order serve",
                            type:"success"
                        }).then(function () {
                            loadAjax()
                        });

                    }
                });
            });
        })
    })
</script>