<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--<html>
                   <head>
                              <script>
                                 window.onload = function() {
                                 var d = new Date().getTime();
                                document.getElementById("tid").value = d;
                                     };
                              </script>
                     </head>
          <body>
        <form method="POST" name="customerData" action="<?php echo base_url('dashboard/cc-avenue/ccavRequestHandler'); ?>">
                                    <input type="hidden" name="tid" id="tid"  />
                <input type="hidden" name="merchant_id" value="your merchent id"/>
                <input type="hidden" name="payment_option" value="OPTNBK">  
                <input type="hidden" name="order_id" value="123654789"/>
                <input type="hidden" name="merchant_param1" value="your custom value"/>
                <input type="hidden" name="merchant_param2" value="7"/>
                <input type="hidden" name="amount" value="10"/>
                <input type="hidden" name="currency" value="USD"/>
                <input type="hidden" name="redirect_url" value="<?php  echo base_url('dashboard/ccAve_payment_done');?>"/>
                <input type="hidden" name="cancel_url" value="<?php  echo base_url('dashboard/ccAce_cancel_payment');?>"/>
                <input type="hidden" name="billing_name" value="Sreejith"/>

       </form>
    <script language='javascript'>document.customerData.submit();</script>
  </body>
</html>-->