<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<form method="get" action="php/traitement.php">
	<h1>Magasin de sport</h1>
	<h2>Affichage du stock des produits</h2>

	La marque :<br>
	<select name="inputmarque">			
		<option value="Tous">Toutes les marques</option>
		<option value="Adidas">Adidas</option>
		<option value="Nike">Nike</option>
		<option value="Puma">Puma</option>
	</select>
	<br><br>
	
	Le prix maximum :<br>
		<input type="text" name="inputprix">
	<br><br>

	La catégorie :<br>
	<select name="inputcategorie">			
		<option value="Tous">Toutes les catégories</option>
		<option value="Ballons">Ballon de sport</option>
		<option value="Chaussures">Chaussures de sport</option>
	</select>
	<br><br>
	
	<button type="submit" value="envoyer">Envoyer</button>
	<button type="reset" value="reinitialiser">Réinitialiser</button>
</form>

</body>
</html>