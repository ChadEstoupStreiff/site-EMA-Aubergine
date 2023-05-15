<h2>Paramètres du site</h2>
<hr />
<form action="./?c=Admin&f=params" method="post" class="center" enctype="multipart/form-data">
    <div class="inline">
        <div>
            <label><h3>Capitaine 1</h3></label>
            <input type="text" name="CAPI1" value="<? echo Params::getParam("CAPI1") ?>" required>
        </div>
        <div>
            <label><h3>Capitaine 2</h3></label>
            <input type="text" name="CAPI2" value="<? echo Params::getParam("CAPI2") ?>" required>
        </div>
    </div>
    <div class="inline">
        <div>
            <input type="file" name="img_CAPI1" accept="image/*">
        </div>
        <div>
            <input type="file" name="img_CAPI2" accept="image/*">
        </div>
    </div>
    <div class="inline responsive">
        <div>
            <label><h3>Facebook URL</h3></label>
            <input type="text" name="URL_FACEBOOK" value="<? echo Params::getParam("URL_FACEBOOK") ?>" required>
        </div>
        <div>
            <label><h3>Messenger URL</h3></label>
            <input type="text" name="URL_MESSENGER" value="<? echo Params::getParam("URL_MESSENGER") ?>" required>
        </div>
        <div>
            <label><h3>Instagram URL</h3></label>
            <input type="text" name="URL_INSTA" value="<? echo Params::getParam("URL_INSTA") ?>" required>
        </div>
    </div>
    <label><h3>Message de bienvenue</h3></label>
    <textarea name="WELCOME_TEXT" required><? echo Params::getParam("WELCOME_TEXT") ?></textarea>

    <input type="submit" class="button" value="Enregistrer">
</form>
