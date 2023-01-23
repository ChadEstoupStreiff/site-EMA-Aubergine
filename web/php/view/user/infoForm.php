<h1>Changer mes informations</h1>
<hr/>
<form action="./?c=User&f=informations" method="post" class="center">
        <label><h2>Nouveau pseudo</h2></label>
        <input type="text" name="nickname" value="<?echo $var->getNickName()?>">
        <input type="submit" class="button" value="Mettre à jour">
</form>