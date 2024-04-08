<?php
// require params:
// $data - text
// $url - full url
?>

<div class="fixed-top mt-2 ms-2 text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <?php {
                includeWithVariables(
                    "features/widgets/href_button.php",
                    array("data" => "Вернуться", "url" => "Main.php")
                );
            }
            ?>
        </div>
    </div>
</div>