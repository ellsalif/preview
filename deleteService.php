<?php
  
  require '../database/database.php';
  
   if(!empty($_GET['Service_Id'])) 
    {
        $Service_Id = checkInput($_GET['Service_Id']);
    }

    if(!empty($_POST)) 
    {
        $Service_Id = checkInput($_POST['Service_Id']);
		
		$db = Database::connect();
		$statement1 = $db->prepare("DELETE  FROM service_content WHERE service_content.Service_Id = ?");
		$statement1->execute(array($Service_Id));
		var_dump($statement1);
		  Database::disconnect();
		  
		$db = Database::connect();
		$statement2 = $db->prepare("DELETE FROM users_groupepreview WHERE Service_Id = ?");
		$statement2->execute(array($Service_Id));
		Database:: disconnect(); 
		
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM services_preview WHERE Service_Id = ?");
        $statement->execute(array($Service_Id));
        Database::disconnect();
        //header("Location: index.php"); 
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
                <h1><strong>Supprimer un Service</strong></h1>
                <br>
                <form class="form" action="deleteService.php" role="form" method="post">
                    <input type="hidden" name="Service_Id" value="<?php echo $Service_Id;?>"/>
                    <p class="alert alert-warning">Vous êtes sur le point de Suprimmer un Service et tout son contenu : 
					               Etes vous sur de vouloir supprimer le Service ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>