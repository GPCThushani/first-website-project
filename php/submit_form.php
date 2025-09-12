<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create 'data' folder if it doesn't exist
    $folder = "data";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    // Detect form by a hidden input called 'form_type' in your forms
    if (!isset($_POST['form_type'])) {
        echo "Form type not specified.";
        exit;
    }

    $form_type = $_POST['form_type'];

    // Set file name based on form type
    $file_map = [
        'delivery' => 'delivery_data.txt',
        'event' => 'event_reservation_data.txt',
        'booking' => 'booking_data.txt',
        'daycation' => 'daycation_data.txt',
        'forgot_password' => 'forgot_password_requests.txt',
        'gift_voucher' => 'gift_vouchers.txt',
        'inquiry' => 'inquiries.txt',
        'login' => 'logins.txt',
        'order_tracking' => 'order_tracking.txt',
        'spa' => 'spa_reservations.txt',
        'signup' => 'signups.txt',
        'subscribe' => 'subscriptions.txt',
        'wedding' => 'wedding_reservations.txt'
    ];

    if (!array_key_exists($form_type, $file_map)) {
        echo "Unknown form type.";
        exit;
    }

    $file = $folder . "/" . $file_map[$form_type];

    // Prepare a data string
    $data = "Submission Time: " . date("Y-m-d H:i:s") . "\n";

    foreach ($_POST as $key => $value) {
        if ($key == 'form_type') continue; // skip form_type field

        // Handle arrays (like checkboxes)
        if (is_array($value)) {
            $value = implode(", ", $value);
        }

        $data .= "$key: $value\n";
    }

    $data .= "--------------------------\n";

    // Save data to the respective file
    file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

    // Confirmation message
    echo "<h2>Thank you! Your form has been submitted successfully.</h2>";
    echo "<p><a href='index.html'>Back to Home</a></p>";

} else {
    echo "Invalid request.";
}
?>
