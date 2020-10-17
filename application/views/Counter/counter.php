<!-- <h1>in Kitchen Section</h1> -->

<style>
</style>
<div class="container-flex pt-3 " style="background-color:#b5192e;">

    <div class="row table_buttons bg-dark no-gutters pt-5 pl-5 pr-5 bg-light text-center">
        <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <button class="btn btn-danger w-25 bg-warning text-dark" id="btn_tables">Tables</button>
                    <button class="btn btn-danger w-25 " id="btn_delivery">Delivery</button>
                    <button class="btn btn-danger w-25 " id="btn_takeaway">Take Away</button>
                </div>
            </div>
            <div class="row show_items text-center">

            </div>
            <hr>

        </div>
    </div>
    <div class="row no-gutters pt-5 pl-5 pr-5 bg-dark">

        <div class="col-sm-12 col-lg-12 col-xl-12  ">
            <center class="table_bill">



            </center>

        </div>

    </div>

</div>

<button style='width:40%; margin-left: 30%;' class='btn btn-sm mt-3 btn-danger text-black button print_btn center'>Print Tendor Bill</button><br><br>
<button style='width:40%;margin-left: 30%;' class='btn  btn-sm mt-3 btn-danger text-black button cancle_btn center'>Cancle Order</button>


<!-- <script> -->

<!-- </script> -->
<!-- <script>
function status_change(e){
         var uid=e;
         document.getElementById("change"+uid).innerHTML="ready";
         document.getElementById("ready"+uid).disabled=true;
         
        // document.getElementById("ready"+e).disabled=True;


}
</script> -->

