<?php isset($_GET['store_id']) && !empty($_GET['store_id']) ? $post_id = $_GET['store_id'] : $post_id = null; ?>
<select name="municipality" id="municipality">
    <option <?= get_field('municipality', $post_id) === 'volos' ? "selected" : "" ?> value="volos">Βόλος</option>
    <option <?= get_field('municipality', $post_id) === 'nea-anchialos' ? "selected" : "" ?> value="nea-anchialos">Νέα Αγχίαλος</option>
    <option <?= get_field('municipality', $post_id) === 'agria' ? "selected" : "" ?> value="agria">Αγριά</option>
    <option <?= get_field('municipality', $post_id) === 'anakasia' ? "selected" : "" ?> value="anakasia">Ανακασιά</option>
    <option <?= get_field('municipality', $post_id) === 'artemida' ? "selected" : "" ?> value="artemida">Αρτεμίδα</option>
    <option <?= get_field('municipality', $post_id) === 'kato-lechonia' ? "selected" : "" ?> value="kato-lechonia">Κάτω Λεχώνια</option>
    <option <?= get_field('municipality', $post_id) === 'ano-lechonia' ? "selected" : "" ?> value="ano-lechonia">Άνω Λεχώνια</option>
    <option <?= get_field('municipality', $post_id) === 'makrinitsa' ? "selected" : "" ?> value="makrinitsa">Μακρινίτσα</option>
    <option <?= get_field('municipality', $post_id) === 'portaria' ? "selected" : "" ?> value="portaria">Πορταριά</option>
    <option <?= get_field('municipality', $post_id) === 'nea-ionia' ? "selected" : "" ?> value="nea-ionia">Νέα Ιωνία</option>
    <option <?= get_field('municipality', $post_id) === 'almiros' ? "selected" : "" ?> value="almiros">Αλμυρός</option>
    <option <?= get_field('municipality', $post_id) === 'kala-nera' ? "selected" : "" ?> value="kala-nera">Καλά Νερά</option>
    <option <?= get_field('municipality', $post_id) === 'afissos' ? "selected" : "" ?> value="afissos">Αφυσσος</option>
    <option <?= get_field('municipality', $post_id) === 'milies' ? "selected" : "" ?> value="milies">Μηλιές</option>
    <option <?= get_field('municipality', $post_id) === 'tsagarada' ? "selected" : "" ?> value="tsagarada">Τσαγκαράδα</option>
    <option <?= get_field('municipality', $post_id) === 'zagora' ? "selected" : "" ?> value="zagora">Ζαγορά</option>
    <option <?= get_field('municipality', $post_id) === 'choropi' ? "selected" : "" ?> value="choropi">Χορόπη</option>
    <option <?= get_field('municipality', $post_id) === 'alykes' ? "selected" : "" ?> value="alykes">Αλυκές</option>
    <option <?= get_field('municipality', $post_id) === 'platanidia' ? "selected" : "" ?> value="platanidia">Πλατανίδια</option>
    <option <?= get_field('municipality', $post_id) === 'koropi' ? "selected" : "" ?> value="koropi">Κορόπη</option>
</select>