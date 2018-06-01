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
	 <style>
	 .right {
    position: absolute;
    right: 0px;
    width: 300px;
    padding: 10px;
}
</style>
	 <div id="bloc_page">
            <img src="../images/unnamed.png" alt="Logo_page" title="Accueil" id="logo" alt="HTML5 Icon" style="width:50px;height:50px;"/>
    </div>
	
          <?php
		  session_start();
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location: ../Authentification/login.php");
                   }
                }
                else if($_SESSION['User_Name'] !== ""){
                    $user = $_SESSION['User_Name'];
                    // afficher un message
					echo '<p style="text-align:center; color:red; font-size:2vw;">Bonjour'." " .$user.', vous êtes connectés</p>';
                    echo $user;
					$groupe = $_SESSION['User_Groupe_Name'];
					
					echo $_SESSION['User_Groupe_Name'];
                }
		  ?>
		  
	<div class="right"> 
    <a href='index.php?deconnexion=true' class = "btn btn-info btn-lg"><span class ="glyphicon glyphicon-log-out"></span>Déconnexion</a>
    </div>
   
    </head>
    
    <body>
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Services Preview<span class="glyphicon glyphicon-wrench" ></span></h1>
         
        <div class="container admin">
          <div class="row">
		       <h1><a href="macAdresse.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-envelope"></span>Admin Adresses Mac</a></h1>
               <h1><a href="usersGroupe.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-user"></span>Admin Users</a></h1>
              <center><h1><strong>Liste des Services    </strong><a href="insertService.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter Un service</a></h1></center>
              <table class="table table-striped table-bordered">
              <thead>
                   <tr>
                    <th>Nom du Service</th>
                    <th>configFile</th>
                    <th>Statut</th>
                    <th>Action</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                 
                      
                 <?php
                     $groupe = $_SESSION['User_Groupe_Name'];
                      echo $groupe;
                      require '../database/database.php';
                      $db = Database::connect();
                      $statement = $db->query("SELECT services_preview.Service_Id, services_preview.Service_Name, services_preview.File_config_Service, services_preview.Environnement 
					                           FROM  services_preview
                                               ORDER BY services_preview.Service_Id DESC");
											   
									
		  
											  
                      while($servicespreview = $statement->fetch())
                      {   
                      echo '<tr>';
                      echo '<td>' . $servicespreview['Service_Name'] . '</td>';
                      echo '<td>' . $servicespreview['File_config_Service'] . '</td>';
                      echo '<td>' . $servicespreview['Environnement'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-default" href="view.php?Service_Id=' . $servicespreview['Service_Id'] . '"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                      echo ' ';
                      echo '<a class="btn btn-primary" href="updateService.php?Service_Id=' . $servicespreview['Service_Id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                      echo ' ';
                      echo  '<a class="btn btn-danger" href="deleteService.php?Service_Id=' . $servicespreview['Service_Id'] . '"><span class="glyphicon glyphicon-remove"></span>Suprimer</a>';
                      echo '</td>';
                      echo '</tr>';
                  
                          
                      }
					

                      Database::disconnect();

                      
                 ?>
                  
                  </tbody>
              
              
              </table>
            
            
            </div>
            
        </div>
    
    </body>
    
    
    </html>