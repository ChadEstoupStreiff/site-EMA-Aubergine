<h2 class="lettopclear">Ouvrir un bloc</h2>
<hr/>
<form method="post" action="./?c=Pan&f=create" class="center" enctype="multipart/form-data">
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
                        echo "<option value='" . $diff . "'>" . $diff . "</option>";
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
                        echo "<option valie='" . $type . "'>" . $type . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="center">
            <h3>Zones</h3>
            <select multiple name="zones[]">
                <?
                    foreach (ModelBloc::getListZones() as $zone) {
                        echo "<option valie='" . $zone . "'>" . $zone . "</option>";
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
            <input type="file" name="images[]" accept=".png, .jpeg, .jpg, .gif" multiple required>
        </div>
    </div>
    
    <hr/>
    <h3>Description</h3>
    <textarea name="desc" placeholder="Ecrire la description du bloc"></textarea>

    <button type="submit" class="submit-btn">Créer</button>
</form>
