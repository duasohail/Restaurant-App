<!-- <h1>in Kitchen Section</h1> -->

<style>
</style>
<div class="container-flex pt-3" style="background-color:#b5192e;">
    <div class="row no-gutters pt-5 pl-5 pr-5 bg-dark">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
            <h3 class="text-center text-light">Current Orders</h3>
        </div>
    </div>
    <div class="row no-gutters pt-5 pl-5 pr-5 bg-dark">
        <div class="col-sm-12 col-lg-12 col-xl-12 ">
           <table class="table text-light bg-dark" >
                <tr>
                    <td class="text-light">Table</td>
                    <td class="text-light">Items</td>
                    <td class="text-light">Quantity</td>
                    <td class="text-light">Size</td>
                    <td class="text-light">Status</td>
                    <td class="text-light"></td>
                </tr>
                <?php 
 
                    foreach($order as $row){
                        $r_id=$row['id'];
                        //print_r($row);
                        $it = $row['items'];
                        $items= explode(",",$it);
                        //print_r($items);
                        $quan = $row['quantity'];
                        $quantities= explode(",",$quan);
                        $sz = $row['size'];
                        $newStatus = $row['status'];
                        $sizes= explode(",",$sz);
                    
                ?>
                <tr>
                    <td class="text-light"><?php echo $row['table_no'];?></td>
                       
                    <td class="text-light">
                     <?php foreach($items as $item){  
                         echo $item.'<br>';
                     }?>
                    </td>
                    <td class="text-light">
                    <?php foreach($quantities as $quantity){  
                         echo $quantity.'<br>';
                     }?>
                    </td>
                    <td class="text-light">
                    <?php foreach($sizes as $size){  
                         echo $size.'<br>';
                     }?>
                    </td>
                    <?php $status=$this->session->userdata('status');?>
                    <td class="text-light" id="change<?php echo $r_id;?>"><?php echo $newStatus;?></td>
                    <td class="text-light">
                    <?php 
                    echo  form_open('kitchen/Kitchen/status_change' ,  'id="schedule", name="schedule"');
                    echo "<input type='hidden' name='table_no' value='".$row['table_no']."' >";
                    echo "<input class='btn btn-sm btn-danger' id='ready".$r_id."' value='Cooking' type='submit' name='ready".$r_id."' onclick='status_change(".$r_id.")'></form><br>";
                         
                    
                    echo  form_open('kitchen/Kitchen/status_change_ready' ,  'id="schedule", name="schedule"');
                         echo "<input type='hidden' name='table_no' value='".$row['table_no']."' >";
                         echo "<input class='btn btn-sm btn-danger' id='ready".$r_id."' value='Ready' type='submit' name='ready".$r_id."' onclick='status_change(".$r_id.")'></form><br>";
                    
                        //  echo "<input class='btn btn-sm btn-danger' id='ready".$r_id."' value='".$status."' type='submit' name='ready".$r_id."' onclick='status_change(".$r_id.")'></form><br>";
                     
             
                    ?>
                    <!-- <input class="btn btn-sm btn-danger" id="ready<?php echo $r_id;?>" onclick="status_change(<?php echo $r_id; ?>)" type="button" name="ready" value="cooking"></td> -->
                </tr>
                    <?php }?>
           </table>

        </div>
    </div>

</div>
<script>
    
    $(document).ready(function() {

       
        setInterval(function(){
            location.reload();
        }, 5000);
});
</script>