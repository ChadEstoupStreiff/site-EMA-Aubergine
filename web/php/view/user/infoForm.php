<h2>Changer mes informations</h2>
<hr/>
<form action="./?c=User&f=informations" method="post" class="center">
        <label><h3>Nouveau pseudo</h3></label>
        <input type="text" name="nickname" value="<?echo $var->getNickName()?>">
        <input type="submit" class="button" value="Mettre à jour">
</form>