<?php
  
  require '../database/database.php';
  
   if(!empty($_GET['User_Groupe_Id'])) 
    {
        $User_Groupe_Id = checkInput($_GET['User_Groupe_Id']);
    }

    if(!empty($_POST)) 
    {
        $User_Groupe_Id = checkInput($_POST['User_Groupe_Id']);
		
		 $db = Database::connect();
		  $statement1 = $db->prepare("DELETE FROM users_preview WHERE User_Groupe_Id = ?");
		  $statement1->execute(array($User_Groupe_Id));
		  echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement1->errorInfo();
             print_r($arr);
		  Database::disconnect();
		   
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM users_groupe WHERE User_Groupe_Id = ?");
        $statement->execute(array($User_Groupe_Id));
		echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
        Database::disconnect();
        //header("Location: usersGroupe.php"); 
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
                <h1><strong>Supprimer un Groupe</strong></h1>
                <br>
                <form class="form" action="deleteGroupeUSer.php" role="form" method="post">
                    <input type="hidden" name="User_Groupe_Id" value="<?php echo $User_Groupe_Id;?>"/>
                    <p class="alert alert-warning">vous êtes sur le poin de supprimer un Groupe et tous ses menbres : 
					  Etes vous sur de vouloir supprimer le groupe ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="usersGroupe.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>