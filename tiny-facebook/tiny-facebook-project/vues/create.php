<form action="index.php?action=creation" method="POST">
    <div class="form-group">
        <fieldset>
            <legend>Information d'inscription:</legend>

            <label for="uname">Nom d'utilisateur:</label>
            <input type="text" name="login" placeholder="Nom d'utilisateur" class="form-control" value="<?php if(!empty($_SESSION['Prev_login'])){
        echo $_SESSION['Prev_login'];} ?>" />

            <label for="uname">Mdp:</label>
            <input type="password" name="mdp" placeholder="Mot de passe" class="form-control" value="<?php if(!empty($_SESSION['Prev_mdp'])){
        echo $_SESSION['Prev_mdp'];
    } ?>" />
            <label for="uname">Mdp:</label>
            <input type="password" name="mdp2" placeholder="Retapez le mdp" class="form-control" value="<?php if(!empty($_SESSION['Prev_mdp'])){
        echo $_SESSION['Prev_mdp'];
    } ?>" />

            <input type="submit" class="btn btn-default" />
        </fieldset>
    </div>

</form>
