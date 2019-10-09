<?php 

//Display the badge status for the user
 function display_badge($user) {
    switch($user) {
        case 'approved':
            echo "badge-success";
            break;
        case 'pending':
            echo 'badge-info';
            break;
        case 'rejected':
            echo 'badge-danger';
            break;
        case 'administrator':
            echo 'badge-primary';
            break;
        case 'user':
            echo 'badge-info';
            break;
        case 'librarian':
            echo 'badge-succes';
            break;           
         default:
            echo "";           
    }
 }

 function check_page() {
    if(basename($_SERVER['PHP_SELF'],".php") == 'login') {
        echo "library_bg";
    }
 }
?>