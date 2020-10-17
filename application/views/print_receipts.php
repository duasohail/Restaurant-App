<?php

$len = $this->session->userdata('len');

$beforeEditLen = $this->session->userdata('beforeEditLen');

date_default_timezone_set("Asia/Karachi");

if ($this->session->userdata('size_array')[$len - 1] == 1) {
    $size = '';
} else {
    $size = ' (' . $this->session->userdata('size_array')[$len - 1] . ')';
}

$dataPrint = '';

if ($beforeEditLen > 0) {
    if ($len > $beforeEditLen) {
        $dataPrint .=   '
            <center>
            <table width="290" align="center" border="1" style="border-collapse:collapse;">
            <tr class="mb-2 >
                <td  colspan="6" align="center" " style="border-left: 1px inset #fff;border-right: 1px inset #fff;border-top: 1px inset #fff;">
                    <img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />			
                </td>
            </tr>
            <tr>
                    <th colspan="4" style="text-align: center;border-bottom: 1px inset #fff;"> ' . $this->session->userdata('waiter') . '' . $beforeEditLen . '' . $len . '</th>
                </tr>
                <tr border="0">
                    <th colspan="2" style="text-align: left;border-right: 1px inset #fff;">' . date("d M, Y") . '</th>
                    <th colspan="2" style="text-align: right;">' . date("h:ia") . '</th>
                </tr>
        
                <tr>
                    <th colspan="4" style="text-align: center;border-top: 1px solid #000;">';

        if ($this->session->userdata('type') == "2") {
            $dataPrint .= 'Delivery Order #' . $this->session->userdata('order_no');
        } else if ($this->session->userdata('type') == "3") {
            $dataPrint .= 'Take Away Order #' . $this->session->userdata('order_no');
        } else {

            $dataPrint .= 'Table #' . $this->session->userdata('table');
        }

        $dataPrint .= '</th>
                </tr>
        
        
                <tr>
                    <th colspan="3" style="text-align: left;">Item name</th>
                    
                    <th   style="text-align: center;">Qty</th>
                </tr>
        
                <tr>
                    <th colspan="3" style="text-align: left;">' . $this->session->userdata('item_array')[$len - 1] . '' . $size . '</th>
                    
                    <th   style="text-align: center;">' . $this->session->userdata('qty_array')[$len - 1] . '</th>
                </tr>
                
                <tr style=" >
                <td colspan="4" style="text-align: left;border-bottom: 1px solid #fff;border-right: 1px solid #000;"><br></td>
                </tr>
                
                <tr style="">
                <td colspan="4" style="text-align: center;border-top: 1px solid #fff;border-right: 1px solid #000;">______________________________</td>
                </tr>
                
            </table>
            
        </center>
            
            ';

        echo  $dataPrint;
        $this->session->set_userdata('len', $len - 1);
    }


    if ($this->session->userdata('fullTable') == true) {
        $fullTable = '
        <center>
        <table width="290" align="center" border="1" style="border-collapse:collapse;">
        <tr class="mb-2 >
            <td  colspan="6" align="center" " style="border-left: 1px inset #fff;border-right: 1px inset #fff;border-top: 1px inset #fff;">
                <img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />			
            </td>
        </tr>
            <tr>
                    <th colspan="4" style="text-align: center;border-bottom: 1px inset #fff;"> ' . $this->session->userdata('waiter') . '</th>
                </tr>
                <tr border="0">
                    <th colspan="2" style="text-align: left;border-right: 1px inset #fff;">' . date("d M, Y") . '</th>
                    <th colspan="2" style="text-align: right;">' . date("h:ia") . '</th>
                </tr>
        
                <tr>
                    <th colspan="4" style="text-align: center;border-top: 1px solid #000;">';


        if ($this->session->userdata('type') == "2") {
            $fullTable .= 'Delivery Order #' . $this->session->userdata('order_no');
        } else if ($this->session->userdata('type') == "3") {
            $fullTable .= 'Take Away Order #' . $this->session->userdata('order_no');
        } else {

            $fullTable .= 'Table #' . $this->session->userdata('table');
        }


        $fullTable .= '</th>
                </tr>
        
        
                <tr>
                    <th colspan="3" style="text-align: left;">Item name</th>
                    <th style="text-align: center;">Qty</th>
                </tr>';

        for ($i = 0; $i < $len; $i++) {
            if ($this->session->userdata('size_array')[$i] == 1) {
                $size = '';
            } else {
                $size = ' (' . $this->session->userdata('size_array')[$len - 1] . ')';
            }
            $fullTable .= '<tr>
                        <th colspan="3" style="text-align: left;">' . $this->session->userdata('item_array')[$i] . '' . $size . '</th>
                    
                        <th   style="text-align: center;">' . $this->session->userdata('qty_array')[$i] . '</th>
                    </tr>';
        }


        $fullTable .= '
                <tr>
                    <td colspan="4" style="text-align: left;border-bottom: 1px solid #fff;border-right: 1px solid #000;"><br></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;border-top: 1px solid #fff;border-right: 1px solid #000;">______________________________</td>
                </tr>
                
            </table>
            
        </center>
            
            ';

        $this->session->set_userdata('fullBill', $fullTable);
    }
}else{
    if ($len > 0) {
        $dataPrint .=   '
            <center>
            <table width="290" align="center" border="1" style="border-collapse:collapse;">
            <tr class="mb-2 >
                <td  colspan="6" align="center" " style="border-left: 1px inset #fff;border-right: 1px inset #fff;border-top: 1px inset #fff;">
                    <img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />			
                </td>
            </tr>
            <tr>
                    <th colspan="4" style="text-align: center;border-bottom: 1px inset #fff;"> ' . $this->session->userdata('waiter').'</th>
                </tr>
                <tr border="0">
                    <th colspan="2" style="text-align: left;border-right: 1px inset #fff;">' . date("d M, Y") . '</th>
                    <th colspan="2" style="text-align: right;">' . date("h:ia") . '</th>
                </tr>
        
                <tr>
                    <th colspan="4" style="text-align: center;border-top: 1px solid #000;">';

        if ($this->session->userdata('type') == "2") {
            $dataPrint .= 'Delivery Order #' . $this->session->userdata('order_no');
        } else if ($this->session->userdata('type') == "3") {
            $dataPrint .= 'Take Away Order #' . $this->session->userdata('order_no');
        } else {

            $dataPrint .= 'Table #' . $this->session->userdata('table');
        }

        $dataPrint .= '</th>
                </tr>
        
        
                <tr>
                    <th colspan="3" style="text-align: left;">Item name</th>
                    
                    <th   style="text-align: center;">Qty</th>
                </tr>
        
                <tr>
                    <th colspan="3" style="text-align: left;">' . $this->session->userdata('item_array')[$len - 1] . '' . $size . '</th>
                    
                    <th   style="text-align: center;">' . $this->session->userdata('qty_array')[$len - 1] . '</th>
                </tr>
                
                <tr style=" >
                <td colspan="4" style="text-align: left;border-bottom: 1px solid #fff;border-right: 1px solid #000;"><br></td>
                </tr>
                
                <tr style="">
                <td colspan="4" style="text-align: center;border-top: 1px solid #fff;border-right: 1px solid #000;">______________________________</td>
                </tr>
                
            </table>
            
        </center>
            
            ';

        echo  $dataPrint;
        $this->session->set_userdata('len', $len - 1);
    }


    if ($this->session->userdata('fullTable') == true) {
        $fullTable = '
        <center>
        <table width="290" align="center" border="1" style="border-collapse:collapse;">
        <tr class="mb-2 >
            <td  colspan="6" align="center" " style="border-left: 1px inset #fff;border-right: 1px inset #fff;border-top: 1px inset #fff;">
                <img  src="http://127.0.0.1/Restaurant/assets/img/logo.jpg" style="width: 280px;height: 70px;" class=" mt-2 mb-2" />			
            </td>
        </tr>
            <tr>
                    <th colspan="4" style="text-align: center;border-bottom: 1px inset #fff;"> ' . $this->session->userdata('waiter') . '</th>
                </tr>
                <tr border="0">
                    <th colspan="2" style="text-align: left;border-right: 1px inset #fff;">' . date("d M, Y") . '</th>
                    <th colspan="2" style="text-align: right;">' . date("h:ia") . '</th>
                </tr>
        
                <tr>
                    <th colspan="4" style="text-align: center;border-top: 1px solid #000;">';


        if ($this->session->userdata('type') == "2") {
            $fullTable .= 'Delivery Order #' . $this->session->userdata('order_no');
        } else if ($this->session->userdata('type') == "3") {
            $fullTable .= 'Take Away Order #' . $this->session->userdata('order_no');
        } else {

            $fullTable .= 'Table #' . $this->session->userdata('table');
        }


        $fullTable .= '</th>
                </tr>
        
        
                <tr>
                    <th colspan="3" style="text-align: left;">Item name</th>
                    <th style="text-align: center;">Qty</th>
                </tr>';

        for ($i = 0; $i < $len; $i++) {
            if ($this->session->userdata('size_array')[$i] == 1) {
                $size = '';
            } else {
                $size = ' (' . $this->session->userdata('size_array')[$len - 1] . ')';
            }
            $fullTable .= '<tr>
                        <th colspan="3" style="text-align: left;">' . $this->session->userdata('item_array')[$i] . '' . $size . '</th>
                    
                        <th   style="text-align: center;">' . $this->session->userdata('qty_array')[$i] . '</th>
                    </tr>';
        }


        $fullTable .= '
                <tr>
                    <td colspan="4" style="text-align: left;border-bottom: 1px solid #fff;border-right: 1px solid #000;"><br></td>
                </tr>
                
                <tr>
                    <td colspan="4" style="text-align: center;border-top: 1px solid #fff;border-right: 1px solid #000;">______________________________</td>
                </tr>
                
            </table>
            
        </center>
            
            ';

        $this->session->set_userdata('fullBill', $fullTable);
    }
}


?>

<script>
    <?php
    if ($beforeEditLen > 0) {
        if ($len > $beforeEditLen) {
    ?>
            window.print();
            setTimeout(function() {
                location.reload();

                <?php $this->session->set_userdata('fullTable', false); ?>
            }, 800);
        <?php
        } else {
            $this->session->set_userdata('beforeEditLen', 0);
        ?>

            document.location = '<?php echo site_url('Waiter/Waiter/printFullOrder') ?>';
    <?php
        }
    }else{
        if ($len > 0) {
            ?>
                    window.print();
                    setTimeout(function() {
                        location.reload();
        
                        <?php $this->session->set_userdata('fullTable', false); ?>
                    }, 800);
                <?php
                } else {
                    $this->session->set_userdata('beforeEditLen', 0);
                ?>
        
                    document.location = '<?php echo site_url('Waiter/Waiter/printFullOrder') ?>';
            <?php
                }
    }
    ?>
</script>