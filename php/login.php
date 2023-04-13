<?php
    require_once('../classes/Database.class.php');
    require_once('../classes/Tea.class.php');
    require_once('../classes/User.class.php');
    require_once('../classes/AdminUser.class.php');
    require_once('../classes/Cart.class.php');
    ?>
<?php
// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Search for user in database
$user = User::findByEmailAndPassword($email, $password);

if ($user == null) {
    // Show error message
    // ...
} else {
    if($user->verifyAdmin()){
        session_start();
        $_SESSION['user'] = $user;
        header('Location:../admin.php');
        exit;
    }
    else{
    // If user is found and password is correct, log them in
    session_start();
    $_SESSION['user'] = $user;
    $_SESSION['cart'] =  new Cart();
    unset($_SESSION['cart']);

    // Redirect to dashboard
    header('Location:../shop.php');
    exit;
    }
}
?>
