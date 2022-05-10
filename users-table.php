<?php
require "db-connection.php";

 $sql = "select * from users;";

 $result = $conn->query($sql);

 while($row = $result->fetch_assoc())
 {
     echo $row['name']."<br/>";
 }
