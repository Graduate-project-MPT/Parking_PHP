<?php {

    $begin_date = "";
    $end_date = "";
    if (isset($_GET["begin_date"]) && isset($_GET["end_date"])) {
        $begin_date = $_GET["begin_date"];
        $end_date = $_GET["end_date"];
    }
    $begin_date_tic = strtotime($begin_date);
    $end_date_tic = strtotime($end_date); {
        if (!$begin_date_tic || !$end_date_tic) {
            // header("Location: MessagesList.php?begin_date=" . ($begin_date_tic ? date("Y-m-d", 1) : $begin_date) .
            //     "&end_date=" . ($end_date_tic ? $end_date : date("Y-m-d")) .
            //     "&page=0");
            // exit;
        }
    }

    $page = 0; {
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            if ($page < 0) {
                header("Location: MessagesList.php?begin_date=" . $begin_date . "&end_date=" . $end_date . "&page=0");
                exit;
            }
        } else {
            header("Location: Main.php?Exception=2");
            exit;
        }
    }

    require_once("DefinesCatalog.php");
    require_once(AUTOLOAD);

    $title = "Сообщения";
    require_once(HEADER);
    require_once("DBConnector.php");

    $page_size = 10;

    $db = new DBConnector();

    $message_mapper = new MessageMapper($db->SelectAll(TMESSAGE));

    $messageArray = $message_mapper->GetSearchByDates($begin_date_tic, $end_date_tic);

    $count_page = ceil($messageArray->GetSize() / $page_size);

    if ($page > $count_page) {
        header("Location: MessagesList.php?begin_date=" . $begin_date . "&end_date=" . $end_date . "&page=" . ($count_page - 1));
        exit;
    }

    $user_mapper = new UserMapper($db->SelectAll(TUSER));
    $document_mapper = new DocumentMapper($db->SelectAll(TDOCUMENT));

    includeWithVariables(
        "features/widgets/href_return.php",
        array("data" => "Вернуться", "url" => "Main.php")
    );
}
?>

<div class="container">
    <div class="my-3">
        <h1 class="text-center">Список Сообщений</h1>
        <form method="get" class="text-center my-3">
            <div class="input-group">
                <?php {
                    includeWithVariables(
                        "features/widgets/href_button.php",
                        array("data" => "🗑", "url" => "MessagesList.php?begin_date=" . date("Y-m-d", 1) . "&end_date=" . date("Y-m-d") . "&page=0")
                    );
                }
                ?>
                <input type="date" class="form-control" name="begin_date"
                    placeholder="Введите начальный диапозон времени" value="<?= $begin_date; ?>" />
                <input type="date" class="form-control" name="end_date" placeholder="Введите конечный диапозон времени"
                    value="<?= $end_date; ?>" />
                <input type="hidden" name="page" value="<?= $page ?>" />
                <button class="btn btn-primary" type="submit">Поиск</button>
            </div>
        </form>
    </div>

    <?php {
        includeWithVariables(
            "features/widgets/paginator.php",
            array("page" => $page, "url" => "MessagesList.php?begin_date=" . $begin_date . "&end_date=" . $end_date . "&", "count_page" => $count_page)
        );
    }
    ?>

    <ul class="list-group pb-3 tree" id="tree">
        <?php foreach (array_slice($messageArray->GetAsArray(), $page * $page_size, $page_size) as $mess): ?>
            <?php
            includeWithVariables(
                "features/data/hard_data.php",
                array("mess" => $mess, "classes" => " list-group-item border")
            );
            ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php
    require_once(FOOTER);
?>