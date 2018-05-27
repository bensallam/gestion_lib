
<html>
<head>
	<meta http-equiv="Content_Type" content="text/html; charset=utf-8"/>
	<title>bibliotheque d' universite batna2</title>
</head>
<body>
<h1>bibliotheque d' universite batna2 - Recherche</h1>
<?php
/*
* Renvoyer a l'écran de connexion si l'utilisateur n'est pas connecté
*/
session_start();
if(!isset($_SESSION['user'])){
	header('Location: index.php'); die;
}
$user=$_SESSION['user'];
/*
*Interception de la requete POST
*/
if ($_SERVER['REQUEST_METHOD'] === "POST") {
$button=$_POST['submit'];
	$critere=$_POST['critere'];
	$mot_cle=$_POST['mot_cle'];
	if ($button=="Recherche") {
		/*
        *Recherche-t-on un auteur ou titre ou filiére?
        */
        if (critere=="titre") {
        	$Location='Location:liste_livres.php?titre='.$mot_cle;
        }
         if (critere=="auteur") {
        	$Location='Location:liste_livres.php?auteur='.$mot_cle;
        } 
        	if (critere=="filiere") {
        	$Location='Location:liste_livres.php?filiere='.$mot_cle;
        }

        
		header($Location);die;
	}
}
?>
<form method="post" action="recherche.php">
	<table>
		<!-- Insertion de menu dans la table -->
		<?php
		if ($user=="admin") {
			include "../includes/admin_menu.php";
		}else{
			include "../includes/user_menu.php";
		}
		?>
		<td valign="top">
			<table>
				<tr>
					<input type="radio" name="critere" value="titre" checked="checked"/>Titre
					<input type="radio" name="critere" value="auteur" checked="checked"/>Auteur
					<input type="radio" name="critere" value="filiere" checked="checked"/>Filiére
				</tr>
				<td>
					<input type="text" name="mot_cle" size="40"/>
					<input type="submit" name="submit" value="Recherche"/>
				</td>

			</table>
		</td>
	</table>
</form>

</body>
</html>
