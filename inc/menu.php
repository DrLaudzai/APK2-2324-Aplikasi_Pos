<?php
@$pages =$_GET['pages'];
switch ($pages) {
    case 'user_admin':
        include '../pages/user admin/user_admin.php';
        break;
    
    case 'user_petugas':
        include '../pages/user petugas/user_petugas.php';
        break;
        
    default:
    include '../pages/master/dashboard.php';
    break;
}

?>