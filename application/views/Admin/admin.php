<div class="container-flex pt-3" style="background-color:#b5192e;">

    <div class="row no-gutters pt-4 bg-dark">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <h3 class="text-center text-light">Admin Panel</h3>
        </div>
    </div>

    <div class="row no-gutters pt-4 bg-dark text-center">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">

            <button type="submit" class="btn btn-sm btn-danger mr-1" onclick="show_table_sec()">Add Tables</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_category_sec()">Add Category</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_menu_sec()">Add Menu Items</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_price_sec()">Price & Size</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_vendor_sec()">Add_vendor</button>
            <button class="btn btn-sm btn-danger mr-1" onclick="show_report_sec()">Sales Report</button>




            <hr class="align-cneter" width="50%">
        </div>
    </div>

    <!-- section start for add tables -->

    <div class="row no-gutters text-white pt-4 bg-dark add_table">
        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
            <center>
                <?php echo form_open('Admin/Admin/add_table'); ?>
                <div class="card w-75 bg-dark shadow">

                    <div class="card-header">
                        <h3>Add Table</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <input class="form-control" type="text" name="table_no" placeholder="Enter Table No">
                            <br>
                            <!-- <input class="form-control" type="text" name="status" disabled value="0">
                            <span class="text-light" style="font-size:12px;">Whenever you add table Enetr status "0"</span> -->

                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>

                </div>
                </form>
            </center>
        </div>
    </div>

    <div class="row no-gutters text-white pt-4 bg-dark add_table">
        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
            <center>

                <div class="card w-75 bg-dark shadow">

                    <div class="card-header">
                        <h5>Tables</h5>
                    </div>
                    <div class="card-body">

                        <br>
                        <div class="row justify-content-center">
                            <?php
                            foreach ($table as $row) {
                                echo '<div class="col-sm-3 col-lg-3 col-xl-3 col-md-3 bg-danger mt-2 ml-1 p-2" >' . $row['table_num'] . '<button type="submit"  value="' . $row['id'] . '" class="btn btn-sm dlt" style="float:right;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                </button></div>';
                            }

                            ?>
                        </div>

                        <br>
                    </div>
                    <div class="card-footer text-muted">

                    </div>

                </div>

            </center>
        </div>
    </div>


    <!-- section start for category -->

    <div class="row no-gutters text-white pt-4 bg-dark text-center add_category">
        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
            <center>
                <?php echo form_open('Admin/Admin/add_category') ?>
                <div class="card w-75 bg-dark shadow">

                    <div class="card-header">
                        <h3>Add Category</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <input class="form-control" type="text" name="category" placeholder="Enter Category Name">
                            <br>
                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>

                </div>
                </form>
            </center>
        </div>
    </div>


    <div class="row no-gutters text-white pt-4 bg-dark add_category">
        <div class="col-sm-12 col-lg-12 col-xl-12 text-center">
            <center>

                <div class="card w-75 bg-dark shadow">

                    <div class="card-header">
                        <h5>Categories</h5>

                    </div>
                    <div class="card-body">

                        <br>
                        <div class="row justify-content-center">
                            <?php

                            foreach ($category as $row) {
                                echo '<div class="col-sm-3 col-lg-3 col-xl-3 col-md-3 bg-danger mt-2 ml-1 p-2">
                            <span class="item_' . $row['id'] . '">' . $row['cat_name'] . '</span>
                                <button type="submit" class="btn btn-sm cat_edit" value="' . $row['id'] . '" style="float:right;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                                </button>
                                <button type="button" class="btn btn-sm cat_dlt" value="' . $row['id'] . '" style="float:right;">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash text-white" style="font-size:18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                                </button></div>';
                            }

                            ?>
                        </div>

                        <br>
                    </div>
                    <div class="card-footer text-muted">

                    </div>

                </div>

            </center>
        </div>
    </div>


    <!-- section for menu items -->

    <div class="row no-gutters text-white pt-4 bg-dark add_menu">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">

            <center>
                <?php echo form_open_multipart('Admin/Admin/get_menu', 'id="admin1", name="admin1"'); ?>
                <div class="card w-75 bg-dark shadow">

                    <div class="card-header">
                        <h3>Add Menu</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <select class="form-control" id="cat" name="category_name">
                                <?php foreach ($category as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></option>

                                <?php } ?>
                            </select>
                            <br>
                            <input class="form-control" placeholder="enter item" type="text" id="new_item" name="new_item">

                            <br>
                            <input class="form-control" id="item_image" type="file" name="item_image">
                            <br>

                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <input class="btn btn-md btn-danger" id="admin" name="admin" type="submit" value="Submit">
                    </div>

                </div>
                </form>
            </center>
        </div>
    </div>

    <div class="row no-gutters text-white pt-4 bg-dark add_menu">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">

            <center>
                <?php echo form_open('Admin/Admin/add_menu'); ?>
                <div class="card w-75 bg-dark shadow">

                    <div class="card-header">
                        <h3>Menu</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <div>
                                <?php foreach ($category as $row) { ?>
                                    <button id="cat_button<?php echo $u_id = $row['id']; ?>" class="btn btn-danger" value="<?php echo $row['id']; ?>"><?php echo $row['cat_name']; ?></button>

                                <?php  } ?>
                            </div>
                            <br>
                            <div id="show_item"></div>
                            <br>
                        </p>

                    </div>
                    <div class="card-footer text-muted">
                    </div>

                </div>
                </form>
            </center>
        </div>
    </div>

    <!-- section for price and size -->


    <div class="row no-gutters text-white pt-4 bg-dark text-center add_price">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <center>
                <div class="card w-75 bg-dark shadow">
                    <?php form_open() ?>
                    <div class="card-header">
                        <h3>Add Price And Size</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">

                            <select class="form-control" name="category_name">
                                <option>Category Name</option>

                            </select>
                            <br>
                            <select class="form-control" name="item_name">
                                <option>Item Name</option>

                            </select>
                            <br>

                            <input class="form-control" type="text" name="item_name" placeholder="Price">
                            <br>
                            <input class="form-control" type="text" name="item_name" placeholder="Size">
                            <br>

                        </p>

                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-md btn-danger" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </center>
        </div>
    </div>

    <!-- section for vendors -->

    <div class="row no-gutters text-white pt-4 bg-dark text-center vendor">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            Vendors
        </div>
    </div>


    <!-- section for sales and reports -->


    <div class="row no-gutters text-white pt-4 bg-dark text-center sales">
        <div class="col-sm-3 col-lg-3 col-xl-3 offset-sm-3 offset-lg-3 offset-xl-3  ">
            <input type="date" class="form-control m-auto" name="start_data" id="start_date" placeholder="dd-mm-yyyy" value="">
        </div>
        <div class="col-sm-3 col-lg-3 col-xl-3  ">
        <input type="date" name="end_data" id="end_date" class="form-control m-auto" placeholder="dd-mm-yyyy" value="">
            
        </div>
            <div class="col-sm-6 mt-5 col-lg-6 col-xl-6  offset-sm-3 offset-lg-3 offset-xl-3 ">
                <button class="btn btn-danger btn_go">Go</button>
            </div>
    </div>

