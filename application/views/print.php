<center class="table_bill" style="margin-top: 10px;">
    <?php echo $this->session->userdata('bill'); ?>
</center>
<script>
        
    window.print();

    setTimeout(function(){
        document.location = '<?php echo site_url('Counter/Counter') ?>';
    } , 1000);
</script>
