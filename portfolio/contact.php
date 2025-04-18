<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name    = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    
    if (empty($name) || empty($email) || empty($message)) {
        $response = "Please fill out all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = "Please enter a valid email address.";
    } else {
        
        $to      = "sravanpulluru7@gmail.com"; 
        $subject = "New Contact Message from $name";
        $body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        
        if (mail($to, $subject, $body, $headers)) {
            $response = "Thank you! Your message has been sent.";
        } else {
            $response = "Sorry, something went wrong. Please try again later.";
        }
    }
} else {
    $response = "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Response</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .message-box {
      max-width: 600px;
      margin: 100px auto;
      padding: 30px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.1);
      text-align: center;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(6.5px);
      border: 1px solid rgba(255, 255, 255, 0.18);
    }
    .btn-back {
      margin-top: 20px;
      background-color: white;
      color: #6a11cb;
      font-weight: bold;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <div class="message-box">
    <h2>Message Status</h2>
    <p><?= $response ?></p>
    <a href="contact.php" class="btn-back">Go Back</a>
  </div>
</body>
</html>
