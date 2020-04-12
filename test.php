<form method="POST">
    <button type="input" style="text-align: center" name="voila" value="click sur moi"></button>
    <button type="input" style="text-align: center" name="toto" value="click"></button>
</form>
<?php

if(isset($_POST['voila']) && $_POST['voila']=="click sur moi"){
echo "voila marche";
}

else if(isset($_POST['voila']) && $_POST['voila']=="click sur moi" && isset($_POST['toto']) && $_POST['toto']=="click"){
echo "toto marche";
}









?>