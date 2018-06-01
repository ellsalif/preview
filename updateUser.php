<?php

    require '../database/database.php';

    if(!empty($_GET['User_Id'])) 
    {
        $User_Id = checkInput($_GET['User_Id']);
    }

       $User_NameError = $User_PasswordError = $User_Groupe_IdError  = $User_Name = $User_Password =  $User_Groupe_Id = "";

    if(!empty($_POST)) 
    {  
        $User_Name                          = checkInput($_POST['User_Name']);
		$User_Password                     = checkInput($_POST['User_Password']);
		$User_Groupe_Id                     = checkInput($_POST['User_Groupe_Id']);
        $isSuccess = true;
		$Usergroup_Idtmp = $User_Groupe_Id;
        
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
			echo "je suis dans issucees";
            $db = Database::connect();
            $statement = $db->prepare("UPDATE users_preview set User_Name = ?, User_Password = ?, User_Groupe_Id = ? WHERE User_Id = ? ");
            $statement->execute(array($User_Name,$User_Password,$User_Groupe_Id,$User_Id));
			  echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
		   Database::disconnect();
           //header("Location: viewGroupeUser.php?Users_Groupe_Id=$Users_Groupe_Id");
        }
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM users_preview where User_Id = ?");
        $statement->execute(array($User_Id));
        $item = $statement->fetch();
        $User_Name                       = $item['User_Name'];
        $User_Password                  = $item['User_Password'];
        $User_Groupe_Id                 = $item['User_Groupe_Id'];
		
		 echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
        Database::disconnect();
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
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin Users Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier l'utilisateur</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'updateUser.php?User_Id='.$User_Id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="User_Name">Pseudo:
                            <input type="text" class="form-control" id="User_Name" name="User_Name" placeholder="pseudo" value="<?php echo $User_Name;?>">
                            <span class="help-inline"><?php echo $User_NameError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="User_Password">Mot De Passe:
                            <input type="text" class="form-control" id="User_Password" name="User_Password" placeholder="mot de passe" value="<?php echo $User_Password;?>">
                            <span class="help-inline"><?php echo $User_PasswordError;?></span>
                        </div>
						
						<div class="form-group">
                            <label for="User_Groupe_Id">Groupe Users:
                            <select class="form-control" id="User_Groupe_Id" name="User_Groupe_Id">
                            <?php
                               $db = Database::connect();
                               foreach ($db->query('SELECT User_Groupe_Id, User_Groupe_name FROM users_groupe') as $row) 
                               {
                                    if($row['User_Groupe_Id'] == $Users_Groupe_Id)
                                        echo '<option selected="selected" value="'. $row['User_Groupe_Id'] .'">'. $row['User_Groupe_name'] . '</option>';
                                    else
                                        echo '<option value="'. $row['User_Groupe_Id'] .'">'. $row['User_Groupe_name'] . '</option>';;
                               }
                               Database::disconnect();
                            ?>
                            </select>
                            <span class="help-inline"><?php echo $User_Groupe_IdError;?></span>
                        </div>
                        
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="<?php echo 'viewGroupeUser.php?User_Groupe_Id='.$User_Groupe_Id;?>"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>
