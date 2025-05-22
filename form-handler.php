<?php
// Debug errors show karne ke liye (development ke liye)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection details
$host = "localhost";       // Local XAMPP me localhost
$user = "root";            // Default root user
$password = "";            // XAMPP me blank password hota hai
$dbname = "foodform";      // Tera database name

// Database connection banaye
$conn = new mysqli($host, $user, $password, $dbname);

// Connection check karo
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form se data lo safely (POST method)
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$service = $_POST['service'] ?? '';
$message = $_POST['message'] ?? '';

// Prepared statement for security (SQL Injection se bachav)
$stmt = $conn->prepare("INSERT INTO formdata (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $service, $message);

// Execute karo aur result check karo
if ($stmt->execute()) {
    // Agar success to yeh HTML page dikhao — black background + message + animation + button
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Thank You!</title>
      <style>
        body {
          margin: 0;
          height: 100vh;
          background-color: #000;  /* Black background */
          display: flex;
          justify-content: center;
          align-items: center;
          color: #0f0;  /* Neon green text */
          font-family: 'Arial', sans-serif;
          text-align: center;
          animation: fadeIn 2s ease forwards;
          flex-direction: column;
        }
        h1 {
          font-size: 3rem;
          margin-bottom: 0.5rem;
          animation: bounce 1.5s infinite alternate;
        }
        p {
          font-size: 1.5rem;
          color: #ccc;
          margin-top: 0;
          margin-bottom: 20px;
        }
        button {
          background-color: #0f0;
          color: #000;
          border: none;
          padding: 12px 25px;
          font-size: 1.1rem;
          cursor: pointer;
          border-radius: 5px;
          transition: background-color 0.3s ease;
        }
        button:hover {
          background-color: #0c0;
        }

        @keyframes bounce {
          0% { transform: translateY(0); }
          100% { transform: translateY(-20px); }
        }
        @keyframes fadeIn {
          from {opacity: 0;}
          to {opacity: 1;}
        }
      </style>
    </head>
    <body>
      <div>
        <h1>Thank You! 🎉</h1>
        <p>Your form was submitted successfully.</p>
        <button onclick="window.location.href='index.html'">Back to Home</button>
      </div>
    </body>
    </html>
    <?php
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
