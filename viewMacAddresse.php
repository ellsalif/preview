<?php
 require '../database/database.php';

 
if(!empty($_GET['Mac_Adressse_Id']))
{
    $Mac_Adressse_Id = checkInput($_GET['Mac_Adressse_Id']);

}
		$db = Database::connect();									   
	$statement = $db->prepare('SELECT mac_adressse,service_content.Service_Content_label,service_content.Service_Content_Name, service_content.Service_Content_Params,
                            service_content.Service_Content_Url, service_content.Pf
							FROM service_content
							WHERE  service_content.Service_Content_Id = ?');
										   


$statement->execute(array($Service_Content_Id));
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
        
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span>Admin Services Preview <span class="glyphicon glyphicon-wrench"></span></h1>
        
        <div class="container admin">
          <div class="row">
              <div class="col-sm-6">
            <h1><strong> Voir Un item de Service</strong> </h1>
                  <br>
                  
                  <form>

                   <div class="form-group">
                       <label>Label:</label><?php echo ' ' . $item['Service_Content_label']; ?>
                      
                      </div>
                      
                      <div class="form-group">
                       <label>Nom:</label><?php echo ' ' . $item['Service_Content_Name']; ?>
                      
                      </div>
                      <div class="form-group">
                       <label>Parametres:</label><?php echo ' ' .$item['Service_Content_Params']; ?>
                      
                      </div>
                      
                      <div class="form-group">
                       <label>URL:</label><?php echo ' ' . $item['Service_Content_Url']; ?>
                      
                      </div>
                      
                      <div class="form-group">
                       <label>PF:</label><?php echo ' ' . $item['Pf']; ?>
                      
                      </div>
                  
                  </form>
                   <div class="form-actions">
                  <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span>Retour
                  
                  </a>
                  </div>
              </div>          
            </div>
            
        </div>
    
    
    </body>
    
    
    </html>