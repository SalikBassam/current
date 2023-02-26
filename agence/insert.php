<?php 
include("connect.php");
session_start();
try {
      $check=0;
      $count=count($_FILES['images']['name']);
      $sql = "INSERT INTO announce (`numero_annouce`, `titre`, `prix`, `date_publication`, `date_modification`, `categorie`, `Type`, `code_postal`, `Ville`, `numero_client`) VALUES (NULL,:title,:price,:datepub,:dateupdat,:categorie,:type,:codepostal,:ville,:client)";
        $query = $con->prepare( $sql );
        $result = $query->execute( array( ':title'=>$_POST["titleAdd"], ':price'=>$_POST["priceAdd"],':datepub'=>date('Y-m-d'),':dateupdat'=>date('Y-m-d'),':categorie'=>$_POST["categorieaadd"], ':type'=>$_POST["typeAdd"], ':codepostal'=>$_POST["codpostal"], ':ville'=>$_POST["villeadd"], ':client'=>$_SESSION["client_id"] ) );
        if ($result)
        {
            $lastindex=$con->lastInsertId();
            for ($i=0; $i < $count ; $i++) { 
                $fileName = $_FILES["images"]["name"][$i];
                $tempName = $_FILES["images"]["tmp_name"][$i];
                $folder = "images/" . $fileName;
                move_uploaded_file($tempName, $folder);
                if ($_FILES['images']['name'][$i]== $checkedImage) {
                    $check=1;
                }
                else
                {
                    $check=0;
                }
                echo $check;
                $sql1=" INSERT INTO images ( `image`, `check_image`, `numero_annouce`) VALUES ( :image , :check_image, :numero_annouce)";
                $query1 = $con->prepare( $sql1 );
                $result1 = $query1->execute( array(':image'=>$fileName , ':check_image'=>$check,':numero_annouce'=>$lastindex));
                header("location: profile.php");
            }
        }

} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}


?>