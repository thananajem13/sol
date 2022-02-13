<?php
require_once 'config.php';
require 'vendor/autoload.php'; 
/* first new */ 
$productDetails = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if( !empty($_POST['fullname']) && !empty($_POST['telephone']) && !empty($_POST['notes'] && !empty($_POST['productLink'])) && !empty($_POST['productDesc'])){

    $fullName = "FullName: ".$_POST['fullname'].".<br>";
    $telephone = "Telephone: ".$_POST['telephone'].".<br>";  
    $notes = "Notes: ".$_POST['notes'].".<br>";   
    foreach(array_combine($_POST['productLink'], $_POST['productDesc']) as $productLink => $productDesc){
        $productDetails .=  
        "
        <dl>
            <dt>".$productLink."</dt>
            <dd>".$productDesc."</dd>
        </dl>
        "; 
    }  
    $email = new \SendGrid\Mail\Mail(); 
$email->setFrom("mohammad.Ballout51088@gmail.com", "ballout ballout");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("mohammad.ballout1310@gmail.com", "Example User");
 
$email->addContent(
    "text/html", $fullName.$telephone.$notes.$productDetails
); 
$sendgrid = new \SendGrid(SENDGRID_API_KEY);
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
    }
}


/* last new */
 
?>