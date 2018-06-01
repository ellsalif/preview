<?php
 require '../database/database.php';
  $Mac_Adressse_ValueError = $User_Groupe_IdError = $Mac_Adressse_Value = $User_Groupe_Id = "";
  
  if(!empty($_POST)) 
    {
        $Mac_Adressse_Value               = checkInput($_POST['Mac_Adressse_Value']);
		$User_Groupe_Id                  = checkInput($_POST['User_Groupe_Id']);
		
        $isSuccess                        = true;
        
        if(empty($Mac_Adressse_Value)) 
        {
            $Mac_Adressse_ValueError = 'Ce champ ne peut pas être vide';
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
            $statement = $db->prepare("INSERT INTO mac_adressse(Mac_Adressse_Value,User_Groupe_Id) values(?, ?)");
            $statement->execute(array($Mac_Adressse_Value,$User_Groupe_Id));
		    echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
            Database::disconnect();
		   $db = Database::connect();

           //header("Location: macAdresse.php");
			
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
        <link rel="stylesheet" href="../Css/Style.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin Mac Addresse <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter une Adresse Mac</strong></h1>
                <br>
                <form class="form" action="addmcAdresse.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Mac_Adressse_Value">Valeur:</label>
                        <input type="text" class="form-control" id="Mac_Adressse_Value" name="Mac_Adressse_Value" placeholder="value" value="<?php echo $Mac_Adressse_Value;?>">
                        <span class="help-inline"><?php echo $Mac_Adressse_ValueError;?></span>
                    </div>
					<div class="form-group">
                        <label for="Users_Groupe_Id">Groupe Utilisateur:</label>
                        <select class="form-control" id="User_Groupe_Id" name="User_Groupe_Id">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT User_Groupe_Id,User_Groupe_name FROM users_groupe') as $row) 
                           {
                                echo '<option value="'. $row['User_Groupe_Id'] .'">'. $row['User_Groupe_name'] . '</option>';;
                           }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $User_Groupe_IdError;?></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="macAdresse.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>