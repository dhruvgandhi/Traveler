<!--<html>
    <head>
        <title>Merchant Check Out Page</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
        <form method="post" action="https://securegw-stage.paytm.in/theia/processTransaction?ORDER_ID=order1" name="f1">
            <table border="1">
                <tbody>
                    <input type="hidden" name="MID" value="rxazcv89315285244163">
                    <input type="hidden" name="WEBSITE" value="WEBSTAGING">
                    <input type="hidden" name="ORDER_ID" value="order1">
                    <input type="hidden" name="CUST_ID" value="cust123">
                    <input type="hidden" name="MOBILE_NO" value="7777777777">
                    <input type="hidden" name="EMAIL" value="username@emailprovider.com">
                    <input type="hidden" name="INDUSTRY_TYPE_ID" value="Retail">
                    <input type="hidden" name="CHANNEL_ID" value="WEB">
                    <input type="hidden" name="TXN_AMOUNT" value="100.12">
                    <input type="hidden" name="CALLBACK_URL" value="https://Merchant_Response_URL>">
                    <input type="hidden" name="CHECKSUMHASH" value="ZWdMJOr1yGiFh1nns2U8sDC9VzgUDHVnQpG
                    pVnHyrrPb6bthwro1Z8AREUKdUR/K46x3XvFs6Xv7EnoSOLZT29qbZJKXXvyEuEWQIJGkw=">
                </tbody>
            </table>
        <script type="text/javascript">
            document.f1.submit();
        </script>
        </form>
    </body>
</html> -->

<?php
    require_once("encdec_paytm.php");
    define("merchantMid", "rxazcv89315285244163");
    // Key in your staging and production MID available in your dashboard
    define("merchantKey", "gKpu7IKaLSbkchFS");
    // Key in your staging and production merchant key available in your dashboard
    define("orderId", "order1");
    define("channelId", "WEB");
    define("custId", "cust123");
    define("mobileNo", "7777777777");
    define("email", "username@emailprovider.com");
    define("txnAmount", "100.12");
    define("website", "WEBSTAGING");
    // This is the staging value. Production value is available in your dashboard
    define("industryTypeId", "Retail");
    // This is the staging value. Production value is available in your dashboard
    define("callbackUrl", "https://<Merchant_Response_URL>");
    $paytmParams = array();
    $paytmParams["MID"] = merchantMid;
    $paytmParams["ORDER_ID"] = orderId;
    $paytmParams["CUST_ID"] = custId;
    $paytmParams["MOBILE_NO"] = mobileNo;
    $paytmParams["EMAIL"] = email;
    $paytmParams["CHANNEL_ID"] = channelId;
    $paytmParams["TXN_AMOUNT"] = txnAmount;
    $paytmParams["WEBSITE"] = website;
    $paytmParams["INDUSTRY_TYPE_ID"] = industryTypeId;
    $paytmParams["CALLBACK_URL"] = callbackUrl;
    $paytmChecksum = getChecksumFromArray($paytmParams, merchantKey);
    $transactionURL = "https://securegw-stage.paytm.in/theia/processTransaction";
    // $transactionURL = "https://securegw.paytm.in/theia/processTransaction"; // for production
?>
<html>
    <head>
        <title>Merchant Checkout Page</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
        <form method='post' action='<?php echo $transactionURL; ?>' name='f1'>
            <?php
                foreach($paytmParams as $name => $value) {
                    echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                }
            ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $paytmChecksum ?>">
        </form>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </body>
</html>
