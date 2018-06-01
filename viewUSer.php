<?php
 require '../database/database.php';

 
if(!empty($_GET['User_Id']))
{
    $User_Id = checkInput($_GET['User_Id']);

}
		$db = Database::connect();									   
	$statement = $db->prepare('SELECT users_preview.User_Id, users_preview.User_Name,users_preview.User_Password
							FROM users_preview
							WHERE  users_preview.User_Id = ?');
										   


$statement->execute(array($User_Id));
 echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
    $item = $statement->fetch();
	var_dump($statement);
     var_dump($item);
Database::disconnect();

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
     <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta charset="UTF-8">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
     <link href='http://fonts.googleapis.com/css?family=Holwood+one+SC' rel='stylesheet' type="text/css">
     <link rel="stylesheet" href="../Css/style.css">
     
    </head>
    
    
    <body>
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Users Preview <span class="glyphicon glyphicon-wrench"></span></h1>
        
        <div class="container admin">
          <div class="row">
              <div class="col-sm-6">
            <h1><strong> Voir Un Utilisateur</strong> </h1>
                  <br>
                  
                  <form>

                   <div class="form-group">
                       <label>Pseudo:</label><?php echo ' ' . $item['User_Name']; ?>
                      
                      </div>
                      
                      <div class="form-group">
                       <label>Mot de passe:</label><?php echo ' ' . $item['User_Password']; ?>
                      
                      </div>
                      
                      <div class="form-group">
                       <label>ID:</label><?php echo ' ' . $item['User_Id']; ?>
                      
                      </div>
                  
                  </form>
                   <div class="form-actions">
                  <a class="btn btn-primary" href="usersGroupe.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour
                  
                  </a>
                  </div>
              </div>          
            </div>
            
        </div>
    
    
    </body>
    
    
    </html>