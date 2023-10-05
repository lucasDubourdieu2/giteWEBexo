<!DOCTYPE html>
<html>

<head>
    <title>Site web Le gite</title>
    <link rel="stylesheet" href="../css/front-header.css">
    <link rel="stylesheet" href="../css/front-footer.css">
    <link rel="stylesheet" href="../css/coordonnees.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <header>
        <?php include '../includes/front-header.php'; ?>
    </header>
    <main>
        <address class="coord">
            <div class="coor-container">
                <div class="coordonnees">
                    <h1>Coordonnées</h1>
                    <ul>
                        <li>
                            <span class="icon"><i class="fas fa-phone"></i></span>
                            +33(0) 6 41 57 73 20
                        </li>
                        <li>
                            <span class="icon"><i class="fab fa-facebook"></i></span>
                            <a href="https://www.facebook.com/gitefiguies"> gitefiguies </a>
                        </li>
                        <li>
                            <span class="icon"><i class="fas fa-envelope"></i></i></span>
                            <a href="mailto:beatrice.boyer29@orange.fr">beatrice.boyer29@orange.fr</a>
                        </li>
                    </ul>


                </div>

                <div class = "adresse">
                    <h1>Adresse</h1>
                    <ul>
                        <li>Figuiès </li>
                        <li> 140 rue de Figuiès</li>
                        <li>12330 Salles-la-Source</li>
                    </ul>

                </div>  
            </div>
        
            <div class="carte">
                <h1>Nous retrouver facilement</h1>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2848.228557347759!2d2.4907474767109212!3d44.44898440059934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b28229b9ad4bb3%3A0x53e8b9991335fc4d!2s140%20Figuies%2C%2012330%20Salles-la-Source!5e0!3m2!1sfr!2sfr!4v1696339440198!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            



        </address>

    </main>


    <footer>
        <?php include '../includes/front-footer.php'; ?>
    </footer>
</body>

</html>