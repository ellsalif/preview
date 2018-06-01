<?php
 require '../database/database.php';
  $User_Groupe_nameError = $User_Groupe_defaultPageError = $User_Groupe_name = $User_Groupe_defaultPage = "" ;
  if(!empty($_POST)) 
    {
        $User_Groupe_name                   = checkInput($_POST['User_Groupe_name']);
		$User_Groupe_defaultPage            = checkInput($_POST['User_Groupe_defaultPage']);
        $isSuccess          = true;
        
        if(empty($User_Groupe_name)) 
        {
            $User_Groupe_nameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($User_Groupe_defaultPage)) 
        {
            $User_Groupe_defaultPageError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        
        if($isSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO users_groupe (User_Groupe_name,User_Groupe_defaultPage) values(?, ?)");
            $statement->execute(array($User_Groupe_name, $User_Groupe_defaultPage));
		    //$statement->("FLUSH TABLES");
			echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
            Database::disconnect();
            //header("Location: usersGroupe.php");
			
        }
    }
	
	//mysql_query("FLUSH TABLES");

	
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
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Services De Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un Groupe Utilisateur</strong></h1>
                <br>
                <form class="form" action="addGroupUsers.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="User_Groupe_name">Nom du Groupe:</label>
                        <input type="text" class="form-control" id="User_Groupe_name" name="User_Groupe_name" placeholder="Groupe_Name" value="<?php echo $User_Groupe_name;?>">
                        <span class="help-inline"><?php echo $User_Groupe_nameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="User_Groupe_defaultPage">Page par Defaut:</label>
                        <input type="text" class="form-control" id="User_Groupe_defaultPage" name="User_Groupe_defaultPage" placeholder="Page par defaut" value="<?php echo $User_Groupe_defaultPage;?>">
                        <span class="help-inline"><?php echo $User_Groupe_defaultPageError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="usersGroupe.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>