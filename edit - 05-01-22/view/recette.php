<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<title>Accueil (avant connection)</title>
	</head>
	<body>
	<?php 
			include 'view/navbar.php';
		
		echo "<section class='py-5'>
            <div class='flex-row px-4 px-lg-5 my-5'>
                <div class='d-flex justify-content-center gx-4 gx-lg-5 align-items-center'>
                    <div class='col-md-9'><img class='card-img-top mb-5 mb-md-0' src='".$recette->getThumbnail()."' alt='...' /></div>
                    <div class='col-md-6'>
                        <div class='small mb-1'>ID: ".$id."</div>
                        <h1 class='display-5 fw-bolder'>".$recette->getTitre()."</h1>
                        <div class='fs-5 mb-5'>
                            <span><strong>".$recette->getNB_Personnes()."</strong> Personnes</span>
							<span><strong>".$recette->getNiveau_Difficulte()."/10</strong> DifficultÃ©</span>
							<span><strong>".$recette->getDuree()."</strong> Min</span>
                        </div>
                        <p class='lead'>".$recette->getEtapes()."</p>
                        <div class='d-flex'>
                            <button class='btn btn-outline-danger flex-shrink-0' type='button'>
								<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-heart' viewBox='0 0 16 16'>
								<path d='m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z'/>
								</svg>
								favoris
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>";
	?>
	</body>
</html>