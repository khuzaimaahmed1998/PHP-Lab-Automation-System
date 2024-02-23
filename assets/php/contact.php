<?php
// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Recipient email address
    $to = "info@labautomation.com";
    
    // Email subject
    $subject = "Message from $name";
    
    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    
    // Email headers
    $headers = "From: $name <$email>";
    
    // Send email and check if it's sent successfully
    if (mail($to, $subject, $email_content, $headers)) {
        // Display success message and redirect to main page
        echo "<script>alert('Thank you for contacting us, $name. Your message has been sent successfully.')</script>";
        header("Location: main.php");
        exit;
    } else {
        // Display error message if email sending fails
        echo "<script>alert('Sorry, there was an error sending your message. Please try again later.')</script>";
    }
}
?>
