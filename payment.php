
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
<style>


</style>
    </head>

  <body>
      <?php $server="localhost";
$dbname="Bank";
$user="root";
$password="";
$port=3306;
$connect=mysqli_connect($server,$user,$password,$dbname);
if(!$connect){echo "connecttion failed :".mysqli_connect_error();};
$sql = "SELECT * FROM clients";
  //===================================================================================
//
?>
<div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'blue',
          layout: 'vertical',
          label: 'donate',
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1$ Donation","amount":{"currency_code":"USD","value":1,"breakdown":{"item_total":{"currency_code":"USD","value":1}}},"items":[{"name":"item name","unit_amount":{"currency_code":"USD","value":1},"quantity":"1","category":"DONATION"}]}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>
<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("alrahmanmohamed7@gmail.com","My subject",$msg);
?>
</body>

</html>

        

  

