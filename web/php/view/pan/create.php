<script src='assets/js/form_bloc.js'></script>
<link rel="stylesheet" href="assets/css/bloc_create.css" type="text/css">

<h2 class="lettopclear">Ouvrir un bloc</h2>
<hr/>
<form id="bloc_form" method="post" action="./?c=Pan&f=create" class="center" enctype="multipart/form-data">
    <div class="inline center responsive">
        <div class="center">
            <h3>Nom du bloc</h3>
            <input type="text" placeholder="Entrez le nom du bloc" name="name" required>
        </div>
        <div class="center">
            <h3>Difficulté</h3>
            <select name="dif" required>
                <?
                    foreach (ModelBloc::getListDifficulties() as $diff) {
                        echo "<option value='" . htmlentities($diff) . "'>" . htmlentities($diff) . "</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="inline center responsive">
        <div class="center">
            <h3>Types</h3>
            <select multiple name="types[]">
                <?
                    foreach (ModelBloc::getListTypes() as $type) {
                        echo "<option value='" . htmlentities($type) . "'>" . htmlentities($type) . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="center">
            <h3>Zones</h3>
            <select multiple name="zones[]">
                <?
                    foreach (ModelBloc::getListZones() as $zone) {
                        echo "<option value='" . htmlentities($zone) . "'>" . htmlentities($zone) . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="center">
            <p>CTRL + Clic</p><p>pour</p><p>selectionner</p><p> plusieurs</p>
        </div>
    </div>


    <div class="center">
        <div class="center">
            <h3>Images</h3>
            <input id="bloc_images" type="file" name="images[]" accept="image/*" multiple required>
            <div id="bloc_images_canva" class="center"></div>
        </div>
    </div>
    
    <hr/>
    <h3>Description</h3>
    <textarea name="desc" placeholder="Ecrire la description du bloc"></textarea>

    <button type="submit" class="submit-btn">Créer</button>
</form>
