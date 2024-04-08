<?php
// require params:
// $messages - Mapped messages data
?>
<ul>
    <?php foreach ($messages->GetAsArray() as $mess): ?>
        <?php includeWithVariables("features/data/simp_data.php", array("mess" => $mess)); ?>
    <?php endforeach ?>
</ul>