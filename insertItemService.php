<?php
 require '../database/database.php';
  $Service_Content_labelError = $Service_Content_NameError = $Service_Content_ParamsError = $Service_Content_UrlError = $Services_IdError = $PfError = $Service_Content_label = $Service_Content_Name = $Service_Content_Params = $Service_Content_Url = $Services_Id = $Pf = "";
  
  if(!empty($_POST)) 
    {    echo $_POST['Services_Id'];


        $Service_Content_label              = checkInput($_POST['Service_Content_label']);
		$Service_Content_Name               = checkInput($_POST['Service_Content_Name']);
        $Service_Content_Params             = checkInput($_POST['Service_Content_Params']);
		$Service_Content_Url                = checkInput($_POST['Service_Content_Url']);
		$Services_Id              		    = checkInput($_POST['Services_Id']);
		$Pf                                 = checkInput($_POST['Pf']);
		
		
        $isSuccess = true;
        
        if(empty($Service_Content_label)) 
        {
            $Service_Content_labelError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($Service_Content_Name)) 
        {
            $Service_Content_NameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($Service_Content_Params)) 
        {
            $Service_Content_ParamsError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        
		if(empty($Service_Content_Url)) 
        {
            $Service_Content_UrlError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
		
		if(empty($Services_Id)) 
        {
            $Services_IdError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
		if(empty($Pf)) 
        {
            $PfError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
		 echo $_POST['Services_Id'];
        if($isSuccess) 
        {
			echo "je suis dans issucees";
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO service_content(Service_Content_label,Service_Content_Name,Service_Content_Params,Service_Content_Url,Services_Id,Pf) values(?, ?, ?, ?, ?, ?)");
	        $statement->execute(array($Service_Content_label,$Service_Content_Name,$Service_Content_Params,$Service_Content_Url,$Services_Id,$Pf));
			 echo "jai pris la requette";
            
			
			  echo "\nPDOStatement::errorInfo():\n";
            $arr = $statement->errorInfo();
             print_r($arr);
            var_dump($statement);
		   Database::disconnect();
          header("Location: view1.php?Services_Id=$Services_Id");
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
        <link rel="stylesheet" href="../Css/style.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-wrench"></span> Services De Preview <span class="glyphicon glyphicon-wrench"></span></h1>
         <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un Item de Service</strong></h1>
                <br>
                <form class="form" action="insertItemService.php" role="form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Service_Content_label">Nom:</label>
                        <input type="text" class="form-control" id="Service_Content_label" name="Service_Content_label" placeholder="Nom" value="<?php echo $Service_Content_label;?>">
                        <span class="help-inline"><?php echo $Service_Content_labelError;?></span>
                    </div>
                    <div class="form-group">
                        <label for="Service_Content_Name">Name:</label>
                        <input type="text" class="form-control" id="Service_Content_Name" name="Service_Content_Name" placeholder="Service_Content_Name" value="<?php echo $Service_Content_Name;?>">
                        <span class="help-inline"><?php echo $Service_Content_NameError;?></span>
                    </div>
					<div class="form-group">
                        <label for="Service_Content_Params">Parametres:</label>
                        <input type="text" class="form-control" id="Service_Content_Params" name="Service_Content_Params" placeholder="Parametres" value="<?php echo $Service_Content_Params;?>">
                        <span class="help-inline"><?php echo $Service_Content_ParamsError;?></span>
                    </div>
					
					<div class="form-group">
                        <label for="Service_Content_Url">URL:</label>
                        <input type="text" class="form-control" id="Service_Content_Url" name="Service_Content_Url" placeholder="URL" value="<?php echo $Service_Content_Url;?>">
                        <span class="help-inline"><?php echo $Service_Content_UrlError;?></span>
                    </div>
					
					 <div class="form-group">
                        <label for="Services_Id">Service:</label>
                        <select class="form-control" id="Services_Id" name="Services_Id">
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT Services_Id,Service_Name FROM  services_preview') as $row) 
                           {
                                echo '<option value="'. $row['Services_Id'] .'">'. $row['Service_Name'] . '</option>';;
                           }
                           Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $Services_IdError;?></span>
                    </div>
					
			        <div class="form-group">
                        <label for="Pf">Pf:</label>
                        <input type="text" class="form-control" id="Pf" name="Pf" placeholder="Pf" value="<?php echo $Pf;?>">
                        <span class="help-inline"><?php echo $PfError;?></span>
                    </div>
			
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="usesr_non_admin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>