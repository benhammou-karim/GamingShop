<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = htmlspecialchars($_POST['username']); 
    $password = htmlspecialchars($_POST['password']);
    $hash_pass = sha1($password);

    if($username !== "" && $password !== "")
    {    
	   $clients = simplexml_load_file('../data/clients.xml');
       $count = 0;
       foreach($clients->client as $c){
             if($c->user==$username  && $c->passwd==$hash_pass ){
						   $count = $clients->count(); 
						   $numclien = $c->attributes();
						   $admin = $c->admin;
			}
        }
        if($count!=0 && $numclien > 0 ) 
        {                                         
	        $_SESSION['username'] = (string)$username;    
	        $_SESSION['numclient'] = (string)$numclien;
	        if ($admin !=0)
        	{
           		$_SESSION['admin'] = true;                       
        	}
          header('Location: ../index.php');
        }
        else
        {
           header('Location: index.php?erreur=1'); 
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); 
    }
}
else
{
   header('Location: login.php');
}

?>
