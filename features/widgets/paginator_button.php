<?php
// require params:
// $i - display page
// $page - instance page
// $url - full url
// $button_content - max index of page
?>


<li class="page-item <?= ($i == $page ? "active" : "") ?>">
    <a class="page-link" <?= ($i != $page ? "href=\"" . $url . "page=" . $i . "\"" : "") ?> aria-label="First">
        <span aria-hidden="true">
            <?= $button_content ?>
        </span>
    </a>
</li>