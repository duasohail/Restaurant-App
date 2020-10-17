
<?php echo $this->session->userdata('fullBill'); ?>

<script>
    window.print();

    setTimeout(function(){
        document.location = '<?php echo site_url('Waiter/Waiter') ?>';
    } , 1000);
</script>
