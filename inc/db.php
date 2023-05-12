

<?php 

     $DB_Name = "AdminPanel";
     $DB_User = "root";
     $DB_Pass = "";
     $host = "Localhost";
     
     $db = mysqli_connect($host, $DB_User, $DB_Pass, $DB_Name);

     if($db){
        // echo "connect database";
     }
     else{
         die();
     }

?>