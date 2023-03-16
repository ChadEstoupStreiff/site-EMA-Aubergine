<h2 class="lettopclear">Modifier le bloc <? echo $var->getName() ?></h2>
<hr/>
<form method="post" action="./?c=Pan&f=create" class="center" enctype="multipart/form-data">
    <div class="inline center responsive">
        <input type="text" placeholder="Entrez le nom du bloc" name="name" value="<? echo $var->getName() ?>" required>
        <select name="dif" required>
            <option value="">Difficulté</option>
            <?
                foreach (ModelBloc::getListDifficulties() as $diff) {
                    $selected = "";
                    if ($diff == $var->getDifficulty())
                        $selected = " selected ";
                    echo "<option value='" . $diff . "'" . $selected . ">" . $diff . "</option>";
                }
            ?>
        </select>
        <div class="inline center">
            <select multiple name="types[]">
                <?
                    foreach (ModelBloc::getListTypes() as $types) {
                        $selected = "";
                        if (in_array($types, $var->getTypes()))
                            $selected = " selected ";
                        echo "<option valie='" . $types . "'" . $selected . ">" . $types . "</option>";
                    }
                ?>
            </select>
            <div class="center">
                <p>CTRL + Clic</p><p>pour</p><p>selectionner</p><p> plusieurs</p>
            </div>
        </div>
    </div>


    <div class="center">
        <div class="center">
            <h3>Ecraser les images</h3>
            <input type="file" name="images[]" accept=".png, .jpeg, .jpg, .gif" multiple>
        </div>
        <div class="center">
            <h3>Ecraser la video</h3>
            <input type="file" name="video" accept=".mp4, .avi, .mkv">
        </div>
    </div>
    

    <textarea name="desc" placeholder="Ecrire la description du bloc"><? echo $var->getDescription() ?></textarea>

    <button type="submit" class="submit-btn">Créer</button>
</form>
