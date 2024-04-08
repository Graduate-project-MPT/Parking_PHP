<?php
//require: $is_hard $user, $mess, $documentArray
?>

<div class="border tree_target">
    <div class="data<?= ($is_hard? " select-data" : "") ?> tree_target">
        <div class="data-row data-row-wrap tree_target">
            <?= "Пользователь: " . $user->GetLogin() . " Дата: " . $mess->GetDate() ?>
            <?php if ($is_hard)
                includeWithVariables("features/widgets/print_button.php", array("url" => "id=" . $mess->GetID())); 
            ?>
        </div>
        <div class="data-padding tree_target">
            <?= "\"" . $mess->GetText() . "\"" ?>
        </div>
    </div>

    <div class="data-padding tree_target">
        <?php if (count($documentArray) != 0): ?>
            <div class="data-row data-row-wrap" id="files">
                <?php foreach ($documentArray as $image): ?>
                    <?php if ($image->IsPhoto()): ?>
                        <a href="<?= $image->GetUrl() ?>" data-lightbox="lbox">
                            <img src="<?= $image->GetUrl() ?>" alt="<?= $image->GetName() ?>" class="small">
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
                <?php foreach ($documentArray as $file): ?>
                    <?php if (!$file->IsPhoto()): ?>
                        <a href="<?= $file->GetUrl() ?>" download>
                            <img src="features/image/black_file.png" alt="<?= $file->GetName() ?>" class="small">
                            <div>
                                <?= $file->GetName() ?>
                            </div>
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</div>