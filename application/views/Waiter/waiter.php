<style>
    .rounded-circle {
        border-radius: 50% !important;
    }
</style>
<div class="container-fluid bg-dark" style="background-size: cover;">

    <div class="row">
        <div class="col-lg-3 text-left">
            <img src="<?php echo base_url('assets/img/logo2.jpg') ?>" style="width: 200px;height: 42px;" class="text-left mt-3 ml-5" />
            <hr>
        </div>

        <div class="col-lg-9 mt-1" style="float: center; text-align: center;">
            <?php foreach ($categories_data as $category) { ?>
                <!-- F5B900 -->
                <button class="btn mt-3  text-white" id="cat_<?php echo $category['id'] ?>" style="background-color: #B5192E;"><?php echo  $category['cat_name'] ?></button>
            <?php } ?>
            <hr>
        </div>
    </div>

    <div class="row m-1 ">
        <div class="col-lg-5 ">
            <div class="row shadow card bg-dark">
                
                <h3 class=" mb-2 mt-2" style="width: 100%;text-align: center; color:#fff" id="table_head">Table #</h3>

                <div class="text-center ">
                    <?php
                    foreach ($tables_data as $table) {
                        if ($table['current_status'] == 1) {
                    ?>
                            <button class="rounded-circle bg-danger btn text-white text-center p-2 mb-1 mr-1" id="table_<?php echo $table['table_num']; ?>">
                                <?php if ($table['id'] < 10) {
                                    echo '0';
                                }
                                echo $table['table_num'] ?>
                            </button>
                        <?php
                        } else {
                        ?>
                            <button class="rounded-circle bg-light btn text-dark text-center p-2 mb-1 mr-1" id="table_<?php echo $table['table_num']; ?>">
                                <?php if ($table['id'] < 10) {
                                    echo '0';
                                }
                                echo $table['table_num'] ?>
                            </button>
                    <?php
                        }
                    } ?>

                </div>

                <hr>

                <div class="row">
                    <!-- <h5 class=" mb-2 mt-2" style="width: 100%;text-align: center; color:#fff" id="table_head">Served By</h5> -->

                    <!-- <div class="col-6 offset-3 form-group">
                        <select id="waiter_name" class="form-control" name="waiter_name">
                            <option>Select Waiter</option>
                            <option>Waiter 2</option>
                            <option>Waiter 3</option>
                            <option>Waiter 4</option>
                        </select>
                    </div> -->

                </div>


                <div class="card bg-dark w-100 mt-1">

                    <table class="table_order_summary bg-dark text-white rounded  w-100" cellpadding="1">
                        <tr>
                            <th class="text-center p-2">Item Name</th>
                            <th class="text-center p-2">Size</th>
                            <th class="text-center p-2">Qty</th>
                            <th class="text-center p-2">Amount</th>
                            <th class="text-center p-2">Actions</th>
                        </tr>

                    </table>


                    <table class="table_order_total bg-dark mt-4 text-white rounded w-100" cellpadding="1">

                        <tr>
                            <th width="50%" class="text-center">Total</th>
                            <th width="50%" class="text-center" id="total_price">0</th>
                        </tr>
                        <tr>
                            <th class="text-center p-2" width="50%"><Button class="form-control btn btn-danger" id="btn_confirm" style="width: 100%; height: 100%;" class="btn-sm btn-success">Confirm Order</Button></th>

                            <th class="text-center p-2" width="50%"><Button class="form-control btn btn-danger" id="btn_cancle" style="width: 100%; height: 100%;" class="btn-sm btn-danger">Cancle Order</Button></th>
                        </tr>

                        <tr class="mt-5">

                            <th class="text-center p-2 " colspan="2" width="100%"><Button class="form-control btn btn-danger" id="btn_bill" style="width: 100%; height: 100%;" class="btn-sm btn-danger">Bill Management</Button></th>
                        </tr>

                    </table>



                </div>

            </div>
        </div>
        <div class="col-lg-7 " style="margin-top: 10px;">

            <div class="row menu_list">

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#btn_bill').click(function() {
            document.location = '<?php echo site_url('counter/counter') ?>';
        });

        $('#cat_' + 1).css('background-color', '#F5B900');

        <?php foreach ($categories_data as $category) { ?>
            $('#cat_' + <?php echo $category['id']; ?>).click(function() {

                var id = $(this).attr('id');
                id = id.split('_')[1];
                for (i = 1; i <= 100; i++) {
                    if (id == i) {
                        $('#cat_' + i).css('background-color', '#F5B900');
                    } else {
                        $('#cat_' + i).css('background-color', '#B5192E');
                    }
                }
                $.ajax({
                    url: "<?php echo site_url("Waiter/Waiter/update_menu"); ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    cache: false,
                    success: function(menu) {
                        // alert(menu);
                        $('.menu_list').empty();
                        $('.menu_list').append(menu);

                        $('.menu_list').children('div').each(function(i) {
                            var id = $(this).attr('id');
                            // alert(id);
                            $('#' + id).click(function() {
                                var id = $(this).attr('id');
                                id = id.split('_')[1];

                                $.ajax({
                                    url: "<?php echo site_url("Waiter/Waiter/update_current_order"); ?>",
                                    type: "POST",
                                    data: {
                                        id: id
                                    },
                                    cache: false,
                                    success: function(data) {
                                        $('.table_order_summary').append(data);

                                        for (i = 1; i <= 250; i++) {

                                            $('.btn_delete_' + i).click(function() {
                                                var uid = $(this).attr('title');


                                                // id = i
                                                $('.table_order_summary').children('tbody').children('.item_unique_' + uid).remove();

                                                var total = 0;

                                                for (i = 1; i <= 250; i++) {

                                                    if ($('.item_amount_' + i).html() != null) {
                                                        amount = $('.item_amount_' + i).html();
                                                        total += parseInt(amount);
                                                    }
                                                };



                                                if (total > 0) {
                                                    $('#total_price').html('' + total);
                                                } else {
                                                    $('#total_price').html('0');
                                                }

                                            });
                                        }

                                        for (i = 1; i <= 250; i++) {

                                            $('.item_size_' + i).change(function() {

                                                var id = $(this).attr('id');
                                                var uid = $(this).attr('title');

                                                id = id.split('_')[2];

                                                // alert(id);

                                                var currentSize = $(this).val();
                                                var qty = $('.item_qty_' + uid).val();


                                                $.ajax({
                                                    url: "<?php echo site_url("Waiter/Waiter/get_price"); ?>",
                                                    type: "POST",
                                                    data: {
                                                        id: id,
                                                        currentSize: currentSize
                                                    },
                                                    cache: false,
                                                    success: function(price) {
                                                        var amount = parseInt(price) * parseInt(qty);

                                                        if (amount > 0) {
                                                            $('.item_amount_' + uid).html('' + amount);
                                                        } else {
                                                            $('.item_amount_' + uid).html('0');
                                                        }

                                                        var total = 0;

                                                        for (i = 1; i <= 250; i++) {

                                                            if ($('.item_amount_' + i).html() != null) {
                                                                amount = $('.item_amount_' + i).html();
                                                                total += parseInt(amount);
                                                            }
                                                        };



                                                        if (total > 0) {
                                                            $('#total_price').html('' + total);
                                                        } else {
                                                            $('#total_price').html('0');
                                                        }


                                                    }
                                                });

                                            });
                                        }


                                        for (i = 1; i <= 250; i++) {
                                            $('.item_qty_' + i).on("keyup", function() {
                                                var id = $(this).attr('id');
                                                var uid = $(this).attr('title');
                                                id = id.split('_')[2];
                                                var currentSize = $('.item_size_' + uid).val();
                                                var qty = $(this).val();

                                                $.ajax({
                                                    url: "<?php echo site_url("Waiter/Waiter/get_price"); ?>",
                                                    type: "POST",
                                                    data: {
                                                        id: id,
                                                        currentSize: currentSize
                                                    },
                                                    cache: false,
                                                    success: function(price) {
                                                        var amount = parseInt(price) * parseInt(qty);

                                                        if (amount > 0) {
                                                            $('.item_amount_' + uid).html('' + amount);
                                                        } else {
                                                            $('.item_amount_' + uid).html('0');
                                                        }

                                                        var total = 0;

                                                        for (i = 1; i <= 250; i++) {

                                                            if ($('.item_amount_' + i).html() != null) {
                                                                amount = $('.item_amount_' + i).html();
                                                                total += parseInt(amount);
                                                            }
                                                        };



                                                        if (total > 0) {
                                                            $('#total_price').html('' + total);
                                                        } else {
                                                            $('#total_price').html('0');
                                                        }
                                                    }
                                                });

                                            });
                                        }
                                    }

                                });
                            });
                        });
                    }

                });
            });
        <?php } ?>

        <?php foreach ($tables_data as $table) { ?>
            $('#table_' + <?php echo $table['id']; ?>).click(function() {
                $('#total_price').html('0');
                // $('.table_order_summary').children('tbody').children('.item_to_delete').remove();

                if ($(this).hasClass('bg-danger')) {

                    var id = $(this).attr('id');
                    id = id.split('_')[1];
                    var current_value = $('#table_head').html('Table #' + id);


                    changeAllOthersButKeepThisYellow(id);

                    $.ajax({
                        url: '<?php echo site_url("Waiter/Waiter/edit_order"); ?>',
                        type: 'POST',
                        cache: false,
                        data: {
                            table_no: id
                        },
                        success: function(result) {
                            $('#total_price').html('0');
                            $('.table_order_summary').children('tbody').children('.item_to_delete').remove();
                            $('.table_order_summary').children('tbody').append(result);

                            var total = 0;

                            for (i = 1; i <= 250; i++) {

                                if ($('.item_amount_' + i).html() != null) {
                                    amount = $('.item_amount_' + i).html();
                                    total += parseInt(amount);
                                }
                            };



                            if (total > 0) {
                                $('#total_price').html('' + total);
                            } else {
                                $('#total_price').html('0');
                            }

                            for (i = 1; i <= 250; i++) {

                                $('.btn_delete_' + i).click(function() {
                                    var uid = $(this).attr('title');


                                    // id = i
                                    $('.table_order_summary').children('tbody').children('.item_unique_' + uid).remove();

                                    var total = 0;

                                    for (i = 1; i <= 250; i++) {

                                        if ($('.item_amount_' + i).html() != null) {
                                            amount = $('.item_amount_' + i).html();
                                            total += parseInt(amount);
                                        }
                                    };



                                    if (total > 0) {
                                        $('#total_price').html('' + total);
                                    } else {
                                        $('#total_price').html('0');
                                    }

                                });
                            }

                            for (i = 1; i <= 250; i++) {

                                $('.item_size_' + i).change(function() {

                                    var id = $(this).attr('id');
                                    var uid = $(this).attr('title');

                                    id = id.split('_')[2];

                                    // alert(id);

                                    var currentSize = $(this).val();
                                    var qty = $('.item_qty_' + uid).val();


                                    $.ajax({
                                        url: "<?php echo site_url("Waiter/Waiter/get_price"); ?>",
                                        type: "POST",
                                        data: {
                                            id: id,
                                            currentSize: currentSize
                                        },
                                        cache: false,
                                        success: function(price) {
                                            var amount = parseInt(price) * parseInt(qty);

                                            if (amount > 0) {
                                                $('.item_amount_' + uid).html('' + amount);
                                            } else {
                                                $('.item_amount_' + uid).html('0');
                                            }

                                            var total = 0;

                                            for (i = 1; i <= 250; i++) {

                                                if ($('.item_amount_' + i).html() != null) {
                                                    amount = $('.item_amount_' + i).html();
                                                    total += parseInt(amount);
                                                }
                                            };



                                            if (total > 0) {
                                                $('#total_price').html('' + total);
                                            } else {
                                                $('#total_price').html('0');
                                            }


                                        }
                                    });

                                });
                            }


                            for (i = 1; i <= 250; i++) {
                                $('.item_qty_' + i).on("keyup", function() {
                                    var id = $(this).attr('id');
                                    var uid = $(this).attr('title');
                                    id = id.split('_')[2];
                                    var currentSize = $('.item_size_' + uid).val();
                                    var qty = $(this).val();
                                    alert(currentSize);
                                    alert(qty);
                                    alert(uid);
                                    $.ajax({
                                        url: "<?php echo site_url("Waiter/Waiter/get_price"); ?>",
                                        type: "POST",
                                        data: {
                                            id: id,
                                            currentSize: currentSize
                                        },
                                        cache: false,
                                        success: function(price) {
                                            var amount = parseInt(price) * parseInt(qty);

                                            if (amount > 0) {
                                                $('.item_amount_' + uid).html('' + amount);
                                            } else {
                                                $('.item_amount_' + uid).html('0');
                                            }

                                            var total = 0;

                                            for (i = 1; i <= 250; i++) {

                                                if ($('.item_amount_' + i).html() != null) {
                                                    amount = $('.item_amount_' + i).html();
                                                    total += parseInt(amount);
                                                }
                                            };



                                            if (total > 0) {
                                                $('#total_price').html('' + total);
                                            } else {
                                                $('#total_price').html('0');
                                            }
                                        }
                                    });

                                });
                            }

                        }
                    });

                } else {

                    var id = $(this).attr('id');
                    id = id.split('_')[1];
                    var current_value = $('#table_head').html('Table #' + id);

                    changeAllOthersButKeepThisYellow(id);
                }



            });
        <?php } ?>


        function changeAllOthersButKeepThisYellow(id) {

            for (i = 1; i <= 100; i++) {
                if (id == i) {
                    $('#table_' + i).removeClass('bg-light');
                    $('#table_' + i).css('background-color', '#F5B900');
                } else if ($('#table_' + i).hasClass('bg-danger')) {

                } else {
                    $('#table_' + i).addClass('bg-light');
                }
            }
        }


        $('#btn_cancle').click(function() {
            $('#total_price').html('0');
            $('.table_order_summary').children('tbody').children('.item_to_delete').remove();
        });

        $('#btn_confirm').click(function() {
            var current_table = $('#table_head').html();

            if (current_table != 'Table #') {

                var order_items = $('.table_order_summary').children('tbody').children().length;

                if (order_items > 1) {
                    var qtyValid = true;

                    var itemNameData = '';
                    var qtyData = '';
                    var sizeData = '';
                    var amountData = '';
                    var totalAmount = 0;
                    var firstItem = true;



                    for (i = 1; i <= 50; i++) {
                        if ($('.item_unique_' + i).html() != null) {
                            if (firstItem) {
                                itemNameData += '' + $('.item_name_' + i).html();
                                sizeData += '' + $('.item_size_' + i).val();
                                qtyData += '' + $('.item_qty_' + i).val();
                                amountData += '' + $('.item_amount_' + i).html();
                                totalAmount += parseInt($('.item_amount_' + i).html());

                                firstItem = false;
                            } else {
                                itemNameData += ',' + $('.item_name_' + i).html();
                                sizeData += ',' + $('.item_size_' + i).val();
                                qtyData += ',' + $('.item_qty_' + i).val();
                                amountData += ',' + $('.item_amount_' + i).html();
                                totalAmount += parseInt($('.item_amount_' + i).html());
                            }


                            // Check If Any Quantity Is Less Than 0;
                            var qty = $('.item_qty_' + i).val();
                            if (qty < 1) {
                                qtyValid = false;
                            }
                        }
                    }

                    if (qtyValid) {
                        current_table = current_table.split('#')[1];

                        $.ajax({
                            url: '<?php echo site_url("Waiter/Waiter/insert_current_order"); ?>',
                            type: 'POST',
                            cache: false,
                            data: {
                                current_table: current_table,
                                itemNameData: itemNameData,
                                sizeData: sizeData,
                                qtyData: qtyData,
                                amountData: amountData,
                                totalAmount: totalAmount
                            },
                            success: function(result) {
                                // alert('Order Has Been Placed');

                                $('#total_price').html('0');
                                $('.table_order_summary').children('tbody').children('.item_to_delete').remove();
                                $('#table_head').html('Table #');

                                $('#table_' + current_table).removeClass('bg-light');
                                $('#table_' + current_table).addClass('bg-danger');
                                // $('#table_' + current_table).prop('disabled' , 'true');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Order Has Been Placed',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });


                    } else {
                        alert('All Quantities Must Be Greater Than 0');
                    }
                } else {
                    alert('Please Add Order Items To Continue!!!');
                }
            } else {
                alert('Select Table To Continue!!!');
            }
        });



        //GETTING FIRST MENU DATA

        $.ajax({
            url: "<?php echo site_url("Waiter/Waiter/update_menu"); ?>",
            type: "POST",
            data: {
                id: 1
            },
            cache: false,
            success: function(menu) {
                // alert(menu);
                $('.menu_list').empty();
                $('.menu_list').append(menu);

                $('.menu_list').children('div').each(function(i) {
                    var id = $(this).attr('id');
                    // alert(id);
                    $('#' + id).click(function() {
                        var id = $(this).attr('id');
                        id = id.split('_')[1];

                        $.ajax({
                            url: "<?php echo site_url("Waiter/Waiter/update_current_order"); ?>",
                            type: "POST",
                            data: {
                                id: id
                            },
                            cache: false,
                            success: function(data) {
                                $('.table_order_summary').append(data);

                                for (i = 1; i <= 250; i++) {

                                    $('.btn_delete_' + i).click(function() {
                                        var uid = $(this).attr('title');


                                        // id = i
                                        $('.table_order_summary').children('tbody').children('.item_unique_' + uid).remove();

                                        var total = 0;

                                        for (i = 1; i <= 250; i++) {

                                            if ($('.item_amount_' + i).html() != null) {
                                                amount = $('.item_amount_' + i).html();
                                                total += parseInt(amount);
                                            }
                                        };



                                        if (total > 0) {
                                            $('#total_price').html('' + total);
                                        } else {
                                            $('#total_price').html('0');
                                        }

                                    });
                                }

                                for (i = 1; i <= 250; i++) {

                                    $('.item_size_' + i).change(function() {

                                        var id = $(this).attr('id');
                                        var uid = $(this).attr('title');

                                        id = id.split('_')[2];

                                        // alert(id);

                                        var currentSize = $(this).val();
                                        var qty = $('.item_qty_' + uid).val();


                                        $.ajax({
                                            url: "<?php echo site_url("Waiter/Waiter/get_price"); ?>",
                                            type: "POST",
                                            data: {
                                                id: id,
                                                currentSize: currentSize
                                            },
                                            cache: false,
                                            success: function(price) {
                                                var amount = parseInt(price) * parseInt(qty);

                                                if (amount > 0) {
                                                    $('.item_amount_' + uid).html('' + amount);
                                                } else {
                                                    $('.item_amount_' + uid).html('0');
                                                }

                                                var total = 0;

                                                for (i = 1; i <= 250; i++) {

                                                    if ($('.item_amount_' + i).html() != null) {
                                                        amount = $('.item_amount_' + i).html();
                                                        total += parseInt(amount);
                                                    }
                                                };



                                                if (total > 0) {
                                                    $('#total_price').html('' + total);
                                                } else {
                                                    $('#total_price').html('0');
                                                }


                                            }
                                        });

                                    });
                                }


                                for (i = 1; i <= 250; i++) {
                                    $('.item_qty_' + i).on("keyup", function() {
                                        var id = $(this).attr('id');
                                        var uid = $(this).attr('title');
                                        id = id.split('_')[2];
                                        var currentSize = $('.item_size_' + uid).val();
                                        var qty = $(this).val();

                                        $.ajax({
                                            url: "<?php echo site_url("Waiter/Waiter/get_price"); ?>",
                                            type: "POST",
                                            data: {
                                                id: id,
                                                currentSize: currentSize
                                            },
                                            cache: false,
                                            success: function(price) {
                                                var amount = parseInt(price) * parseInt(qty);

                                                if (amount > 0) {
                                                    $('.item_amount_' + uid).html('' + amount);
                                                } else {
                                                    $('.item_amount_' + uid).html('0');
                                                }

                                                var total = 0;

                                                for (i = 1; i <= 250; i++) {

                                                    if ($('.item_amount_' + i).html() != null) {
                                                        amount = $('.item_amount_' + i).html();
                                                        total += parseInt(amount);
                                                    }
                                                };



                                                if (total > 0) {
                                                    $('#total_price').html('' + total);
                                                } else {
                                                    $('#total_price').html('0');
                                                }
                                            }
                                        });

                                    });
                                }
                            }

                        });
                    });
                });
            }

        });

    });
</script>