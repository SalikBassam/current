<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="gestion.css">
  <script src="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js
" defer></script>
<link href="
https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css
" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<div id="header">
  <div>
    <h1 class="title"><a href="homePage.php">lorem</a></h1>
  </div>
  <div class="regestration">
    <div>Sign up</div>
    <div>Login</div>
  </div>
</div>


<!--start annonce header  -->
<div id="announce_header_p">
  <?php
  include("connect.php");
  $sql = "SELECT announce.titre,announce.description,announce.date_publication,announce.prix, announce.date_publication,announce.categorie,announce.Type ,announce.code_postal, announce.Ville, client.nom,client.prenom,client.telephone FROM `announce` JOIN client ON announce.numero_client=client.numero_client WHERE numero_annouce=:numero_annouce";
  $query = $con->prepare($sql);
  $query->execute(array(':numero_annouce' => $_GET["id"]));
  $results = $query->fetch(PDO::FETCH_ASSOC);
  ?>
  <div id="announce_header_c">
    <div>
      <p><?php echo $results["Type"] ?></p>
      <p><?php echo $results["categorie"] ?></p>
    </div>
    <h2><?php echo $results["titre"] ?></h2>
    <p><i class="fa-solid fa-location-dot"></i> <?php echo $results["Ville"] . " " . $results["code_postal"] ?></p>
    <p><i class="fa-solid fa-calendar-days"></i> <?php echo $results["date_publication"] ?></p>
  </div>
  <div>
    <p><?php echo $results["prix"] ?>DH /month</p>
    <p><i class="fa-sharp fa-solid fa-share-nodes"></i> Share</p>
  </div>
</div>
<!--end annonce header  -->
<!--start gallery  -->
<div>
  <div class="slide">
    <section id="main-slider" class="splide" aria-label="My Awesome Gallery">
      <div style="position:relative;">
        <div class="splide__arrows">
          <button class="splide__arrow splide__arrow--prev">
            <i class="fa-solid fa-angle-left fa-1x"></i>
          </button>
          <button class="splide__arrow splide__arrow--next">
            <i class="fa-solid fa-angle-right fa-1x"></i>
          </button>
        </div>
        <div class="splide__track">
          <ul class="splide__list">
            <?php
            $sql_images = "SELECT * FROM images WHERE numero_annouce=:numero_annouce";
            $query_images = $con->prepare($sql_images);
            $query_images->execute(array(':numero_annouce' => $_GET["id"]));
            $results_images = $query_images->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($results_images); $i++) { ?>
              <li class="splide__slide">
                <img src="images/<?php echo $results_images[$i]["image"] ?>" alt="" class="rounded" />
              </li>
            <?php
              # code...
            }
            ?>
          </ul>
        </div>
      </div>
    </section>
    <ul id="thumbnails" class="thumbnails">
      <?php
      include("connect.php");
      $sql_images1 = "SELECT * FROM images WHERE numero_annouce=:numero_annouce";
      $query_images1 = $con->prepare($sql_images1);
      $query_images1->execute(array(':numero_annouce' => $_GET["id"]));
      $results_images1 = $query_images1->fetchAll(PDO::FETCH_ASSOC);
      for ($i = 0; $i < count($results_images1); $i++) { ?>
        <li class="thumbnail">
          <img src="images/<?php echo $results_images1[$i]["image"] ?>" alt="" />
        </li>
      <?php
      }
      ?>
    </ul>
  </div>
</div>

<!--end gallery  -->
<!--start annonce description and contact  -->
<div id="contact">
  <p><?php echo $results["nom"] . " " . $results["prenom"] ?></p>

  <button type="button" data-bs-target="#teleclient" data-bs-toggle="modal">Call Now</button>
</div>
<!-- modal telephone -->
<div class="modal fade" id="teleclient" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2 class="text-center">Telephone </h2>
        <p class="text-center border"> <?php echo $results["telephone"] ?></p>
      </div>
    </div>
  </div>
</div>
<!--end annonce description and contact  -->
<!-- /* start description and map */ -->
<div id="description">
  <div>
    <h3>Description:</h3>
    <p> <?php echo $results["description"] ?></p>
  </div>
  <div>
    <img src="./images/_ (1).jpeg" alt="">
  </div>
</div>
<!-- /* end description and map */ -->
<!-- start simular product -->
<h2 style="text-align:center;">Similar Listings</h2>
<hr class="boldLine">
<div id="annonces">
<?php
      include("connect.php");
      $sql1= "SELECT announce.numero_annouce,announce.code_postal,announce.date_publication, announce.titre, announce.prix, announce.categorie, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
      WHERE announce.Ville=:ville AND  images.check_image=:check_image";
      $query1 = $con->prepare($sql1);
      $query1->execute(array(':ville' => $results['Ville'], ':check_image'=>1));
      $results1 = $query1->fetchAll(PDO::FETCH_ASSOC);
      for ($i = 0; $i < count($results1); $i++) { ?>
  <div class="annonce">
    <img src="images/<?php echo $results1[$i]["image"] ?>" alt="">
    <div class="inf">
      <p><?php echo $results1[$i]["prix"] ?> Dh</p>
      <h3><?php echo $results1[$i]["titre"] ?></h3>
    </div>

    <div class="inf2">
      <div>
        <p><?php echo $results1[$i]["Ville"] ?></p>
      </div>
      <div>
        <p> <?php echo $results1[$i]["date_publication"] ?></p>
      </div>
      <div>
        <a  class="more" href="details.php?id=<?php echo $results1[$i]["numero_annouce"] ?>"> More </a>
      </div>
    </div>
    <div class="typeAndcateg">
      <p><?php echo $results1[$i]["categorie"] ?></p>
      <p><?php echo $results1[$i]["Type"] ?></p>
    </div>
  </div>
      <?php
      }
      ?>
</div>
<!-- end simular product -->
<!-- start footer -->
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
<script src="slide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" ></script>
<script src="https://kit.fontawesome.com/0f55910cdd.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>