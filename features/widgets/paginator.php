<?php
// require params:
// $page - instance page index (0 - ...)
// $url - template url (string that havent page param)
// $count_page - max index of page

$begin_index = ($page - 4 >= 0 ? $page - 4 : 0);
$end_index = ($count_page - $begin_index < 10 ? $count_page : $begin_index + 10);
if ($begin_index != 0 && $end_index - $begin_index < 10) {
    $buff = 10 - ($end_index - $begin_index);
    $begin_index = ($buff >= $begin_index ? 0 : $begin_index - $buff);
}
?>

<div class="text-center my-3">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page != 0) {
                includeWithVariables(
                    "features/widgets/paginator_button.php",
                    array(
                        "i" => 0,
                        "page" => $page,
                        "url" => $url,
                        "button_content" => "&laquo;&laquo;"
                    )
                );
                includeWithVariables(
                    "features/widgets/paginator_button.php",
                    array(
                        "i" => $page - 1,
                        "page" => $page,
                        "url" => $url,
                        "button_content" => "&lt;"
                    )
                );
            }
            ?>

            <?php for ($i = $begin_index; $i < $end_index; ++$i) {
                includeWithVariables(
                    "features/widgets/paginator_button.php",
                    array(
                        "i" => $i,
                        "page" => $page,
                        "url" => $url,
                        "button_content" => $i + 1
                    )
                );
            }
            ?>

            <?php if ($end_index != 0 && $page != $end_index - 1) {
                includeWithVariables(
                    "features/widgets/paginator_button.php",
                    array(
                        "i" => $i + 1,
                        "page" => $page,
                        "url" => $url,
                        "button_content" => "&gt;"
                    )
                );
            }
            ?>
        </ul>
    </nav>
</div>