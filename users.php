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
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Services Preview<span class="glyphicon glyphicon-wrench" ></span></h1>
        
        <div class="container admin">
          <div class="row">
		       <center><h1><strong>Liste des groupes utilisateus  </strong><a href="adduserGroup.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter un groupe</a></h1></center>
               
              <table class="table table-striped table-bordered">
              <thead>
                   <tr>
                    <th>Id_Groupe</th>
                    <th>Non du groupe</th>
                    <th>Page par defaut</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                      
                 <?php

                      
                      require '../database/database.php';
                      $db = Database::connect();
                      $statement = $db->query('SELECT services_preview.Services_Id, services_preview.Service_Name, services_preview.File_config_Service, services_preview.Statut
                                               FROM  services_preview
                                               ORDER BY services_preview.Services_Id DESC');
                      while($servicespreview = $statement->fetch())
                      {   
                      echo '<tr>';
                      echo '<td>' . $servicespreview['Service_Name'] . '</td>';
                      echo '<td>' . $servicespreview['File_config_Service'] . '</td>';
                      echo '<td>' . $servicespreview['Statut'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-default" href="view.php?Services_Id=' . $servicespreview['Services_Id'] . '"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                      echo ' ';
                      echo '<a class="btn btn-primary" href="updateService.php?Services_Id=' . $servicespreview['Services_Id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                      echo ' ';
                      echo  '<a class="btn btn-danger" href="deleteService.php?Services_Id=' . $servicespreview['Services_Id'] . '"><span class="glyphicon glyphicon-remove"></span>Suprimer</a>';
                      echo '</td>';
                      echo '</tr>';
                  
                          
                      }
					

                      Database::disconnect();

                      
                 ?>
                  
                  </tbody>
              
              
              </table>
            
            
            </div>
            <div class="form-actions">
                  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour
                  
                  </a>
                  </div>
        </div>
    
    
    </body>
    
    
    </html>