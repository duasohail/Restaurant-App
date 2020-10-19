<div class="container-flex pt-3" style="background-color:#b5192e;">

    <div class="row no-gutters pt-4 bg-dark">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <h3 class="text-center text-light">Reporting Section</h3>
        </div>
    </div>

    <div class="row no-gutters pt-4 bg-dark text-center">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
        <a  href="<?= site_url('Admin/Admin/cancel_view') ?>"><button class="btn btn-danger mr-1" >Cancel Orders Report</button></a>
            <!-- <button class="btn btn-danger mr-1" >Sales Report</button> -->
            <hr class="align-cneter" width="50%">
        </div>
    </div>

    <!-- section for sales and reports -->

    <div class="row no-gutters text-white pt-4 bg-dark text-center sales">
        <h1 class="col-12 mt-2">Sales Report</h1>
        <div class="col-sm-4 col-lg-4 col-xl-4 offset-sm-4 offset-lg-4 offset-xl-4  ">
            <input type="date" class="form-control m-auto" name="s_d" id="s_d" value="">
        </div>
        <!-- <div class="col-sm-3 col-lg-3 col-xl-3  ">
            <input type="date" name="e_d" id="e_d" class="form-control m-auto" value="">

        </div> -->
        <div class="col-sm-6 mt-2 col-lg-6 col-xl-6  offset-sm-3 offset-lg-3 offset-xl-3 ">
            <button class="btn btn-danger btn_go">Go</button>
        </div>
        <div class="col-sm-6 mt-2 col-lg-6 col-xl-6  offset-sm-3 offset-lg-3 offset-xl-3 ">
            <button class="btn btn-danger btn_print">Print</button>
        </div>
    </div>
</div>

<table class='w-100 mt-3 bg-light table text-center sales_report_table'>
    

</table>

<script>
    $(document).ready(function() {

        $('.btn_go').click(function() {
            var s_d = $('#s_d').val();
            var e_d = '';
            


            $.ajax({

                url: "<?php echo site_url("Admin/Admin/get_sales_report"); ?>",
                type: "POST",
                data: {
                    s_d:s_d,
                    e_d:e_d
                },
                cache: false,
                success: function(data) {
                    $('.sales_report_table').empty();
                    $('.sales_report_table').append(data);
                    
                }

            });
        });


        $('.btn_print').click(function(){
            document.location = "<?php echo site_url('Admin/Admin/print_sales') ?>";
        });

    });
</script>