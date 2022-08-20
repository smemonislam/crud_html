<?php 
    include 'header.php'; 
    require "db.php";
?>
            <div id="main-content">
                <h2>Add New Record</h2>
                <form class="post-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="sname" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="saddress" />
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select name="class">
                            <option value="" selected disabled>Select Class</option>
                            <?php
                                $className = new Query;
                                $result = $className->getData( 'studentclass' );
                                foreach( $result as $row ){
                            ?>
                            <option value="<?php echo $row['cid']; ?>"><?php echo $row['cname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="sphone" />
                    </div>
                    <input class="submit" type="submit" value="Save" name="submit" />
                </form>
                <?php
                    if( isset( $_POST['submit'] ) ){
                        $name       = $_POST['sname'];
                        $saddress   = $_POST['saddress'];
                        $class      = $_POST['class'];
                        $sphone     = $_POST['sphone'];
                        $data = array( 'sname' => $name, 'saddress' => $saddress, 'sclass' => $class, 'sphone' => $sphone );
                        $obj  = new Query;
                        $obj->insertData( 'student', $data );
                        header( "Location: http://localhost/Core_Project/crud_html/index.php" );
                    }
                ?>
            </div>
        </div>
    </body>
</html>
