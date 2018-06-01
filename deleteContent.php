<?php
  
  require '../database/database.php';
  
   if(!empty($_GET['Service_Content_Id'])) 
    {
        $Service_Content_Id	= checkInput($_GET['Service_Content_Id']);
    }

    if(!empty($_POST)) 
    {
        $Service_Content_Id = checkInput($_POST['Service_Content_Id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM service_content WHERE Service_Content_Id = ?");
		
        $statement->execute(array($Service_Content_Id));
        Database::disconnect();

 echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
       // header("Location: index.php"); 
    }

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Preview</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../Css/style.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Supprimer un Item de Service</strong></h1>
                <br>
                <form class="form" action="deleteContent.php" role="form" method="post">
                    <input type="hidden" name="Service_Content_Id" value="<?php echo $Service_Content_Id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir Cet Item ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>