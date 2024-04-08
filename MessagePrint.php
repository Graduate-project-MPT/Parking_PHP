<?php {
    require_once("DBConnector.php");
    require_once("DefinesCatalog.php");
    require_once(AUTOLOAD);

    $db = new DBConnector();

    $user_mapper = new UserMapper($db->SelectAll(TUSER));
    $message_mapper = new MessageMapper($db->SelectAll(TMESSAGE));
    $document_mapper = new DocumentMapper($db->SelectAll(TDOCUMENT));

    $messageArray;
    if (isset($_GET["id"])) {
        $messageArray = $message_mapper->GetByID($_GET["id"]);
    } else if (isset($_GET["user_id"])) {
        $messageArray = $message_mapper->GetSearchByUserID($_GET["user_id"]);
    } else {
        header("Location: Main.php?Exception=3");
        exit;
    }

    $title = "Печать";
    require_once(HEADER);
}
?>

<div class="py-3 pe-3">
    <?php
    includeWithVariables(
        "features/widgets/simp_list.php",
        array("messages" => $messageArray)
    );
    require_once(FOOTER);
    ?>
</div>