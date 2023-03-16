<h2 class="lettopclear">Ouvrir un bloc</h2>
<hr/>
<form method="post" action="./?c=Pan&f=create" class="center" enctype="multipart/form-data">
    <div class="inline center responsive">
        <input type="text" placeholder="Entrez le nom du bloc" name="name" required>
        <select name="dif" required>
            <option value="">Difficulté</option>
            <?
                foreach (ModelBloc::getListDifficulties() as $diff) {
                    echo "<option value='" . $diff . "'>" . $diff . "</option>";
                }
            ?>
        </select>
        <div class="inline center">
            <select multiple name="types[]">
                <?
                    foreach (ModelBloc::getListTypes() as $types) {
                        echo "<option valie='" . $types . "'>" . $types . "</option>";
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
            <h3>Images</h3>
            <input type="file" name="images[]" accept=".png, .jpeg, .jpg, .gif" multiple required>
        </div>
        <div class="center">
            <h3>Video</h3>
            <input type="file" name="video" accept=".mp4, .avi, .mkv">
        </div>
    </div>
    

    <textarea name="desc" placeholder="Ecrire la description du bloc"></textarea>

    <button type="submit" class="submit-btn">Créer</button>
</form>
