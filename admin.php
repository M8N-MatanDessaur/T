<?php ini_set('display_errors', 0);
require_once './autoloader.php'; // Load classes
session_start();

// Check if user connected is an Admin
if (!isset($_SESSION['user']) || !$_SESSION['user']->verifyAdmin()) {
    header('Location: ./login.php');
}

// Fetch product data from database
$db = new Database();
$connection = $db->getConnection();

$query = $connection->prepare("SELECT * FROM teas");
$query->execute();
$result = $query->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/awsm.css/dist/awsm.min.css">
    <link rel="stylesheet" href="./assets//styles/AdminStyle.css">
    <title>T&nbsp;&nbsp;|&nbsp;&nbsp;Admin Page</title>
</head>

<body>
    <div class="dead-center">
        <?php include('./views/Identification.php') ?>
        <button class="asclient" onclick="window.location.href = './shop.php'">as client</button>
        <h1>Admin Panel</h1>
        <div style="position:relative;">
            <a href="#addProd" class="add-btn">Add Product</a>
            <?php include('./views/admintable.php') ?>
        </div>
    </div>
    <?php include('./views/adminaddform.php') ?>
    <script src="./assets/scripts/editProduceInputLive.js"></script>
</body>

</html>