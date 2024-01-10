<?php
if (isset($_GET['act']) && $_GET['act'] == 'excel') {
    // Generate Excel content (sample content for demonstration)
    $excelContent = "Sample Excel Content"; // Replace this with your actual Excel content or generation logic

    // Save Excel content to a file
    $file = 'export.xls';
    file_put_contents($file, $excelContent);

    // Email configuration
    $to = 'recipient@example.com'; // Replace with recipient's email
    $subject = 'Excel Export';
    $message = 'Please find the Excel file attached.';

    // Email headers to specify attachment
    $headers = "From: sender@example.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
    
    // File attachment
    $attachment = chunk_split(base64_encode(file_get_contents($file)));
    $headers .= "--boundary\r\n";
    $headers .= "Content-Type: application/octet-stream; name=\"" . basename($file) . "\"\r\n";
    $headers .= "Content-Transfer-Encoding: base64\r\n";
    $headers .= "Content-Disposition: attachment\r\n\r\n";
    $headers .= $attachment . "\r\n";
    $headers .= "--boundary--";

    // Send email
    $success = mail($to, $subject, $message, $headers);

    // Check if mail sent successfully
    if ($success) {
        echo "Email sent successfully.";
    } else {
        echo "Error sending email.";
    }

    // Remove the generated file
    unlink($file);
    exit; // Stop further script execution after sending the email
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>devbanban</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5">			
                <table border="1" class="table table-hover">
                    <thead>
                        <tr class="info">
                            <th>data1</th>
                            <th>data2</th>
                            <th>data3</th>
                            <th>date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table content -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    // Simulate a click on the export link when the page loads
    document.addEventListener("DOMContentLoaded", function() {
        var link = document.createElement('a');
        link.href = "?act=excel";
        link.click();
    });
</script>
