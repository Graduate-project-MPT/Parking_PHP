<?php
// require params:
// $messages - Mapped messages data
// $classes - classes for messages
?>
<ul class="tree" id="tree" hidden>
    <?php foreach ($messages->GetAsArray() as $mess): ?>
        <?php includeWithVariables("features/data/hard_data.php", array("mess" => $mess, "classes" => $classes)); ?>
    <?php endforeach ?>
</ul>