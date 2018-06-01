<?php
session_start();
   require '../database/database.php';

$User_Groupe_NameError = $User_NameError = $Service_NameError  = $User_Groupe_Name = $User_Name = $Service_Name =  "" ;

if(isset($_POST['User_Name']))
{ 
   $User_Name   = checkInput($_POST['User_Name']);
   $User_Groupe_Name = null;
   $isSuccess          = true;
	  
	   if(empty($User_Name)) 
        {
            $User_NameError = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
    if($User_Name !== "" && $isSuccess)
    {
		  $db = Database::connect();
        $statement = $db->query("SELECT count(*), users_groupe.User_Groupe_Name FROM users_preview , users_groupe WHERE 
		                         User_Name = '".$User_Name."'
		           AND  users_preview.User_Groupe_Id = users_groupe.User_Groupe_Id ");
		  
		  $UserTmp = $statement->fetch();
          $count = $UserTmp['count(*)'];
		  $User_Groupe_Name = $UserTmp['User_Groupe_Name'];
		
        if($count!=0 && $User_Groupe_Name == 'Admin') // nom d'utilisateur et mot de passe correctes
        {
          $_SESSION['User_Name'] = $User_Name;
		  $_SESSION['User_Groupe_Name'] = $User_Groupe_Name;
           header('Location: ../Admin_Backend/index.php');
	 
        }
        elseif($count!=0 && $User_Groupe_Name !='Admin')
		{ 
		    $_SESSION['User_Name'] = $User_Name;
			$_SESSION['User_Groupe_Name'] = $User_Groupe_Name;
			header('Location: ../Athers_Users_Backend/usesr_non_admin.php');
		}
		else
        {
         header('Location: ../Authentification/login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php');
}


             Database::disconnect();

function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
	
	
?>