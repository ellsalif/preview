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
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Mac Adresse Preview<span class="glyphicon glyphicon-wrench" ></span></h1>
        
        <div class="container admin">
          <div class="row">
		       <center><h1><strong>Liste des addresses Mac  </strong><a href="addmcAdresse.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter une adresses</a></h1></center>
               
              <table class="table table-striped table-bordered">
              <thead>
                   <tr>
                    <th>Id_Mac</th>
                    <th>Valeur</th>
                    <th>Groupe Utilisateur</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                      
                 <?php

                      
                      require '../database/database.php';
                      $db = Database::connect();
                      $statement = $db->query('SELECT mac_adressse.Mac_Adressse_Id, mac_adressse.Mac_Adressse_Value , mac_adressse.User_Groupe_Id
                                               FROM  mac_adressse
                                               ORDER BY mac_adressse.Mac_Adressse_Id DESC');
											   
				      
					
                      while($servicespreview = $statement->fetch())
                      {   
                      echo '<tr>';
                      echo '<td>' . $servicespreview['Mac_Adressse_Id'] . '</td>';
                      echo '<td>' . $servicespreview['Mac_Adressse_Value'] . '</td>';
					  echo '<td>' . $servicespreview['User_Groupe_Id'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-default" href="#?Mac_Adressse_Id=' . $servicespreview['Mac_Adressse_Id'] . '"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                      echo ' ';
                      echo '<a class="btn btn-primary" href="updateMacAdresse.php?Mac_Adressse_Id=' . $servicespreview['Mac_Adressse_Id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                      echo ' ';
                      echo  '<a class="btn btn-danger" href="deleteMacAdresse.php?Mac_Adressse_Id=' . $servicespreview['Mac_Adressse_Id'] . '"><span class="glyphicon glyphicon-remove"></span>Suprimer</a>';
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