<h2>Changer mes informations</h2>
<hr/>
<form action="./?c=User&f=informations" method="post" class="center">
        <div class="inline responsive">
                <div>
                        <label><h3>Pseudo</h3></label>
                        <input type="text" name="nickname" value="<?echo $var->getNickName()?>" required>
                </div>
                <div>
                        <label><h3>Classe</h3></label>
                        <select name="class" required>
                                <?
                                        require_once('model/ModelUser.php');
                                        foreach (ModelUser::getListClass() as $class) {
                                                echo "<option value='" . $class . "'>" . $class . "</option>";
                                        }
                                ?>
                        </select>
                </div>
        </div>
        
        <div class="inline responsive">
                <div>
                        <label><h3>Niveau difficulté</h3></label>
                        <input type="text" name="nivdif" value="<?echo $var->getNivDif()?>" required>
                </div>
                <div>
                        <label><h3>Niveau bloc</h3></label>
                        <input type="text" name="nivbloc" value="<?echo $var->getNivBloc()?>" required>
                </div>
        </div>

        <div class="inline responsive">
                <div>
                        <label><h3>E-Mail</h3></label>
                        <input type="mail" name="email" value="<?echo $var->getEmail()?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                </div>
                <div>
                        <label><h3>Téléphone</h3></label>
                        <input type="tel" name="phone" value="<?echo $var->getPhone()?>" pattern="[0-9]{10}" required>
                </div>
        </div>
        <div class="inline center">
                <label class="toggler-wrapper style-8">
                        <input type="checkbox" name="show" <? if ($var->isShowing()) echo "checked"?> required>
                        <div class="toggler-slider">
                                <div class="toggler-knob"></div>
                        </div>
                </label>
                <label><h3>Montrer mes informations de contact</h3></label>
        </div>

        <hr/>
        <label><h3>Description</h3></label>
        <textarea name="desc" required><?echo $var->getDescription()?></textarea>


        <input type="submit" class="button" value="Mettre à jour">
</form>