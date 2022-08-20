<?php
    require "db.php";
    if( $_GET['id'] ){
        $getId = $_GET['id'];
    }
    $condition = array( 'sid' => $getId );
    $delete = new Query;
    $result = $delete->deleteData( 'student',  $condition );

    header( "Location: http://localhost/Core_Project/crud_html/index.php" );
    