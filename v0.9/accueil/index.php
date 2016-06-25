<?php
$Utilisateur = "";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr-fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	
	<title>KeoAffect › Connexion</title>
	<link rel="stylesheet" id="buttons-css" href="../config/css/buttons.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="login-css" href="../config/css/login.min.css" type="text/css" media="all">
    <link rel="stylesheet" id="custom-login-css" href="../config/css/bootstrap.min.css" type="text/css" media="all">
	</head>
	<body class="login login-action-login wp-core-ui  locale-fr-fr">
	<div id="login">
		    <h1 style="height: 50px;"><a href="" title="KeoAffect" tabindex="-1"></a></h1>
            <img style="width: 800px;" src="../config/css/img/login-logo.png" />
	  <?php // A VOIR SI UNE AUTHENTIFICATION VIA AD EST POSSIBLE
                @$Auth = $_POST['Auth']; //Test l'Authentification
                if ($Auth == 1){ // Si une authentification est demander alors on test les informations.
                    @$user = $_POST['log'];
                    @$pass = $_POST['pwd'];
                    @$ds = ldap_connect("kiwi.private");  // On initialise la connexion au domaine (doit être un serveur LDAP valide !)
                    @$r = ldap_bind($ds,"$user@kiwi.private","$pass");
                    @$sr = ldap_search($ds,"OU=Users,OU=KEOLIS AIX,OU=Grands Réseaux,OU=KEOLISPROD,DC=kiwi,DC=private","sAMAccountName=".$user);
                    @$nb = ldap_get_entries($ds, $sr);	
                    if($r){ // Si l'email && psw correspond alors le nombre de ligne de la requete sera 1 
                        header('Location: menu.php');
                    }
                    else{ // Sinon on lui demande de réessayer (Captcha ? AntiBot ? etc.. A définir) 
        ?>
    <form name="loginform" id="loginform" action="#" method="post">
	    <p>
		    <label for="user_login">Nom d'utilisateur<br>
		    <input type="text" name="log" id="user_login" class="input" value="" size="20"></label>
	    </p>
	    <p>
		    <label for="user_pass">Mot de Passe<br>
		    <input type="password" name="pwd" id="user_pass" class="input" value="" size="20"></label>
	    </p>
	    <p class="submit">
		    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
	    </p>
        <p class="forgetmenot" ><label for="rememberme" style="margin-top: 2%;background-color: rgb(200, 0, 0);color: white;">Connection Refusée</label></p>
        <p><input type="text" name="Auth" value="1" style="display: none"/></p>
    </form>

    <p id="nav">
	    <a href="#">-> Mot de Passe perdu ? <-</a>
    </p>
	</div>
            <?php
                        }            
                    }
                else{ //Si aucune authentification est demander alors il en demande une... Logique en fin de compte.
        ?>
            <form name="loginform" id="loginform" action="#" method="post">
	    <p>
		    <label for="user_login">Nom d'utilisateur<br>
		    <input type="text" name="log" id="user_login" class="input" value="" size="20"></label>	    </p>
	    <p>
		    <label for="user_pass">Mot de Passe<br>
		    <input type="password" name="pwd" id="user_pass" class="input" value="" size="20"></label>
	    </p>
	    <p class="submit">
		    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In">
	    </p>
        <p class="forgetmenot" ><label for="rememberme" style="margin-top: 2%;background-color: rgb(200, 0, 0);color: white;visibility: hidden">Connexion Refusée</label></p>
        <p><input type="text" name="Auth" value="1" style="display: none"/></p>
    </form>

    <p id="nav">
	    <a href="#">-> Mot de Passe perdu ? <-</a>
    </p>
	</div>
    <?php
}
 ?>
	<div class="clear"></div>
	</body></html>