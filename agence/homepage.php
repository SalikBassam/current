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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div id="header">
        <div>
        <h1 class="title"><a href="http://localhost/homepage.php">lorem</a></h1>
        </div>
        <div class="regestration">
           <div>Sign up</div>
           <div>Login</div>
        </div>
    </div>
    <section id="sec1">
        <img src="./images/francesca-tosolini-tHkJAMcO3QE-unsplash (1).jpg" alt="">
   <div id="intro">
    <h1>Connecting people &
        Beijing properties perfectly</h1>
        <p>We are recognized for exceeding client expectations and delivering great results through dedication, ease of process, and extraordinary services to our worldwide clients.</p>
   </div>
   <div id="panelSearch">
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
    </section>
<section id="sec2">
<h2>Discover the latest properties in Morocco</h2>
<p class="desc">We are very proud of the service we provide and what our guests have to say about us. Our locations and services prove we are the best.</p>
<hr class="boldLine">



<form method="POST">
    <select name="sortingSelect" id="sortingSelect">
        <option selected disabled>Sort by:</option>
        <option value="Newest">Newest annonces</option>
        <option value="Oldest">Oldest annonces</option>
        <option value="Pricelth">Price low to high</option>
        <option value="Pricehtl">Price high to low</option>
    </select>
    <button type="submit" class="sortBtn">Sort</button>
</form>

<?php
// Get the selected sort option
$sortOption = isset($_POST['sortingSelect']) ? $_POST['sortingSelect'] : '';

// Set the default sort order if no option is selected
$sortOrder = 'date_publication DESC';

// Change the sort order based on the selected option
switch ($sortOption) {
  case 'Newest':
    $sortOrder = 'date_publication DESC';
    break;
  case 'Oldest':
    $sortOrder = 'date_publication ASC';
    break;
  case 'Pricelth':
    $sortOrder = 'prix ASC';
    break;
  case 'Pricehtl':
    $sortOrder = 'prix DESC';
    break;
}
// Get the annonces from the database using the selected sort order
$sql = "SELECT announce.numero_annouce,announce.code_postal, announce.titre, announce.prix, announce.categorie, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
WHERE numero_client=1 AND  images.check_image=1";
$annonces = $con->query($sql);
?>
<div id="annonces">
    <?php 
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
    <p> <?= $annonce['date_publication']; ?></p>
</div>
<div>
       <a class="more" href="details.php?id=<?= $annonce['numero_annouce']?>"> More </a> 
</div>
</div>
<div class="typeAndcateg">
  <p><?= $annonce['categorie']; ?></p>
  <p><?= $annonce['Type']; ?></p>
</div>
    </div>
    <?php } ?>
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

    <script src="main.js"></script>
</body>
</html>