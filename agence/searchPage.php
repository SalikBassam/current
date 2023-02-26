<?php 
require "connect.php";
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solaz Agency</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="search.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div id="header2">
        <div>
<h1 class="title"><a href="homePage.php">lorem</a></h1>
        </div>
        <div class="regestration">
           <div>Sign up</div>
           <div>Login</div>
        </div>
    </div>
    <section>

        <div id="panelSearch2Parent">
       <h1 class="intro">Find Your Dream Home with Our Expert Real Estate Services </h1>
   <div id="panelSearch2">
<form action="searchPage.php" method="post">
    <div>
    <label for="type">Type</label>
    <select name="type" id="types">
        <option value="" selected disabled>Choose one</option>
        <option value="vente">Sell</option>
        <option value="location">Rent</option>
    </select>
</div>
<div>
    <label for="city">City</label>
    <input type="text" name="city" id="city" placeholder="Tangier">
    </div>
    <div>
    <label for="type">Category</label>
    <select name="Category" id="Category">
        <option value="" selected disabled>Choose one</option>
        <option value="appartement">appartement</option>
        <option value="maison">maison</option>
        <option value="villa">villa</option>
        <option value="bureau">bureau</option>
        <option value="terrain">terrain</option>
    </select>
</div>
    <div>
    <label for="price">Price</label>
    <input type="number" name="price" id="price" placeholder="1500$">
</div>
<div>
<a href="searchPage.php"> <button type="submit"name="search" >Search</button></a>
</div>
</form>
   </div>
</div>
    </section>
<section id="sec2">
<hr class="boldLine">
<b><p style="text-align:left; margin-left:10%;">Results : <p></b>
<div id="annonces">
    <?php 
$type = isset($_POST['type']) ? $_POST['type'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$category = isset($_POST['Category']) ? $_POST['Category'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';

$sql = "SELECT announce.numero_annouce,announce.code_postal, announce.titre, announce.prix, announce.categorie, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
 WHERE 1=1";
if (!empty($type)) {
  $sql .= " AND categorie = '$type'";
}
if (!empty($city)) {
  $sql .= " AND Ville = '$city'";
}
if (!empty($category)) {
  $sql .= " AND Type = '$category'";
}
if (!empty($price)) {
  $sql .= " AND prix = '$price'";
}
    $annonces = $con ->query($sql);
    if($annonces->rowCount() == 0) {
        echo "No announces found.";
    } else {
    foreach($annonces AS $annonce){
    ?>
    <div class="annonce">
        <img src="./images/<?= $annonce['image']; ?>" alt="">
        <div class="inf">
        <p><?= $annonce['prix']; ?> Dh</p>
        <h3><?= $annonce['titre']; ?></h3>
    </div>
   
    <div class="inf2">
    <div>
    <p><?= $annonce['Ville']; ?></p>
</div>
<div>
    <form action="code.php" method="POST">
    <button type="submit" class="more"> 
    <a class=" more" href="details.php?id=<?= $annonce['numero_annouce']?>"> More </a> 
    </button>
</form>
</div>
</div>
<div class="typeAndcateg">
  <p><?= $annonce['categorie']; ?></p>
  <p><?= $annonce['Type']; ?></p>
</div>
    </div>
    <?php }} ?>
</div>

</section>
<footer class="footer">
     <div class="containerr">
      <div class="row">
        <div class="footer-col">
          <h4>company</h4>
          <ul>
            <li><a href="#">about us</a></li>
            <li><a href="#">our services</a></li>
            <li><a href="#">privacy policy</a></li>
            <li><a href="#">affiliate program</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>follow us</h4>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
     </div>
  </footer>

</body>
</html>