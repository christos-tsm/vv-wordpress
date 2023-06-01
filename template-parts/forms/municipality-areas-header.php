<select name="municipality" id="municipality">
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'volos' ? 'selected' : '' ?> value="volos">Βόλος</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'nea-anchialos' ? 'selected' : '' ?> value="nea-anchialos">Νέα Αγχίαλος</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'agria' ? 'selected' : '' ?> value="agria">Αγριά</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'anakasia' ? 'selected' : '' ?> value="anakasia">Ανακασιά</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'artemida' ? 'selected' : '' ?> value="artemida">Αρτεμίδα</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'kato-lechonia' ? 'selected' : '' ?> value="kato-lechonia">Κάτω Λεχώνια</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'ano-lechonia' ? 'selected' : '' ?> value="ano-lechonia">Άνω Λεχώνια</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'makrinitsa' ? 'selected' : '' ?> value="makrinitsa">Μακρινίτσα</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'portaria' ? 'selected' : '' ?> value="portaria">Πορταριά</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'nea-ionia' ? 'selected' : '' ?> value="nea-ionia">Νέα Ιωνία</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'almiros' ? 'selected' : '' ?> value="almiros">Αλμυρός</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'kala-nera' ? 'selected' : '' ?> value="kala-nera">Καλά Νερά</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'afissos' ? 'selected' : '' ?> value="afissos">Αφυσσος</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'milies' ? 'selected' : '' ?> value="milies">Μηλιές</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'tsagarada' ? 'selected' : '' ?> value="tsagarada">Τσαγκαράδα</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'zagora' ? 'selected' : '' ?> value="zagora">Ζαγορά</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'alykes' ? 'selected' : '' ?> value="alykes">Αλυκές</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'platanidia' ? 'selected' : '' ?> value="platanidia">Πλατανίδια</option>
    <option <?= isset($_GET['municipality']) && $_GET['municipality']  === 'koropi' ? 'selected' : '' ?> value="koropi">Κορόπη</option>
</select>