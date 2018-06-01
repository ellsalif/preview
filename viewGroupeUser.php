 <?php
  require '../database/database.php';

if(!empty($_GET['User_Groupe_Id']))	
{

    $User_Groupe_Id = checkInput($_GET['User_Groupe_Id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT  users_preview.User_Id,users_preview.User_Groupe_Id,users_preview.User_Name,users_preview.User_Password FROM users_preview
							WHERE users_preview.User_Groupe_Id  = ?');

$statement->execute(array ($User_Groupe_Id));

 echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
//$servicespreview= $statement->fetch();
//Database::disconnect();

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
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Groupe Users<span class="glyphicon glyphicon-wrench" ></span></h1>
        
        <div class="container admin">
          <div class="row">
              
              <h1><strong> Membre du Groupe</strong><a href="addUser.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter Un Membre</a></h1>
	
              <table class="table table-striped table-bordered">
              <thead>
                   <tr>
                    <th>User Name</th>
                    <th>PasseWord</th>
					<th>Action</th>
                  
                  </tr>
                  </thead>
                  <tbody>               
                      
  <?php
 while($servicespreview = $statement->fetch())
                      {   
				  
                      echo '<tr>';
                      echo '<td>' . $servicespreview['User_Name'] . '</td>';
                      echo '<td>' . $servicespreview['User_Password'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-default" href="viewUSer.php?User_Id=' . $servicespreview['User_Id'] . '"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                      echo ' ';
                      echo '<a class="btn btn-primary" href="updateUser.php?User_Id=' . $servicespreview['User_Id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                      echo ' ';
                      echo  '<a class="btn btn-danger" href="deleteUser.php?User_Id=' . $servicespreview['User_Id'] . '"><span class="glyphicon glyphicon-remove"></span>Suprimer</a>';
                      echo '</td>';
                      echo '</tr>';
                  
                          
                      }
					
				Database::disconnect();
?>       
                  </tbody>
              
              
              </table>
            
            
            </div>
			 <div class="form-actions">
                  <a class="btn btn-primary" href="usersGroupe.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour
                  
                  </a>
                  </div>
            
        </div>
    
    
    </body>
    
    
    </html>