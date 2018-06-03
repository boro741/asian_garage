
<?php

    session_start();
    if(!$_SESSION['Lsuccess'])
    {
      $_SESSION['error']="UN AUTHORISED LOGIN DETECTED";

      header("Location:dbAutomobileLogin.php");
    }
      $errors=array();
      if($_POST)
      {

        if(empty($_POST['manufacturer']))
        {
          $errors['manufacturer']="Select The Makers Of Your Bike";
        }
        if(empty($_POST['model']))
        {
          $errors['model']="Select your bike model";
        }
        if(empty($_POST['Rn1'])||empty($_POST['Rn2'])||empty($_POST['Rn3'])||empty($_POST['Rn4']))
        {
          $errors['Rnumber']="INVALID Registration Number";
        }

        if(empty($errors))
        {
          $_SESSION['bike_type']=$_POST['bike_type'];
          $_SESSION['model']=$_POST['model'];
          $_SESSION['manufacturer']=$_POST['manufacturer'];
          $_SESSION['Rnumber']=$_POST['Rn1'].$_POST['Rn2'].$_POST['Rn3'].$_POST['Rn4'];
          //echo("type = ".$_SESSION['type']." model = ".$_SESSION['model']."  manufacturer = ".$_SESSION['manufacturer']);
          header("Location:service_details.php");
        }
    }

    //dynamic drop down


 ?>

<html>
<head><?php
  $pdo=new PDO('mysql:host=localhost;port=3306;dbname=garage','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //$row=$stmt->fetch(PDO::FETCH_ASSOC)
   ?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
   <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
 
<style>
  .container{
    align: center;
    background-color: grey;
    color: white;
    padding-top: 10%;
    padding-bottom: 20%;
    font-size: 18px;
  }
</style>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
var t_name;
   function getManufacturer(val)
   {
     t_name=val;
    // console.log(val);
     $.ajax({
       type:"POST",
       url:"get_sports.php",
       data:'bike_id='+val,
       success:function(data){

         $("#manufacturer").html(data);
       }
     });
   }

   function getModel(val)
   {

     val=t_name+" "+val;
     console.log(val);
     $.ajax({

       type:"POST",
       url:"get_model.php",
       data:'model_id='+val,
       success:function(data){

         $("#model").html(data);
       }
     });
   }

   document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
  });
</script>

<body>

<div class="container">
    <form method="post" >

        <div class="row">

            <div class="col">
                <label for="bike_type">Bike Type:</label>
            </div>

            <div class="col"> 
                <select id="bike_type" onChange="getManufacturer(this.value);">
    
                    <option value="">--Please Select --</option>
                    <option value="sports_bike">Sports</option>
                    <option value="cruiser_bikes">Cruiser</option>
                </select>
            </div>
        </div>

        <div class="row">
                <div class="col">
                    <label for="manufacturer">Manufacturer:</label>
                </div>
                
                <div class="col">
                    <select name="manufacturer" id="manufacturer" onChange="getModel(this.value);">
                    
                    <option value="">--Please Select --</option>
                    </select>
                    <p style="color:red"><?php if(isset($errors['manufacturer'])) echo $errors['manufacturer']; ?></p>
                </div>
          </div>

        <div class="row">
            <div class="col">
                <label for="model">Model:</label>
            </div>

            <div class="col">
                <select name="model" id="model">
                <option value="">--Please Select --</option>
                </select>
                <p style="color:red"><?php if(isset($errors['model'])) echo $errors['model']; ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="model">Registration Number:</label>
            </div>

            <div class="col">
                <input type="text" name="Rn1" id="Rn1" size="10" placeholder="  TS" >
                <input type="text" name="Rn2" id="Rn2" size="10" placeholder="  08" >
                <input type="text" name="Rn3" id="Rn3" size="10" placeholder="  FG">
                <input type="text" name="Rn4" id="Rn4" size="10" placeholder="  3908">
    
                <p style="color:red"><?php if(isset($errors['Rnumber'])) echo $errors['Rnumber']; ?></p>
            </div>
        </div>
    
    <div class="row">
        <div class="col">
            <input type="submit" class="btn btn-primary" value="Proceed">
        </div>
    </div>
    </form>
</div>

</body>
</html>
