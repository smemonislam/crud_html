<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Edit Record</h2>
    <form class="post-form" action="" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="stu_id" />
        </div>
        <input class="submit" type="submit" name="showbtn" value="Show" />
    </form>
    <?php 
        if( isset( $_POST['showbtn'] ) ){ 
            $getId = $_POST['stu_id'];
            require "db.php";    
            $condition = array( 'sid' =>  $getId );
            $getData = new Query;
            $result = $getData->getData( 'student', '', '*', $condition );
            if( $result ){
    ?>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="">Name</label>
            <input type="hidden" name="sid"  value="<?php echo $result[0]['sid']; ?>" />
            <input type="text" name="sname" value="<?php echo $result[0]['sname']; ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo $result[0]['saddress']; ?>" />
        </div>
        <div class="form-group">
        <label>Class</label>
        <select name="sclass">
            <option value="" selected disabled>Select Class</option>
            <?php
                    $className = new Query;
                    $result2 = $className->getData( 'studentclass' );
                    foreach( $result2 as $row ){
                        if( $row['cid'] == $result[0]['sclass'] ){
                            $selectd = "selected";
                        }else{
                            $selectd = "";
                        }
                ?>
              <option value="<?php echo $row['cid']; ?>" <?php echo $selectd; ?>><?php echo $row['cname']; ?></option>
              <?php } ?>
        </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" value="<?php echo $result[0]['sphone']; ?>" />
        </div>
    <input class="submit" type="submit" value="Update" name="submit" />
    </form>
    <?php } 
        }
    ?>

    <?php
        if( isset($_POST['submit'] ) ){
            require "db.php";
            $sid        = $_POST['sid'];
            $sname      = $_POST['sname'];
            $saddress   = $_POST['saddress'];
            $sclass     = $_POST['sclass'];
            $sphone     = $_POST['sphone'];

            $set_condition = array( 
                'sname'     => $sname, 
                'saddress'  => $saddress,
                'sclass'    => $sclass,
                'sphone'    => $sphone
            );
            $update = new Query;
            $update->updateData( 'student', $set_condition, 'sid', $sid );
            header( "Location: http://localhost/Core_Project/crud_html/index.php" );
        }
    
    ?>
</div>
</div>
</body>
</html>
