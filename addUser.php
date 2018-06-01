<?php
 require '../database/database.php';
  $User_NameError = $User_PasswordError = $User_Groupe_IdError = $User_Name  = $User_Password =  $User_Groupe_Id = "";
  
  if(!empty($_POST)) 
    {    echo $_POST['User_Groupe_Id'];


        $User_Name                    = checkInput($_POST['User_Name']);
		$User_Password               = checkInput($_POST['User_Password']);
		$User_Groupe_Id              = checkInput($_POST['User_Groupe_Id']);
		
		
        $isSuccess = true;
        
        if(empty($User_Name)) 
        {
            $User_NameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($User_Password)) 
        {
            $User_PasswordError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($User_Groupe_Id)) 
        {
            $User_Groupe_IdError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if($isSuccess) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO users_preview(User_Name,User_Password,User_Groupe_Id) values(?, ?, ?)");
	        $statement->execute(array($User_Name,$User_Password,$User_Groupe_Id));
			  echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
            var_dump($statement);
		    Database::disconnect();
          //header("Location: viewGroupeUser.php?Users_Groupe_Id=$Users_Groupe_Id");
        }
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
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Services De Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un Nouveau membre</strong></h1>
                <br>
                <form class="form" action="addUser.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="User_Name">Utilisateur:</label>
                        <input type="text" class="form-control" id="User_Name" name="User_Name" placeholder="Utilisateur" value="<?php echo $User_Name;?>">
                        <span class="help-inline"><?php echo $User_NameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="User_Password">Mont de Passe:</label>
                        <input type="text" class="form-control" id="User_Password" name="User_Password" placeholder="mot de passe" value="<?php echo $User_Password;?>">
                        <span class="help-inline"><?php echo $User_PasswordError;?></span>
                    </div>		
	             	 <div class="form-group">
                        <label for="User_Groupe_Id">Groupe Utilisateur:</label>
                        <select class="form-control" id="User_Groupe_Id" name="User_Groupe_Id">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT User_Groupe_Id, User_Groupe_Name FROM users_groupe') as $row) 
                           {
                                echo '<option value="'. $row['User_Groupe_Id'] .'">'. $row['User_Groupe_Name'] . '</option>';;
                          }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $User_Groupe_IdError;?></span>
                    </div>
			
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>