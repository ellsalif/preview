<?php

    require '../database/database.php';

    if(!empty($_GET['User_Groupe_Id'])) 
    {
        $User_Groupe_Id = checkInput($_GET['User_Groupe_Id']);
    }

   $User_Groupe_nameError = $User_Groupe_defaultPageError = $User_Groupe_name = $User_Groupe_defaultPage = "";

    if(!empty($_POST)) 
    {
        $User_Groupe_name                = checkInput($_POST['User_Groupe_name']);
		$User_Groupe_defaultPage         = checkInput($_POST['User_Groupe_defaultPage']);
		
        $isSuccess                        = true;
       
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
         
        if ($isSuccess) 
        { 
            $db = Database::connect();
           
                $statement = $db->prepare("UPDATE users_groupe set User_Groupe_name = ?, User_Groupe_defaultPage = ?");
                $statement->execute(array($User_Groupe_name,$User_Groupe_defaultPage));
       
            Database::disconnect();
            //header("Location: usersGroupe.php");
        }
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM users_groupe where User_Groupe_Id= ?");
        $statement->execute(array($User_Groupe_Id));
        $item = $statement->fetch();
        $User_Groupe_name          = $item['User_Groupe_name'];
        $User_Groupe_defaultPage    = $item['User_Groupe_defaultPage'];
		
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
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin Services Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier Un Groupe</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'updateGroupeUser.php?User_Groupe_Id='.$User_Groupe_Id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="User_Groupe_name">Nom du Groupe:
                            <input type="text" class="form-control" id="User_Groupe_name" name="User_Groupe_name" placeholder="Nom du Groupe" value="<?php echo $User_Groupe_name;?>">
                            <span class="help-inline"><?php echo $User_Groupe_nameError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="User_Groupe_defaultPage">Page Par Defaut:
                            <input type="text" class="form-control" id="User_Groupe_defaultPage" name="User_Groupe_defaultPage" placeholder="page par defaut" value="<?php echo $User_Groupe_defaultPage;?>">
                            <span class="help-inline"><?php echo $User_Groupe_defaultPageError;?></span>
                        </div>
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="usersGroupe.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>
