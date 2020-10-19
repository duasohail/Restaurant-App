<center class="table_bill" style="margin-top: 10px;">
<h1>Cancle Report</h1>

<table class='w-100 mt-3 bg-light table  text-center'  style='text-align:left'>
 
    <?php echo $this->session->userdata('cancle_report'); ?>
</table>
</center>
<script>
        
    window.print();

    setTimeout(function(){
        document.location = '<?php echo site_url('Admin/Admin') ?>';
    } , 1000);
</script>
