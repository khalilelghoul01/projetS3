<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="style/login/css/login.css">
		<title>Creation d'un compte</title>

	</head>
	

	<body>
   <?php 
			include 'view/navbar.php';  
	?>
   <div class="container-fluid ps-md-0">
  <div class="row g-0">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
              <h3 class="login-heading mb-4">Bienvenue à Yummy</h3>

              <!-- Sign In Form -->
              <form action="routeur.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="action" value="CreateAccount">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                  <label for="floatingInput">Adresse email</label>
                </div>
				        <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name">
                  <label for="floatingInput">Nom d'utilisateur</label>
                </div>
				       <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" name="password" id="password" placeholder="Mot de passe">
                  <label for="floatingPassword">Mot de passe</label>
                </div>
				        <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="floatingInput" name="bio" >
                  <label for="floatingInput">Biographie (option)</label>
                </div>
                <div class="mb-3">
                <label for="formFileLg" class="form-label">Photo de profil</label>
                  <input class="form-control form-control-lg" name="photo" type="file" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"/>
                </div>
                <div class="d-grid">
                  <button class="btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2" name="envoyer" type="submit">S'inscrire</button>
                  <div class="text-center">
                    <a class="small" href="routeur.php?action=Login">vous avez un compte ?</a>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

   </body>
</html>