<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/profile/css/profile.css">
    <link href="style/fontawesome/css/all.css" rel="stylesheet">
    <script src="style/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <title><?php echo "@".$username;?></title>
</head>
<body>
<?php
include 'view/navbar.php';
?>
<div class="ui-bg-cover ui-bg-overlay-container text-white" style="background-color: #da94bd;">
    <div class="ui-bg-overlay bg-img-blur"></div>
    <div class="container">
      <div class="text-center py-5">
        <img src="<?php echo $image; ?>" alt="" class="ui-w-100 border border-3 border-white rounded-circle">

        <div class="col-md-8 col-lg-6 col-xl-5 p-0 mx-auto">
          <h4 class="font-weight-bold my-4"><?php echo "@".$username;?></h4>

          <div class="opacity-75 mb-4">
            <?php echo $bio; ?>
          </div>
        </div>

        <div class="text-center">
          <a href="javascript:void(0)" class="d-inline-block text-white">
            <strong>0</strong>
            <span ><strong>Recettes</strong></span>
          </a>
        </div>
      </div>
    </div>

    <div class="ui-bg-overlay-container">
      <div class="ui-bg-overlay bg-dark opacity-25"></div>
      <ul class="nav nav-tabs tabs-alt justify-content-center border-transparent">
        <li class="nav-item">
          <a class="nav-link text-white py-4 active" href="routeur.php?action=Profile&tab=Recettes">Recettes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white py-4" href="routeur.php?action=Profile&tab=Commentaires">Commentaires</a>
        </li>   
      </ul>
    </div>
  </div>
  <div class="text-center mt-2">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterRecette"><i class="far fa-plus-square"></i> Ajouter une recette</button>
  <div class="modal fade" id="ajouterRecette" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nouvelle recette</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="Titre" class="col-form-label">Titre:</label>
              <input type="text" class="form-control" id="Titre" name="titre">
            </div>
            <div class="mb-3">
              <label for="description" class="col-form-label">Description:</label>
              <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class = "mb-3">  
              <input type = 'number' class="form-control" name= "hour" min = "0" max = "59"/>  
              <input type = 'number' class ="form-control" name= "minute" min = "0" max = "100"/>  
            </div>  

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>