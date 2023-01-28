<h2 class="lettopclear">Ouvrir un bloc</h2>
<hr/>
<form method="post" action="./?c=Pan&f=create" class="center" enctype="multipart/form-data">
    <div class="inline center responsive">
        <input type="text" placeholder="Entrez le nom du bloc" name="name" required>
        <select name="dif" required>
            <option value="">Difficulté</option>
            <option value="4&-">4 et -</option>
            <option value="5">5</option>
            <option value="6a">6a</option>
            <option value="6a+">6a+</option>
            <option value="6b">6b</option>
            <option value="6b+">6b+</option>
            <option value="6c">6c</option>
            <option value="6c+">6c+</option>
            <option value="7a">7a</option>
            <option value="7a+">7a+</option>
            <option value="7b">7b</option>
            <option value="7b+">7b+</option>
            <option value="7c">7c</option>
            <option value="7c+">7c+</option>
            <option value="8&+">8 et +</option>
        </select>
        <div class="inline center">
            <select multiple name="types[]">
                <option valie="Force">Force</option>
                <option valie="Technique">Technique</option>
                <option value="Reglettes">Reglettes</option>
                <option value="Morphologie">Morphologie</option>
                <option valie="Jetté">Jetté</option>
                <option valie="Dalle">Dalle</option>
                <option valie="Devert">Devert</option>
                <option valie="Surplomb">Surplomb</option>
                <option valie="Prou">Prou</option>
                <option valie="Japoneserie">Japoneserie</option>
                <option valie="Grégoire (mutant)">Grégoire (mutant)</option>
                <option valie="Dièdre">Dièdre</option>
                <option valie="Run & Jump & Skate">Run & Jump & Skate</option>
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
