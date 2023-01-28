<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
        <link rel="icon" href="assets/img/icon.ico">
        <title>EMA Aubergine</title>
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
        <script src="https://kit.fontawesome.com/7ab6419628.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <header>
            <a href="/"><img src="assets/img/eggplant.png" alt="Aubergine"/></a>
            <div id="menu" class="inline responsive">
                <?
                    if (UserUtils::isAdmin())
                        echo "<a href=\"?c=Admin\"  class=\"headerhidden inline center\">
                            <i class=\"fas fa-cog\"></i>
                            <p>Admin</p>
                        </a>"
                ?>
                <a href="https://www.facebook.com/groups/1700851880151381" class="headerhidden inline center">
                    <i class="fab fa-facebook"></i></i>
                    <p>Facebook</p>
                </a>
                <a href="https://www.facebook.com/messages/t/2207624789268700" class="headerhidden inline center">
                    <i class="fab fa-facebook-messenger"></i>
                    <p>Messenger</p>
                </a>
                <a href="?c=Pan" class="headerhidden inline center">
                    <i class="fas fa-dumbbell"></i>
                    <p>Blocs Pan</p>
                </a>
                <a href="?c=Meme" class="headerhidden inline center">
                    <i class="fa-regular fa-image"></i>
                    <p>Best Même</p>
                </a>
            </div>
            <a href="?c=User">
                <i class="fas fa-user"></i>
            </a>
        </header>

        <div id="content" class="center">
