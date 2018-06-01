 <?php
  require '../database/database.php';


if(!empty($_GET['Services_Id']))
{
    $Services_Id = checkInput($_GET['Services_Id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT service_content.Services_Id, service_content.Service_Content_Id, service_content.Service_Content_label, service_content.Service_Content_Name, service_content.Service_Content_Params,
                            service_content.Service_Content_Url, service_content.Pf
							FROM service_content
							WHERE  service_content.Services_Id = ?');

							   

//var_dump($statement);

$statement->execute(array ($Services_Id));

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
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Services Content<span class="glyphicon glyphicon-wrench" ></span></h1>
        
        <div class="container admin">
          <div class="row">
              <h1><a href="<?php echo 'EditConfg.php?Services_Id=' .$_GET['Services_Id'];?>" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-download-alt"></span> Edit file config</a></h1>

             <center> <h1><strong> Contenu du Service </strong><a href="insertItemService.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span>Ajouter Un item de Service</a></h1><center>
	
              <table class="table table-striped table-bordered">
              <thead>
                   <tr>
                    <th>Label</th>
                    <th>Params</th>
                    <th>Url</th>
                    <th>Pf</th>
					<th>Action</th>
                  
                  </tr>
                  </thead>
                  <tbody>               
                      
  <?php
 while($servicespreview = $statement->fetch())
                      {   
				  
                      echo '<tr>';
                      echo '<td>' . $servicespreview['Service_Content_label'] . '</td>';
                      echo '<td>' . $servicespreview['Service_Content_Params'] . '</td>';
					  echo '<td>' . $servicespreview['Service_Content_Url'] . '</td>';
                      echo '<td>' . $servicespreview['Pf'] . '</td>';
                      echo '<td width=300>';
                      echo '<a class="btn btn-default" href="viewContent.php?Service_Content_Id=' . $servicespreview['Service_Content_Id'] . '"><span class="glyphicon glyphicon-eye-open"></span>Voir</a>';
                      echo ' ';
                      echo '<a class="btn btn-primary" href="updateContent.php?Service_Content_Id=' . $servicespreview['Service_Content_Id'] . '"><span class="glyphicon glyphicon-pencil"></span>Modifier</a>';
                      echo ' ';
                      echo  '<a class="btn btn-danger" href="deleteContent.php?Service_Content_Id=' . $servicespreview['Service_Content_Id'] . '"><span class="glyphicon glyphicon-remove"></span>Suprimer</a>';
                      echo '</td>';
                      echo '</tr>';
                  
                          
                      }
					
				Database::disconnect();
?>       
                  </tbody>
              
              
              </table>
            
            
            </div>
			 <div class="form-actions">
                  <a class="btn btn-primary" href="usesr_non_admin.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour
                  
                  </a>
                  </div>
            
        </div>
    
    
    </body>
    
    
    </html>