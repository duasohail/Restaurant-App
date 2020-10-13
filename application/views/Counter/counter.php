<!-- <h1>in Kitchen Section</h1> -->

<style>
</style>
<div class="container-flex pt-3 " style="background-color:#b5192e;">
    <div class="row table_buttons bg-dark no-gutters pt-5 pl-5 pr-5 bg-light text-center">
        <div class="col-sm-12 col-lg-12 col-xl-12">
        <h2 class="text-center text-white mt-1 mb-4">Table#</h2>
        <?php //print_r($data);?>
         <?php
                foreach ($tables_data as $table) {
                    if ($table['current_status'] == 1) {
                ?>
                        <button class="rounded-circle bg-danger btn-sm text-white text-center p-3 mb-1 mr-1" id="table_<?php echo $table['table_num']; ?>"><?php if ($table['id'] < 10) {
                                                                                                                                                                echo '0';
                                                                                                                                                            }
                                                                                                                                                            echo $table['table_num'] ?></button>
                    <?php
                    } else {
                    ?>
                        <!-- <button class="rounded-circle bg-light btn-sm text-dark text-center p-3 mb-1 mr-1" id="table_<?php echo $table['table_num']; ?>"><?php if ($table['id'] < 10) {
                                                                                                                                                                echo '0';
                                                                                                                                                            }
                                                                                                                                                            echo $table['table_num'] ?></button> -->
                <?php
                    }
                } ?>

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

<button style='width:40%; margin-left: 30%;' class='btn btn-sm mt-3 btn-danger text-black button print_btn center'  >Print</button><br><br>
<button style='width:40%;margin-left: 30%;' class='btn  btn-sm btn-danger text-black button delete_btn center'  >Free Table</button>


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
    
        $('.print_btn').click(function(){
            document.location = '<?php echo site_url('PagePrint') ?>';
        });
        $('.delete_btn').click(function(){
            
            if(table > 0){

            $.ajax({
                    url: "<?php echo site_url("Counter/Counter/del_order"); ?>",
                    type: "POST",
                    data: {table:table},
                    cache: false,
                    success: function(data) {
                        Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Table Is Free Now',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                setTimeout(function(){
                                    document.location = "<?php echo site_url('Counter/Counter')?>"
                                }, 1500);
                    }
                });
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
                    data: {id:id},
                    cache: false,
                    success: function(data) {
                        $('.table_bill').empty();
                        $('.table_bill').append(data);
                        
                    }
                });

            });
        <?php } ?>
    });
    
</script>