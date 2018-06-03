<html>

<?php

  $str = $_POST['model_id'];

  $db_name= (explode("_",$str));

  $table_name= (explode(" ",$str));


  $pdo=new PDO("mysql:host=localhost;port=3306;dbname=garage",'root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $stmt=$pdo->query("SELECT * FROM ".$table_name[1]);
   ?>
   <option>--Please Select --</option>
   <?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
           ?>
           <option value="<?php echo $row['model_name']; ?>"><?php echo $row["model_name"]; ?></option>
      <?php
    }
      ?>

</html>
