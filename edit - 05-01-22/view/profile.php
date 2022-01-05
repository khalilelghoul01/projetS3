<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/profile/css/profile.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <link href="style/fontawesome/css/all.css" rel="stylesheet">
  <title><?php echo "@" . $username; ?></title>
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
          <h4 class="font-weight-bold my-4"><?php echo "@" . $username; ?></h4>

          <div class="opacity-75 mb-4">
            <?php echo $bio; ?>
          </div>
        </div>

        <div class="text-center">
          <a href="javascript:void(0)" class="d-inline-block text-white">
            <strong><?php echo $nbRecettesPerUser; ?></strong>
            <span><strong>Recettes</strong></span>
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
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ajouterRecette"><i class="far fa-plus-square"></i> Ajouter une recette</button>
    <div class="modal fade" id="ajouterRecette" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nouvelle recette</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <form action="routeur.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="action" value="CreateRecette">
              <div class="mb-3">
                <label for="Titre" class="col-form-label">Titre:</label>
                <input type="text" class="form-control" id="Titre" name="titre" required>
              </div>
              <div class="mb-3">
                <label for="image" class="col-form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="photo" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
              </div>
              <div class="mb-3">
                <label for="categories" class="col-form-label">Categories:</label>
                <select class="form-control" id="categories" name="categories" required>
                  <option value="1">Viandes</option>
                  <option value="2">Végétarien</option>
                  <option value="3">Poissons</option>
                  <option value="4">Desserts</option>
                  <option value="5">Entrées</option>
                  <option value="6">Boissons</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="description" class="col-form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="description" class="col-form-label">Etapes:</label>
                  </div>
                  <div class="col">
                    <button type="button" onClick="jqueryStuffAdd()" class="btn btn-success" name="ajouter"><i class="far fa-plus-square"></i></button>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3" id="ajouter"></div>
                </div>
              </div>
              <div class="container mb-3">
                <div class="row">
                  <label for="time" class="col-form-label">Durée:</label>
                </div>
                <div class="row">
                  <div class="col">
                    <input type='number' class="form-control" name="hours" placeholder="heures" min="0" max="48" required />
                  </div>
                  <div class="col">
                    <input type='number' class="form-control" name="minutes" placeholder="minutes" min="0" max="59" required />
                  </div>
                </div>
              </div>
              <div class="container mb-3">
                <div class="row">
                  <div class="col">
                    <label for="time" class="col-form-label">Nombres de personnes:</label>
                    <input type='number' class="form-control" name="nbpersonnes" placeholder="Nombres de personnes " min="0" max="20" required />
                  </div>
                  <div class="col">
                    <label for="time" class="col-form-label">Difficulté:</label>

                    <input type='number' class="form-control" name="difficulte" placeholder="Difficulté" min="1" max="10" required />
                  </div>
                </div>
              </div>
              <div class="container mb-3">
                <div class="row">
                  <div class="col">
                    <button type="submit" class="btn btn-danger" name="envoyer">Créer</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">fermer</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var counter = 0;

    function jqueryStuffAdd() {
      counter++;
      var div = document.createElement("div");
      div.innerHTML = "<div class='row mb-1' id='etape-id-" + counter + "'><div class='col-4'><input type='text' class='form-control' name='nom-etape-" + counter + "' placeholder='Nom étape' required></div><div class='col'><textarea type='text' class='form-control' name='etape-" + counter + "' placeholder='Etape " + counter + "' required></textarea></div><div class='col-2'><button type='button' id='" + counter + "' onClick='jqueryStuffDelete(this.id)' class='btn btn-danger' name='supprimer'><i class='far fa-minus-square'></i></button></div></div>";
      document.getElementById("ajouter").parentNode.appendChild(div);
    }

    function jqueryStuffDelete(id) {
      if (counter > 0) {
        document.getElementById("ajouter").parentNode.removeChild(document.getElementById("etape-id-" + id).parentNode);
        counter--;
      }
    }
  </script>
</body>

</html>