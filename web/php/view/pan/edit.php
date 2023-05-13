<h2 class="lettopclear">Modifier <? echo htmlentities($var->getName()) ?></h2>
<hr/>
<form method="post" action="./?c=Pan&f=edit&name=<? echo htmlentities($var->getName()) ?>" class="center" enctype="multipart/form-data">
    <div class="inline center responsive">
        <div class="center">
            <h3>Nom du bloc</h3>
            <input type="text" placeholder="Entrez le nom du bloc" name="name" value="<? echo htmlentities($var->getName()) ?>" required>
        </div>
        <div class="center">
            <h3>Difficulté</h3>
            <select name="dif" required>
                <?
                    foreach (ModelBloc::getListDifficulties() as $diff) {
                        $selected = "";
                        if ($diff == $var->getDifficulty())
                            $selected = " selected ";
                        echo "<option value='" . htmlentities($diff) . "'" . $selected . ">" . htmlentities($diff) . "</option>";
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
                        $selected = "";
                        if (in_array($type, $var->getTypes()))
                            $selected = " selected ";
                        echo "<option value='" . htmlentities($type) . "'" . $selected . ">" . htmlentities($type) . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="center">
            <h3>Zones</h3>
            <select multiple name="zones[]">
                <?
                    foreach (ModelBloc::getListZones() as $zone) {
                        $selected = "";
                        if (in_array($zone, $var->getZones()))
                            $selected = " selected ";
                        echo "<option value='" . htmlentities($zone) . "'" . $selected . ">" . htmlentities($zone) . "</option>";
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
            <h3>Ecraser les images</h3>
            <input type="file" name="images[]" accept=".png, .jpeg, .jpg, .gif" multiple>
        </div>
    </div>
    
    <hr/>
    <h3>Description</h3>
    <textarea name="desc" placeholder="Ecrire la description du bloc" required><? echo htmlentities($var->getDescription()) ?></textarea>

    <button type="submit" class="submit-btn">Mettre à jour</button>
</form>
