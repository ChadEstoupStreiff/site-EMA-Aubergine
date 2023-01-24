<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>EMA Aubergine</title>
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">
        <script src="https://kit.fontawesome.com/7ab6419628.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <header>
            <a href="/"><i class="fas fa-home"></i></a>
            <div id="menu" class="inline">
                <?
                    if (UserUtils::isAdmin())
                        echo "<a href=\"?c=Admin\"><i class=\"fas fa-cog\"></i></a>"
                ?>
                <a href="https://www.facebook.com/groups/1700851880151381"><i class="fab fa-facebook"></i></i></a>
                <a href="https://www.facebook.com/messages/t/2207624789268700"><i class="fab fa-facebook-messenger"></i></a>
                <a href="?c=Pan"><i class="fas fa-dumbbell"></i></a>
            </div>
            <a href="?c=User"><i class="fas fa-user"></i></a>
        </header>

        <div id="content" class="center">
