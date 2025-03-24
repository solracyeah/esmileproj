// get_payment_image.php
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esmile_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get payment ID from request
    $paymentId = isset($_GET['payment_id']) ? $_GET['payment_id'] : null;
    
    if (!$paymentId) {
        throw new Exception('Payment ID is required');
    }
    
    // Query to get image path from database
    $stmt = $conn->prepare("SELECT payment_screenshot FROM payments WHERE id = ?");
    $stmt->execute([$paymentId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result && $result['payment_screenshot']) {
        $imagePath = 'newesmile/patient/uploads/payments/' . $result['payment_screenshot'];
        
        // Check if file exists
        if (file_exists($imagePath)) {
            // Get image content type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $contentType = finfo_file($finfo, $imagePath);
            finfo_close($finfo);
            
            // Set proper headers
            header('Content-Type: ' . $contentType);
            header('Content-Length: ' . filesize($imagePath));
            
            // Output image
            readfile($imagePath);
            exit;
        } else {
            throw new Exception('Image file not found');
        }
    } else {
        throw new Exception('Image record not found in database');
    }
    
} catch (Exception $e) {
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => $e->getMessage()]);
}
?>



// HTML Button Example
<button id="proofOfPaymentBtn" data-payment-id="123">View Payment Proof</button>
<img id="paymentScreenshot" src="default-image.png" alt="Payment Screenshot" />