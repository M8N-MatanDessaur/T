<?php
session_start();

// Remove the cart object from the session
    unset($_SESSION['cart']);
    session_destroy();


header('Location: ../index.php');
exit;
?>