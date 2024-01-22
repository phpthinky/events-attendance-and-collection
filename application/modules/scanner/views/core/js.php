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
        tourist.push(decodedText)
        localStorage.setItem("tourist",JSON.stringgify(tourist));

    }
}

var html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);