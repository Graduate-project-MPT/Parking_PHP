<?php {
    $Value = "";
    if (isset($_GET["userLogin"])) {
        $Value = $_GET["userLogin"];
    }

    $page = 0; {
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            if ($page < 0) {
                header("Location: UsersList.php?serLogin=" . $Value . "&page=0");
                exit;
            }
        } else {
            header("Location: Main.php?Exception=2");
            exit;
        }
    }

    require_once("DefinesCatalog.php");
    require_once(AUTOLOAD);

    $title = "Пользователи";
    require_once(HEADER);
    require_once("DBConnector.php");

    $page_size = 10;

    $db = new DBConnector();

    $user_mapper = new UserMapper($db->SelectAll(TUSER));

    $user_mapper_find = $user_mapper->GetSearchedByLogin($Value);

    $count_page = ceil($user_mapper_find->GetSize() / $page_size);

    if ($page > $count_page) {
        header("Location: UsersList.php?serLogin=" . $Value . "&page=" . ($count_page - 1));
        exit;
    }

    $message_mapper = new MessageMapper($db->SelectAll(TMESSAGE));
    $document_mapper = new DocumentMapper($db->SelectAll(TDOCUMENT));
    includeWithVariables(
        "features/widgets/href_return.php",
        array("data" => "Вернуться", "url" => "Main.php")
    );
}
?>

<div class="container">
    <div class="my-3">
        <h1 class="text-center">Список пользователей</h1>
        <form method="get" class="text-center my-3">
            <div class="input-group">
                <?php {
                    includeWithVariables(
                        "features/widgets/href_button.php",
                        array("data" => "🗑", "url" => "UsersList.php?userLogin=&page=0")
                    );
                }
                ?>
                <input type="text" class="form-control" name="userLogin" placeholder="Введите логин пользователя"
                    value="<?= $Value ?>" />
                <button class="btn btn-primary" type="submit">Поиск</button>
            </div>
            <input type="hidden" name="page" value="<?= $page ?>" />
        </form>
    </div>

    <?php
    includeWithVariables(
        "features/widgets/paginator.php",
        array("page" => $page, "url" => "UsersList.php?userLogin=$Value&", "count_page" => $count_page)
    );
    ?>

    <ul class="list-group pb-3" id="tree">
        <?php foreach (array_slice($user_mapper_find->GetAsArray(), $page * $page_size, $page_size) as $user): ?>
            <?php
            $messageArray = $message_mapper->GetSearchByUserID($user->GetID());
            ?>
            <li class="list-group-item border<?= ($messageArray->GetSize() != 0) ? " element border-primary" : "" ?>">
                <div class="d-flex tree">
                    <span class="select-data <?= ($messageArray->GetSize() != 0) ? "hide" : "" ?>">
                        <div class="tree_target data-row">
                            <?= $user->GetLogin() ?>
                            <?php includeWithVariables("features/widgets/print_button.php", array("url" => "user_id=" . $user->GetID())); ?>
                        </div>
                    </span>
                    <?php
                    if ($messageArray->GetSize() != 0)
                        includeWithVariables(
                            "features/widgets/hard_list.php",
                            array("messages" => $messageArray, "classes" => " mt-1 mb-1")
                        );
                    ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
require_once(FOOTER);
?>