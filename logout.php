<?php 
require 'config/function.php';


if(isset($_SESSION['loggedIn'])){
    logoutSession();
    redirect('login.php', 'You have been logged out successfully.');

}
    
?>