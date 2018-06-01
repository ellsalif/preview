<?php

    require '../database/database.php';

    if(!empty($_GET['Mac_Adressse_Id'])) 
    {
        $Mac_Adressse_Id = checkInput($_GET['Mac_Adressse_Id']);
    }

       $Mac_Adressse_ValueError  = $User_Groupe_IdError =  $Mac_Adressse_Value = $User_Groupe_Id =  "" ;

    if(!empty($_POST)) 
    {  
        $Mac_Adressse_Value              = checkInput($_POST['Mac_Adressse_Value']);
		$User_Groupe_Id                 = checkInput($_POST['User_Groupe_Id']);
                                    
									
        $isSuccess = true;

        
        if(empty($Mac_Adressse_Value)) 
        {
            $Mac_Adressse_ValueError		= 'Ce champ ne peut pas être vide';
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
            $statement = $db->prepare("UPDATE mac_adressse set Mac_Adressse_Value = ?, User_Groupe_Id= ? WHERE Mac_Adressse_Id = ? ");
            $statement->execute(array($Mac_Adressse_Value,$User_Groupe_Id,$Mac_Adressse_Id));
			var_dump($statement);
			  echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
		   Database::disconnect();
         //  header("Location: macAdresse.php");
        }
    }
    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM mac_adressse where Mac_Adressse_Id = ?");
        $statement->execute(array($Mac_Adressse_Id));
        $item = $statement->fetch();
        $Mac_Adressse_Value          = $item['Mac_Adressse_Value'];
        $User_Groupe_Id             = $item['User_Groupe_Id']; 
		
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
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin Mac Adresse Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier Une Adresse</strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'updateMacAdresse.php?Mac_Adressse_Id='.$Mac_Adressse_Id;?>" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Mac_Adressse_Value">Valeure:
                            <input type="text" class="form-control" id="Mac_Adressse_Value" name="Mac_Adressse_Value" placeholder="Veleure" value="<?php echo $Mac_Adressse_Value;?>">
                            <span class="help-inline"><?php echo $Mac_Adressse_ValueError;?></span>
                        </div>
						
						<div class="form-group">
                            <label for="User_Groupe_Id">Groupe User:
                            <select class="form-control" id="User_Groupe_Id" name="User_Groupe_Id">
                            <?php
                               $db = Database::connect();
                               foreach ($db->query('SELECT User_Groupe_Id,User_Groupe_name FROM users_groupe') as $row) 
                               {
                                    if($row['User_Groupe_Id'] == $User_Groupe_Id)
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
                            <a class="btn btn-primary" href="macAdresse.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                       </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>