</div>

<script>
    $(document).ready(function() {



        $('.btn_go').click(function(){


            alert($('#start_data').val());
            alert($('#end_data').val());
        });



        $('.add_table').hide();
        $('.add_category').hide();
        $('.add_menu').hide();
        $('.add_price').hide();
        $('.sales').hide();
        $('.vendor').hide();

        <?php if ($this->session->userdata('isAdded')) { ?>
            Swal.fire({

                position: 'center',
                icon: 'success',
                title: 'Succesfully Done',
                showConfirmButton: false,
                timer: 2000
            });

            <?php $this->session->set_userdata('isAdded', false); ?>


        <?php } ?>

        var cat_id = <?php echo $u_id ?>;
        for (var i = 1; i <= cat_id; i++) {
            //alert(i);
            $('#cat_button' + i).on('click', function() {
                var item = $(this).attr('id');
                var cat_id = $(this).attr('value');

                $.ajax({
                    url: "<?php echo site_url('Admin/Admin/show_menu') ?>",
                    type: "POST",
                    data: {
                        id: cat_id
                    },
                    success: function(responce) {
                        //alert(responce);
                        $('#show_item').empty();
                        $('#show_item').append(responce);
                    }
                });
            });
        }


        $('.dlt').on('click', function() {

            var tbl_id = $(this).attr('value');
            //alert(tbl_id);
            $.ajax({
                url: "<?php echo site_url('Admin/Admin/dlt_table') ?>",
                type: "POST",
                data: {
                    id: tbl_id
                },
                success: function(responce) {
                    window.location.reload();
                }
            });

        });


        $('.cat_dlt').on('click', function() {

            var cat_id = $(this).attr('value');
            //  alert(cat_id);
            $.ajax({
                url: "<?php echo site_url('Admin/Admin/dlt_category') ?>",
                type: "POST",
                data: {
                    id: cat_id
                },
                success: function(responce) {
                    Swal.fire({

                        position: 'center',
                        icon: 'success',
                        title: 'Delete Succesfully Done',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    window.location.reload();
                }
            });

        });

        $('.cat_edit').on('click', function() {

            var edit_id = $(this).attr('value');
            var cat_name = prompt("Enter category name");
            $('.item_' + edit_id).html(cat_name);

            //   alert(edit_id);
            $.ajax({
                url: "<?php echo site_url('Admin/Admin/edit_category') ?>",
                type: "POST",
                data: {
                    id: edit_id,
                    name: cat_name
                },
                success: function(responce) {
                    Swal.fire({

                        position: 'center',
                        icon: 'success',
                        title: 'Edit Succesfully Done',
                        showConfirmButton: false,
                        timer: 2000
                    });

                }
            });

        });



    });





    function show_table_sec() {
        $('.add_table').show();
        $('.add_category').hide();
        $('.add_menu').hide();
        $('.add_price').hide();
        $('.sales').hide();
        $('.vendor').hide();

    }

    function show_category_sec() {
        $('.add_table').hide();
        $('.add_category').show();
        $('.add_menu').hide();
        $('.add_price').hide();
        $('.sales').hide();
        $('.vendor').hide();

    }

    function show_menu_sec() {
        $('.add_table').hide();
        $('.add_category').hide();
        $('.add_menu').show();
        $('.add_price').hide();
        $('.sales').hide();
        $('.vendor').hide();

    }

    function show_price_sec() {
        $('.add_table').hide();
        $('.add_category').hide();
        $('.add_menu').hide();
        $('.add_price').show();
        $('.sales').hide();
        $('.vendor').hide();

    }

    function show_report_sec() {
        $('.add_table').hide();
        $('.add_category').hide();
        $('.add_menu').hide();
        $('.add_price').hide();
        $('.sales').show();
        $('.vendor').hide();
    }

    function show_vendor_sec() {
        $('.add_table').hide();
        $('.add_category').hide();
        $('.add_menu').hide();
        $('.add_price').hide();
        $('.sales').hide();
        $('.vendor').show();

    }
</script>