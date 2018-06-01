<?php
 require '../database/database.php';
  $Service_NameError = $File_config_ServiceError = $EnvironnementError = $User_Groupe_IdError = $Service_Name = $File_config_Service = $Environnement = 	$User_Groupe_Id[] = "";

  if(!empty($_POST)) 
    {
        $Service_Name               = checkInput($_POST['Service_Name']);
		$File_config_Service        = checkInput($_POST['File_config_Service']);
        $Environnement                    = checkInput($_POST['Environnement']);
	   //$Users_Groupe_Id            = checkInput($_POST['Users_Groupe_Id']);
		

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
            $EnvironnementError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        /*
		if(empty($_POST['$Users_Groupe_Id'])) 
        {
            $Users_Groupe_IdError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
		*/
		
        if($isSuccess && !empty($_POST['User_Groupe_Id']) ) 
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO services_Preview (Service_Name,File_config_Service,Environnement) values(?, ?, ?)");
            $statement->execute(array($Service_Name,$Environnement,$File_config_Service));
			$Id_ServiceTmp = $db->lastInsertId(); 
            Database::disconnect();
		   
		   
			
				echo "Je suis entré";
				$db = Database::connect();
				foreach($_POST['User_Groupe_Id'] as $valIdGroupe)
				{
		   $statemen = $db->prepare("INSERT INTO users_groupepreview (User_Groupe_Id , Service_Id) values($valIdGroupe, ?)");
		   
		 // echo "bonjour";
		  $statemen->execute(array($Id_ServiceTmp));
		  echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
				}
		 
            Database::disconnect();
			//header("Location: index.php");
			
        
			
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
                <h1><strong>Ajouter un Service</strong></h1>
                <br>
                <form class="form" action="insertService.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Service_Name">Nom:</label>
                        <input type="text" class="form-control" id="Service_Name" name="Service_Name" placeholder="Nom" value="<?php echo $Service_Name;?>">
                        <span class="help-inline"><?php echo $Service_NameError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="File_config_Service">Fichier De configuration:</label>
                        <input type="text" class="form-control" id="File_config_Service" name="File_config_Service" placeholder="File_config_Service" value="<?php echo $File_config_Service;?>">
                        <span class="help-inline"><?php echo $File_config_ServiceError;?></span>
                    </div>
					<div class="form-group">
                        <label for="Environnement">Environnement:</label>
                        <input type="text" class="form-control" id="Environnement" name="Environnement" placeholder="Environnement" value="<?php echo $Environnement;?>">
                        <span class="help-inline"><?php echo $EnvironnementError;?></span>
                    </div>
					<div class="form-group" >
                        <label for="User_Groupe_Id">Groupe Utilisateur:</label>
                        <select class="form-control" id="User_Groupe_Id" name="User_Groupe_Id[]"  multiple = "multiple">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT User_Groupe_Id,User_Groupe_name FROM users_groupe') as $row) 
                           {
                                echo '<option value="'. $row['User_Groupe_Id'] .'">'. $row['User_Groupe_name'] . '</option>';;
                           }
                           Database::disconnect();
						   var_dump($_POST['User_Groupe_Id']);
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