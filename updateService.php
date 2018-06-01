<?php

    require '../database/database.php';

    if(!empty($_GET['Service_Id'])) 
    {
        $Service_Id = checkInput($_GET['Service_Id']);
    }

   $Service_NameError = $File_config_ServiceError = $EnvironnementError = $Service_Name = $File_config_Service = $Environnement = "";

    if(!empty($_POST)) 
    {
        $Service_Name               = checkInput($_POST['Service_Name']);
		$File_config_Service         = checkInput($_POST['File_config_Service']);
        $Environnement                     = checkInput($_POST['Environnement']);
		
        $isSuccess          = true;
       
        if(empty($Service_Name)) 
        {
            $Service_NameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($File_config_Service)) 
        {
            $File_config_ServiceError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($Environnement)) 
        {
            $Environnement = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
         
        if ($isSuccess) 
        { 
            $db = Database::connect();
           
                $statement = $db->prepare("UPDATE services_preview  set Service_Name = ?, File_config_Service = ?, Environnement = ? WHERE Service_Id = ?");
                $statement->execute(array($Service_Name,$File_config_Service,$Environnement, $Service_Id));
       
            Database::disconnect();
            //header("Location: index.php");
        }
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM services_preview where Service_Id = ?");
        $statement->execute(array($Service_Id));
        $item = $statement->fetch();
        $Service_Name           = $item['Service_Name'];
        $File_config_Service    = $item['File_config_Service'];
        $Environnement          = $item['Environnement'];
		
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
                    <h1><strong>Modifier Un Service</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'updateService.php?Service_Id='.$Service_Id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom du Service:
                            <input type="text" class="form-control" id="Service_Name" name="Service_Name" placeholder="Nom du Service" value="<?php echo $Service_Name;?>">
                            <span class="help-inline"><?php echo $Service_NameError;?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">File Config:
                            <input type="text" class="form-control" id="File_config_Service" name="File_config_Service" placeholder="File Config" value="<?php echo $File_config_Service;?>">
                            <span class="help-inline"><?php echo $File_config_ServiceError;?></span>
                        </div>
                        <div class="form-group">
                        <label for="Environnement">Environnement:
                            <input type="text" class="form-control" id="Environnement" name="Environnement" placeholder="Environnement" value="<?php echo $Environnement;?>">
                            <span class="help-inline"><?php echo $EnvironnementError;?></span>
                        </div>
                        
                        <br>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>
