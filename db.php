<?php
    class Database {
        private $hostname;
        private $username;
        private $password;
        private $dbname;

        protected function connect(){
            $this->hostname = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname   = "students";

            $conn = new mysqli( $this->hostname, $this->username, $this->password, $this->dbname );

            return $conn;
        }
    }

    class Query extends Database {
        public function getData( $table, $join_table = '', $field = '*', $condition = '', $order_by_field = '', $order_by_type = 'ASC', $limit = ''  ){
            $sql = "SELECT {$field} FROM {$table} ";
            if( $join_table != '' ){
                $sql .= " JOIN {$join_table} ";
            }
            if( $condition != '' ){
                $sql .= " WHERE ";
                $count = count( $condition );
                $i = 1;
                foreach( $condition as $key => $val ){
                    if( $i == $count ){
                        $sql .= " {$key} = {$val} ";
                    }else{
                        $sql .= "  {$key} = {$val} AND ";
                    }
                    $i++;
                }
            }
            
            if( $order_by_field != '' ){
                $sql .= " ORDER BY {$order_by_field} {$order_by_type} ";            }
            if( $limit != '' ){
                $sql .= " LIMIT {$limit} ";
            }
            $result = $this->connect()->query( $sql );
            if( $result->num_rows > 0 ){
                $data = array();
                while( $row = $result->fetch_assoc() ){
                    $data[] = $row;
                }
                return $data;
            }
        }
        public function insertData( $table, $insert_data ) {
            if( $insert_data != '' ){
                foreach( $insert_data as  $key => $data ){
                   $fieldKey[] = $key;
                   $fieldValue[] = $data;
                }
                $field = implode( ",", $fieldKey );
                $value = implode( "','", $fieldValue );
                $value = "'".$value."'";
                $sql = "INSERT INTO {$table}( $field ) VALUES( $value )";
                $result = $this->connect()->query( $sql );
            }
        }
        public function deleteData( $table, $condition ) {
            if( $condition != '' ){
                $sql = "DELETE FROM {$table} WHERE";
                $count = count( $condition );
                $i = 1;
                foreach( $condition as $key => $val ){
                    if( $i == $count ){
                        $sql .= " {$key} = {$val} ";
                    }else{
                        $sql .= "  {$key} = {$val} AND ";
                    }
                    $i++;
                }
            }
            $result = $this->connect()->query( $sql );
        }

        public function updateData( $table, $condition, $where_field, $where_value ){
            if( $condition != '' ){
                $sql = "UPDATE {$table} SET ";
                
                $count = count( $condition );
                $i = 1;
                foreach( $condition as $key => $val ){
                    if( $i == $count ){
                        $sql .= " {$key} = '{$val}' ";
                    }else{
                        $sql .= "  {$key} = '{$val}', ";
                    }
                    $i++;
                }
                $sql .= " WHERE {$where_field} = {$where_value}";
            }
           $result = $this->connect()->query( $sql );
        }
    }

?>