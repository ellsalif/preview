<?php
 require '../database/database.php';
 $Services_IdError = $Services_Id = $Service_Name  = "";
  echo "Bonjour";
  if(!empty($_GET)) 
    {    echo $_GET['Services_Id'];
         echo "Bonjour";
		$Services_Id              		    = checkInput($_GET['Services_Id']);
        $isSuccess = true;
		$result = Null;
		$tmpName = Null;
		$rep= '../Configuration';
		 $tmpGroupeName =  Null;
		 $tablo = array();
		if(empty($Services_Id)) 
        {
			  echo "Bonjour";
            $isSuccess = false;
        } 
        if($isSuccess) 
        {
			  echo "Bonjour";
            $db = Database::connect();
            $statement = $db->prepare('SELECT service_content.Services_Id, service_content.Service_Content_Id, service_content.Service_Content_label, service_content.Service_Content_Name, service_content.Service_Content_Params,
                            service_content.Service_Content_Url, service_content.Pf, services_preview.Service_Name,users_groupe.Users_Groupe_Id,users_groupe.Users_Groupe_Name,
							users_groupepreview.Users_Groupe_Id ,users_groupepreview.Services_Id
							FROM service_content, services_preview, users_groupepreview,users_groupe
							WHERE  service_content.Services_Id = ?
							AND service_content.Services_Id = services_preview.Services_Id
							AND users_groupepreview.Users_Groupe_Id = users_groupe.Users_Groupe_Id
							AND users_groupepreview.Services_Id = services_preview.Services_Id');
	        $statement->execute(array($Services_Id));
			 echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
            var_dump($statement);
			
			while($result = $statement->fetch()){
				$tablo[] =$result;	
				$tmpName =  $result['Service_Name'];
				$tmpGroupeName =  $result['Users_Groupe_Name'];
			}
    
			 print_r($tablo);
		      
			  echo  $tmpName;
		  
			   Database::disconnect();
          //header("Location: view.php?Services_Id=$Services_Id");
		  		
        }
		 $contenu_json =json_encode($tablo);
	
				// Nom du fichier à créer
			$nom_du_fichier =  $tmpName.'_'.$tmpGroupeName.'.json';
				// Ouverture du fichier
			$fichier = fopen("$rep/$nom_du_fichier", 'w+');

				// Ecriture dans le fichier
			fwrite($fichier, $contenu_json);

				// Fermeture du fichier
				fclose($fichier);

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
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Admin USer Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Editer Une Configuration</strong></h1>
                <br>
                <form class="form" action="usesr_non_admin.php" role="form" method="post">
                    <input type="hidden" name="Services_Id" value="<?php echo $Services_Id;?>"/>
                    <p class="alert alert-warning">Etes vous sur de vouloir Editer cette configuration ?</p>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-warning">Oui</button>
                      <a class="btn btn-default" href="index.php">Non</a>
                    </div>
                </form>
            </div>
        </div>   
    </body>
</html>