<?php
include("connect.php");
include("header.php");
?>

<div id="header">
  <div>
    <h1 class="title"><a href="homePage.php">lorem</a></h1>
  </div>
  <div class="regestration">
    <div>Sign up</div>
    <div>Login</div>
  </div>
</div>
<div class="mt-5">
<div class="d-flex gap-2 justify-content-center p-4">
  <button type="submit" class="btn btn-primary mb-3 w-25" data-bs-target="#addannounce" data-bs-toggle="modal">+ Ajouter un announce</button>
  <a data-bs-target="#editinfo" data-bs-toggle="modal"><i class="fa-solid fa-gear fa-2x"></i></a>
</div>
<div class="container d-flex flex-wrap gap-2" id="annonces">
  <?php
  $sql ="SELECT announce.numero_annouce,announce.code_postal, announce.titre, announce.prix, announce.categorie, announce.Type,announce.Ville,images.image FROM announce JOIN images on announce.numero_annouce=images.numero_annouce
   WHERE numero_client=:numero_client AND  images.check_image=1";
  $query = $con->prepare($sql);
  $query->execute(array(':numero_client' => $_SESSION["client_id"]));
  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  for ($i = 0; $i < count($results); $i++) {
  ?>
    <div class="annonce">
      <img src="images/<?php echo $results[$i]["image"] ?>" alt="">
      <div class="inf">
        <p><?php echo $results[$i]["prix"] ?> Dh</p>
        <h3><?php echo $results[$i]["titre"] ?></h3>
      </div>
      <div class="inf2">
        <div>
          <p><?php echo $results[$i]["categorie"] ?></p>
        </div>
        <div>
          <p style="color:black;"><b>For <?php echo $results[$i]["Type"] ?></b></p>
        </div>

        <div>
          <a href="details.php?id=<?php echo $results[$i]["numero_annouce"] ?>" class="more"> More </a>
          </form>

        </div>
      </div>
      <div class="btns">
        <a data-bs-target="#editannounce<?php echo $results[$i]["numero_annouce"] ?>" data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"></i></a>
        <a data-bs-target="#deleteannonce<?php echo $results[$i]["numero_annouce"] ?>" data-bs-toggle="modal"><i class="fa-regular fa-trash-can"></i></a>
      </div>
      <!-- modal delete -->
      <div class="modal fade" id="deleteannonce<?php echo $results[$i]["numero_annouce"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <form action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $results[$i]["numero_annouce"] ?>">
                <h2 class="text-center">Supprimer votre annonce</h2>
                <p>pouvez vous supprimer cette announce</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Supprimer</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal updat -->
      <div class="modal modal-lg fade" id="editannounce<?php echo $results[$i]["numero_annouce"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body container p-5">
              <form action="editannounce.php" method="POST" class="myFormupdat" enctype="multipart/form-data">
                <h2 class="text-center">Modifier votre annonce</h2>
                <input type="hidden" name="id" value="<?php echo $results[$i]["numero_annouce"] ?>">
                <div class=" d-flex flex-column gap-3">
                  <div class="formvalid">
                    <div class="d-flex gap-2 flex-wrap m-3 ">
                      <?php
                      $sql_images = "SELECT image FROM `images` WHERE `numero_annouce`=:numero_annouce";
                      $query_images = $con->prepare($sql_images);
                      $query_images->execute(array(':numero_annouce' => $results[$i]["numero_annouce"]));
                      $result_images = $query_images->fetchAll(PDO::FETCH_ASSOC);
                      for ($j = 0; $j < count($result_images); $j++) { ?>
                        <div class="d-flex flex-wrap gap-3 images1">
                          <div class="image">
                            <img src="images/<?php echo $result_images[$j]["image"] ?>" alt="Snow" style="width:100%;">
                            <div class="bottom-left">
                              <input type="radio" name="statuupdat" value="<?php echo $result_images[$j]["image"] ?>">
                              principal
                            </div>
                            <input type="hidden" name="imageupdtat<?php echo $results[$i]["numero_annouce"] ?>[]" value="<?php echo $result_images[$j]["image"] ?>">
                            <a class="top-right" onclick="remove_updat(this)"><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
                          </div>
                        </div>
                      <?php

                      }
                      ?>
                      <div class="rectangle_updat">
                        <label for="image_updat<?php echo $results[$i]["numero_annouce"] ?>" class="icon">
                          <i class="fa fa-plus"></i>
                        </label>
                        <input id="image_updat<?php echo $results[$i]["numero_annouce"] ?>" name="images_updat<?php echo $results[$i]["numero_annouce"] ?>[]" type="file" multiple>
                      </div>
                    </div>
                    <small></small>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="titleupdat" class="form-label">Titre</label>
                      <input type="text" name="titleupdat" class="form-control titleupdat" value="<?php echo $results[$i]["titre"] ?>" placeholder="Titre" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="priceupdat" class="form-label">Montant</label>
                      <input type="number" min="0" name="priceupdat" class="form-control priceupdat" value="<?php echo $results[$i]["prix"] ?>" placeholder="Montant" />
                      <small></small>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="villeupdat" class="form-label">Ville</label>
                      <input type="text" name="villeupdat" class="form-control villeupdat" value="<?php echo $results[$i]["Ville"] ?>" placeholder="Adresse" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="typeupdat" class="form-label">Type</label>
                      <select class="form-select typeupdat" name="typeupdat">
                        <option selected disabled>Choisir</option>
                        <option value="Location" <?php if ($results[$i]["Type"] == "Location") echo 'selected'; ?>>Location</option>
                        <option value="Vente" <?php if ($results[$i]["Type"] == "Vente") echo 'selected'; ?>>Vente</option>
                      </select>
                      <small></small>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="codpostalupdat" class="form-label">Code postal</label>
                      <input type="number" name="codpostalupdat " class="form-control codpostalupdat" value="<?php echo $results[$i]["code_postal"] ?>" placeholder="Code postal" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="categorieupdat" class="form-label">Categorie</label>
                      <select class="form-select categorieupdat" name="categorieupdat">
                        <option selected disabled>Choisir</option>
                        <option value="appartement" <?php if ($results[$i]["categorie"] == "appartement") echo 'selected'; ?>>appartement</option>
                        <option value="maison" <?php if ($results[$i]["categorie"] == "maison") echo 'selected'; ?>>maison</option>
                        <option value="villa" <?php if ($results[$i]["categorie"] == "villa") echo 'selected'; ?>>villa</option>
                        <option value="bureau" <?php if ($results[$i]["categorie"] == "bureau") echo 'selected'; ?>>bureau</option>
                        <option value="terrain" <?php if ($results[$i]["categorie"] == "terrain") echo 'selected'; ?>>terrain</option>
                      </select>
                      <small></small>
                    </div>
                  </div>
                  <div class="formvalid">
                    <label for="descriptionupdat" class="form-label">Description</label>
                    <textarea class="form-control descriptionupdat" name="descriptionupdat" rows="3"></textarea>
                    <small></small>
                  </div>
                  <div class="justify-content-end d-flex">
                    <button name="updatBtn" value="updatBtn" type="submit" class="btn bg-dark text-white">Modifier</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php
  }
    ?>

    <?php require('modal_add.php') ?>
    <?php require('modal_info.php') ?>
    </div>
</div>
</div>

<?php
include("footer.php");
?>