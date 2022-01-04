
<link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="style/bootstrap/js/bootstrap.bundle.min.js" ></script>
<?php
  $active = array(
    "Login" => false,
    "Signup" => false,
    "Accueil" => true,
    "Logout" => false,
    "Catigories" => false,
    "Recettes" => false,
  );
  $action = "Accueil";
  foreach ($active as $key => $value) {
    if ($value) {
      $action = $key;
      break;
    }
  }
 if (isset($_GET['action'])) {
    $active[$action] = false;
    $action = $_GET['action'];
    $active[$action] = true;
  }
  
?>
<script>
    $(document).ready(function() {
        $(".toast").toast('show');
    });
</script>
<nav class="navbar navbar-dark navbar-expand-sm bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="images/logo/yammy.svg" alt="" width="35" height="35" class="d-inline-block align-text-top">
      Yummy
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo $active['Accueil'] ? 'active':''; ?>" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $active['Recettes'] ? 'active':''; ?>" href="#">Recettes</a>
        </li>
        <li class="nav-item dropdown <?php echo $active['Catigories'] ? 'active':''; ?>">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Viandes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Végetarien</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Poissons</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Desserts & Confiseries</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Entrées</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Boissons</a></li>
          </ul>
        </li>
        <?php 
        if(isset($_SESSION['username']) && isset($_SESSION['image']) ){
          $image = $_SESSION['image'];
          if($image == null){
            $image = "images/user/default.png";
          }
          echo "
            <li class='nav-item dropdown'>
              <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
              <img src='".$image."' alt='mdo' width='32' height='32' class='rounded-circle'>
              </a>
              <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                <li><a class='dropdown-item' href='routeur.php?action=Profile'>Profile</a></li>
                <li><hr class='dropdown-divider'></li>
                <li><a class='dropdown-item' href='routeur.php?action=Logout'>Deconnexion</a></li>
            </ul>
            </li>";
        }else{
          $classLogin = $active['Login'] ? 'active':'';
          echo "<li class='nav-item'>
          <a class='nav-link  $classLogin' href='routeur.php?action=Login'>Login</a>
          </li>";
        }
        ?>
      </ul>
      <form class="d-flex">
        <input class="form-control bg-dark me-2" type="search" placeholder="Rechercher" aria-label="Search">
        <button class="btn btn-outline-danger" type="submit">Rechercher</button>
      </form>
    </div>
  </div>
</nav>
<?php
if(isset($_GET['error'])){
  //echo '<div class="alert alert-danger" role="alert">'.$_GET['error'].'</div>';
  echo "<div class='toast align-items-center text-white bg-danger position-fixed w-100 border-0 mt-1' role='alert' aria-live='assertive' aria-atomic='true'>
  <div class='d-flex'>
    <div class='toast-body '>
     ".$_GET['error']."
    </div>
    <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
  </div>
  </div>";
  unset($_GET['error']);
}
if(isset($_GET['success'])){
  echo "<div class='toast align-items-center text-white bg-success position-fixed w-100 border-0 mt-1' role='alert' aria-live='assertive' aria-atomic='true'>
  <div class='d-flex'>
    <div class='toast-body'>
     ".$_GET['success']."
    </div>
    <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
  </div>
  </div>";
  unset($_GET['success']);
}
if(isset($_GET['warning'])){
  echo "<div class='toast align-items-center text-white bg-warning position-fixed w-100 border-0 mt-1' role='alert' aria-live='assertive' aria-atomic='true'>
  <div class='d-flex'>
    <div class='toast-body'>
     ".$_GET['warning']."
    </div>
    <button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
  </div>
  </div>";
  unset($_GET['warning']);
}
?>