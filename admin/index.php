<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "foodform";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM formdata ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Panel - Form Submissions</title>
<style>
  body {
    margin: 0; padding: 30px;
    background: #121212;
    color: #00ffcc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  h1 {
    text-align: center;
    margin-bottom: 30px;
    text-shadow: 0 0 10px #00ffcc;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    animation: fadeIn 1s ease forwards;
  }
  th, td {
    padding: 12px 15px;
    border: 1px solid #333;
  }
  th {
    background-color: #222;
  }
  tr:nth-child(even) {
    background-color: #1f1f1f;
  }
  tr:hover {
    background-color: #333;
    transition: background-color 0.3s ease;
  }
  a.logout-btn {
    display: inline-block;
    margin-top: 20px;
    background: #00ffcc;
    color: #000;
    padding: 12px 22px;
    border-radius: 8px;
    font-weight: bold;
    text-decoration: none;
    box-shadow: 0 0 10px #00ffcc;
    transition: background 0.3s ease;
  }
  a.logout-btn:hover {
    background: #00ccaa;
  }
  @keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
  }
</style>
</head>
<body>

<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

<table>
  <thead>
    <tr>
      <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Service</th><th>Message</th><th>Submitted On</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".htmlspecialchars($row['id'])."</td>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".htmlspecialchars($row['phone'])."</td>
                <td>".htmlspecialchars($row['service'])."</td>
                <td>".htmlspecialchars($row['message'])."</td>
                <td>".htmlspecialchars($row['created_at'])."</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='7'>No submissions found</td></tr>";
    }
    $conn->close();
    ?>
  </tbody>
</table>

<a href="logout.php" class="logout-btn">Logout</a>

</body>
</html>
