<!DOCTYPE html>

<html>
   <head>
      <title>Login 05</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="style/login/css/login.css">
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
              <form action="routeur.php" method="POST">
              <input type="hidden" name="action" value="LoginAccount">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="floatingInput" name="username" placeholder="name@example.com" required>
                  <label for="floatingInput">Adresse email</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Mot de passe" required>
                  <label for="floatingPassword">Mot de passe</label>
                </div>

                <div class="d-grid">
                  <button class="btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2" name="envoyer" type="submit">Se Connecter</button>
                  <div class="text-center">
                    <a class="small" href="routeur.php?action=Signup">vous n'avez pas de compte ?</a>
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