<script>
    $(document).ready(function() {

        var table = 0;
        var order_no = 0;
        var type = 1;
        var dis = 0;


        $('.print_btn').click(function() {
            if (type == 1) {
                if (table > 0) {

                    $.ajax({
                        url: "<?php echo site_url("Counter/Counter/del_order"); ?>",
                        type: "POST",
                        data: {
                            table: table,
                            dis:dis
                        },
                        cache: false,
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Table Is Free Now',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            setTimeout(function() {
                                document.location = "<?php echo site_url('Counter/Counter') ?>"
                            }, 1500);
                        }
                    });
                }
            } else {
                if (order_no > 0) {
                    $.ajax({
                        url: "<?php echo site_url("Counter/Counter/del_order_by_order_number"); ?>",
                        type: "POST",
                        data: {
                            order_no: order_no,
                            dis:dis
                        },
                        cache: false,
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Succeffully Done!!!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            setTimeout(function() {
                                document.location = "<?php echo site_url('Counter/Counter') ?>"
                            }, 1500);
                        }
                    });
                }
            }

            document.location = '<?php echo site_url('PagePrint') ?>';
        });

        $('.delete_btn').click(function() {

            if (type == 1) {
                if (table > 0) {

                    $.ajax({
                        url: "<?php echo site_url("Counter/Counter/del_order"); ?>",
                        type: "POST",
                        data: {
                            table: table
                        },
                        cache: false,
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Table Is Free Now',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            setTimeout(function() {
                                document.location = "<?php echo site_url('Counter/Counter') ?>"
                            }, 1500);
                        }
                    });
                }
            } else {
                if (order_no > 0) {
                    $.ajax({
                        url: "<?php echo site_url("Counter/Counter/del_order_by_order_number"); ?>",
                        type: "POST",
                        data: {
                            order_no: order_no
                        },
                        cache: false,
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Succeffully Done!!!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            setTimeout(function() {
                                document.location = "<?php echo site_url('Counter/Counter') ?>"
                            }, 1500);
                        }
                    });
                }
            }


        });

        $('.cancle_btn').click(function() {

            if (type == 1) {
                if (table > 0) {

                    $.ajax({
                        url: "<?php echo site_url("Counter/Counter/cancle_order_by_table"); ?>",
                        type: "POST",
                        data: {
                            table_no: table
                        },
                        cache: false,
                        success: function(data) {
                            document.location = '<?php echo site_url('PagePrint') ?>';
                        }
                    });
                }
            } else {
                if (order_no > 0) {
                    $.ajax({
                        url: "<?php echo site_url("Counter/Counter/cancle_order_by_order_number"); ?>",
                        type: "POST",
                        data: {
                            order_no: order_no
                        },
                        cache: false,
                        success: function(data) {
                            document.location = '<?php echo site_url('PagePrint') ?>';
                        }
                    });
                }
            }


        });

        <?php foreach ($tables_data as $k) { ?>
            $('#table_' + <?php echo $k['id']; ?>).click(function() {
                var id = $(this).attr('id');
                id = id.split('_')[1];
                table = id;
                var current_value = $('#table_head').html('Table #' + id);

                $.ajax({
                    url: "<?php echo site_url("Counter/Counter/update_table_order"); ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(data) {
                        $('.table_bill').empty();
                        $('.table_bill').append(data);

                    }
                });

            });
        <?php } ?>

        $('#btn_tables').click(function() {
            type = 1;
            $('.table_bill').empty();

            makeButtonAction(1);

            $.ajax({
                url: '<?php echo site_url('Counter/Counter/get_tablesData') ?>',
                type: 'POST',
                success: function(res) {
                    // alert(res);
                    $('.show_items').empty();
                    $('.show_items').append(res);

                    for (var i = 1; i <= 1000; i++) {
                        $('#table_' + i).click(function() {
                            var id = $(this).attr('id');
                            id = id.split('_')[1];
                            // alert(id);
                            table = id;


                            var current_value = $('#table_head').html('Table #' + id);

                            $.ajax({
                                url: "<?php echo site_url("Counter/Counter/update_table_order"); ?>",
                                type: "POST",
                                data: {
                                    id: id
                                },
                                cache: false,
                                success: function(data) {
                                    $('.table_bill').empty();
                                    $('.table_bill').append(data);

                                    $("html, body").animate({
                                        scrollTop: $(document).height() - $(window).height()
                                    });
                                    setTimeout(function() {
                                        var amountPaid = prompt('Enter Amount Paid By Customer');
                                        var discount = prompt('Enter Discount In %');


                                        if (Number.isInteger(parseInt(amountPaid))) {
                                            if (Number.isInteger(parseInt(discount))) {

                                                dis  = discount;
                                                $.ajax({
                                                    url: "<?php echo site_url("Counter/Counter/updated_table_order"); ?>",
                                                    type: "POST",
                                                    data: {
                                                        id: id,
                                                        amountPaid: amountPaid,
                                                        discount: discount
                                                    },
                                                    cache: false,
                                                    success: function(data) {
                                                        $('.table_bill').empty();
                                                        $('.table_bill').append(data);

                                                    }
                                                });

                                            } else {
                                                alert('Discount Must Be A Number');
                                            }
                                        } else {
                                            alert('Amount Must Be A Number');
                                        }






                                    }, 500);

                                }
                            });
                        });
                    }
                }
            });
        });
        $('#btn_delivery').click(function() {
            type = 2;
            $('.table_bill').empty();

            makeButtonAction(2);


            $.ajax({
                url: '<?php echo site_url('Counter/Counter/get_deliveryData') ?>',
                type: 'POST',
                success: function(res) {
                    $('.show_items').empty();
                    $('.show_items').append(res);

                    var start = $(".orders_list").children(":first").html();
                    var end = $(".orders_list").children(":last").html();

                    for (var i = start - 1; i <= end; i++) {
                        $('#order_' + i).click(function() {

                            var id = $(this).attr('id');
                            id = id.split('_')[1];

                            order_no = id;

                            $.ajax({
                                url: "<?php echo site_url("Counter/Counter/update_delivery_order"); ?>",
                                type: "POST",
                                data: {
                                    order_id: order_no
                                },
                                cache: false,
                                success: function(data) {
                                    $('.table_bill').empty();
                                    $('.table_bill').append(data);

                                    $("html, body").animate({
                                        scrollTop: $(document).height() - $(window).height()
                                    });
                                    setTimeout(function() {
                                        var amountPaid = prompt('Enter Amount Paid By Customer');
                                        var discount = prompt('Enter Discount In %');

                                        if (Number.isInteger(parseInt(amountPaid))) {
                                            if (Number.isInteger(parseInt(discount))) {
                                                dis  = discount;

                                                $.ajax({
                                                    url: "<?php echo site_url("Counter/Counter/updated_delivery_order"); ?>",
                                                    type: "POST",
                                                    data: {
                                                        order_id: order_no,
                                                        amountPaid: amountPaid,
                                                        discount: discount
                                                    },
                                                    cache: false,
                                                    success: function(data) {
                                                        $('.table_bill').empty();
                                                        $('.table_bill').append(data);
                                                    }
                                                });

                                            } else {
                                                alert('Discount Must Be A Number');
                                            }
                                        } else {
                                            alert('Amount Must Be A Number');
                                        }
                                    }, 500);




                                }
                            });
                        });
                    }

                }
            });

        });
        $('#btn_takeaway').click(function() {
            $('.table_bill').empty();

            type = 2;
            makeButtonAction(3);


            $.ajax({
                url: '<?php echo site_url('Counter/Counter/get_takeAwayData') ?>',
                type: 'POST',
                success: function(res) {
                    $('.show_items').empty();
                    $('.show_items').append(res);

                    var start = $(".orders_list").children(":first").html();
                    var end = $(".orders_list").children(":last").html();

                    for (var i = start - 1; i <= end; i++) {
                        $('#order_' + i).click(function() {
                            // alert('start = ' + start);


                            var id = $(this).attr('id');
                            id = id.split('_')[1];


                            order_no = id;

                            $.ajax({
                                url: "<?php echo site_url("Counter/Counter/update_takeaway_order"); ?>",
                                type: "POST",
                                data: {
                                    order_id: order_no
                                },
                                cache: false,
                                success: function(data) {
                                    $('.table_bill').empty();
                                    $('.table_bill').append(data);

                                    $("html, body").animate({
                                        scrollTop: $(document).height() - $(window).height()
                                    });
                                    setTimeout(function() {
                                        var amountPaid = prompt('Enter Amount Paid By Customer');
                                        var discount = prompt('Enter Discount In %');

                                        if (Number.isInteger(parseInt(amountPaid))) {
                                            if (Number.isInteger(parseInt(discount))) {
                                                dis  = discount;

                                                $.ajax({
                                                    url: "<?php echo site_url("Counter/Counter/updated_takeaway_order"); ?>",
                                                    type: "POST",
                                                    data: {
                                                        order_id: order_no,
                                                        amountPaid: amountPaid,
                                                        discount: discount
                                                    },
                                                    cache: false,
                                                    success: function(data) {
                                                        $('.table_bill').empty();
                                                        $('.table_bill').append(data);
                                                    }
                                                });

                                            } else {
                                                alert('Discount Must Be A Number');
                                            }
                                        } else {
                                            alert('Amount Must Be A Number');
                                        }
                                    }, 500);

                                }
                            });

                        });
                    }
                }
            });
        });


        function makeButtonAction(num) {
            if (num == 1) {

                $('#btn_tables').addClass('bg-warning');
                $('#btn_tables').addClass('text-dark');

                $('#btn_delivery').removeClass('bg-warning');
                $('#btn_delivery').removeClass('text-dark');

                $('#btn_takeaway').removeClass('bg-warning');
                $('#btn_takeaway').removeClass('text-dark');
            } else if (num == 2) {

                $('#btn_delivery').addClass('bg-warning');
                $('#btn_delivery').addClass('text-dark');

                $('#btn_tables').removeClass('bg-warning');
                $('#btn_tables').removeClass('text-dark');

                $('#btn_takeaway').removeClass('bg-warning');
                $('#btn_takeaway').removeClass('text-dark');
            } else if (num == 3) {

                $('#btn_takeaway').addClass('bg-warning');
                $('#btn_takeaway').addClass('text-dark');

                $('#btn_delivery').removeClass('bg-warning');
                $('#btn_delivery').removeClass('text-dark');

                $('#btn_tables').removeClass('bg-warning');
                $('#btn_tables').removeClass('text-dark');
            }


        }

        //First Time Gets Tables Data

        $.ajax({
            url: '<?php echo site_url('Counter/Counter/get_tablesData') ?>',
            type: 'POST',
            success: function(res) {

                type = 1;

                $('.show_items').empty();
                $('.show_items').append(res);

                for (var i = 1; i <= 1000; i++) {
                    $('#table_' + i).click(function() {
                        var id = $(this).attr('id');
                        id = id.split('_')[1];
                        // alert(id);
                        table = id;


                        var current_value = $('#table_head').html('Table #' + id);

                        $.ajax({
                            url: "<?php echo site_url("Counter/Counter/update_table_order"); ?>",
                            type: "POST",
                            data: {
                                id: id
                            },
                            cache: false,
                            success: function(data) {
                                $('.table_bill').empty();
                                $('.table_bill').append(data);

                                $("html, body").animate({
                                    scrollTop: $(document).height() - $(window).height()
                                });
                                setTimeout(function() {
                                    var amountPaid = prompt('Enter Amount Paid By Customer');
                                    var discount = prompt('Enter Discount In %');

                                    if (Number.isInteger(parseInt(amountPaid))) {
                                        if (Number.isInteger(parseInt(discount))) {
                                            dis  = discount;


                                            $.ajax({
                                                url: "<?php echo site_url("Counter/Counter/updated_table_order"); ?>",
                                                type: "POST",
                                                data: {
                                                    id: id,
                                                    amountPaid: amountPaid,
                                                    discount: discount
                                                },
                                                cache: false,
                                                success: function(data) {
                                                    $('.table_bill').empty();
                                                    $('.table_bill').append(data);
                                                    // document.location = '<?php echo site_url('PagePrint') ?>';

                                                }
                                            });

                                        } else {
                                            alert('Discount Must Be A Number');
                                        }
                                    } else {
                                        alert('Amount Must Be A Number');
                                    }

                                }, 500);

                            }
                        });
                    });
                }
            }
        });

    });
</script>