<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Redirect</title>
</head>
<body>
 <?php 
  require './PHP/common_files.php';
  require './PHP/header.php';
  ?>
  <?php 
  //if the request contains id return the  link with id
   if(isset($_GET['id'])){
    $productID=$_GET['id'];
   $trigger=$_GET['trigger']; 
    echo "<script>location.href='./".$trigger."?id=".$productID."'</script>";
   }elseif(isset($_GET['trigger'])){
    echo "<script>
     location.href='./".$_GET['trigger']."'
    </script>";
   }
   ?>
</body>
</html>