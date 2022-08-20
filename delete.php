<?php 
    include 'header.php';
    if( isset( $_POST['deletebtn'] ) ){
        $getId = $_POST['sid'];
        require "db.php";
        $condition = array( 'sid' => $getId );
        $delete = new Query;
        $result = $delete->deleteData( 'student',  $condition );

        header( "Location: http://localhost/Core_Project/crud_html/index.php" );
    }
    
?>



<div id="main-content">
    <h2>Delete Record</h2>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="deletebtn" value="Delete" />
    </form>
</div>
</div>
</body>
</html>
