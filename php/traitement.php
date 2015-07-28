<?php
// Andrea Furikova 28/3/2015

// initialise les variables $prixMax, $marqueChoisie et $categorieChoisie, et affecte aux variables les valeur d'un formulaire
if (isset($_GET["inputprix"]) && $_GET["inputprix"] != ""){
	$prixMax = floatval($_GET["inputprix"]);
}
else{
	$prixMax = 0;
}

if (isset($_GET["inputmarque"])){
	$marqueChoisie = $_GET["inputmarque"];
}
else{
	$marqueChoisie = "Tous";
}

if (isset($_GET["inputcategorie"])){
	$categorieChoisie = $_GET["inputcategorie"];
}
else{
	$categorieChoisie = "Tous";
}

// crée la connexion à la base de données
$sourceDeDonnees = "mysql:host=localhost;dbname=appliquez-php";
$nomUtilisateur = "root";
$motPass = "";

$connexion = new PDO($sourceDeDonnees,$nomUtilisateur,$motPass);

// définis la requête sql
$sql = "SELECT * FROM produits";

if ($marqueChoisie != "Tous" || $prixMax != 0 || $categorieChoisie != "Tous"){
	$sql = $sql." WHERE";
	if ($marqueChoisie != "Tous"){
		$sql = $sql." marque = '$marqueChoisie'";
	}
	if ($prixMax != 0){
		if ($marqueChoisie != "Tous"){
			$sql = $sql." AND";
		} 
		$sql = $sql." pu <= $prixMax";
	}
	if ($categorieChoisie != "Tous"){
		if ($marqueChoisie != "Tous" || $prixMax != 0){
			$sql = $sql." AND";
		}
		$sql = $sql." categorie = '$categorieChoisie'";
	}
}

// crée une variable contenant les resultats de la requête sql
$resultats = $connexion->query($sql);

// crée une variable auxillaire pour vérifier les resultats de la requête sql
$trouveUnArticle = false;

// créé une variable contenant le contenu de l'affichage de HTML qui est par defaut vide
$ligneReponse = "";

// affiche le debut de l'affiche HTML
echo"<!DOCTYPE html>
	 <html>
	     <head>
	         <meta charset=\"utf-8\">
	     </head>
	 <body>";

// affiche le tablau et définis le style et le format de sa première ligne
echo "<table>";
echo "<tr style='font-family: Tahoma, sans-serif; font-size: 10px; background-color: #000066; color: white'><td><b>Descriptions</b></td><td><b>Marques</b></td><td><b>Catégories</b></td><td><b>Prix unitaires</b></td><td><b>En stock</b></td></tr>";

// traite les resultats de la requête sql
foreach($resultats as $enregistrement){
	// mets en forme adéquate (rouge), si le stock de l'élément retourné est vide, sinon garde le format standard
	if($enregistrement["stock"] == 0){
   		$ligneReponse = $ligneReponse."<tr style='font-family: Tahoma, sans-serif; font-size: 12px; background-color: #ffdddd; color: black'>";
   	} else {
      $ligneReponse = $ligneReponse."<tr style='font-family: Tahoma, sans-serif; font-size: 12px; background-color: #eeeeff; color: black'>";
         }
    // pour chaque eregistrement trouvé crée une ligne du tableau qui sera affichée
	$ligneReponse = $ligneReponse."<td>".$enregistrement['description']."</td>";
	$ligneReponse = $ligneReponse."<td>".$enregistrement['marque']."</td>";
	$ligneReponse = $ligneReponse."<td>".$enregistrement['categorie']."</td>";
	$ligneReponse = $ligneReponse."<td>".$enregistrement['pu']."</td>";
	$ligneReponse = $ligneReponse."<td>".$enregistrement['stock']."</td></tr>";
	
	// si la requête a abouti, change la valeur de la variable $trouveUnArticle à true
	if ($ligneReponse){
		$trouveUnArticle = true;
	}

	// affiche la ligne
	echo $ligneReponse;

	// vide la variable $ligneReponse
	$ligneReponse = "";
}
// ferme le tableu affiché
echo "</table>";

// si la requête n'avait pas abouti, affiche un message
if (!$trouveUnArticle){
	echo "<hr /><b>Désolé mais votre recherche n'a donné aucun résultat !</b><hr />";
}

// affiche un lien pour rentrer à la page d'articles sport
echo "<br><a href=\"../magasinsport.php\">Retour au formulaire HTML</a>";

// fin du document HTML
echo "</body>
	  </html>";

?>	