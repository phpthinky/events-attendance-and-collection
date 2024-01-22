<!DOCTYPE html>
<html lang="en"  manifest="sbtourism/index.php/scanner/guest">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QRCODE Scanner</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>/template/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>/template/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    

</head>
<body>
<h1>Events QRCODE scanner</h1>
<div class="row">
    <div class="col-lg-4 col-md-12 col-xs-12" >
    <label>Scan you qrcode here!</label>

    <div id="qr-reader"></div>
        
    </div>
    <div class="col-lg-4 col-md-12 col-xs-12" >
        <label>Scan result</label>
        <div id="qr-reader-results"></div>
        
    </div>
</div>

    <!-- jQuery -->
    <script src="<?=base_url()?>/template/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url()?>/template/gentelella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/assets/plugins/html5-qrcode/html5-qrcode.min.js"></script>

<script type="text/javascript">
	var resultContainer = document.getElementById('qr-reader-results');
var lastResult, countResults = 0;

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;
        // Handle on success condition with the decoded message.
        console.log(`Scan result ${decodedText}`, decodedResult);
        resultContainer.text(decodedText)
        //localStorage.setItem('tourist') = decodedText;
        //console.log(tourist)
       // alert(decodedText)
       /// tourist.push(decodedText)
        //localStorage.setItem("tourist",JSON.stringgify(tourist));

    }
}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);

</script>
</body>
</html>