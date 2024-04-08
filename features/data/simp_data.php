<?php {
    global $user_mapper;
    global $message_mapper;
    global $document_mapper;

    $user;
    $id = $mess->GetSenderID();
    if ($id == null) {
        $user = new User(0, "BOT");
    }
    else{
        $user = $user_mapper->GetByID($mess->GetSenderID());
    }
    $messageArray = $message_mapper->GetSearchedByID($mess->GetID());
    $documentArray = $document_mapper->GetSearchedByID($mess->GetID())->GetAsArray();
}
?>
<li>
    <?php
    includeWithVariables("features/data/mess_data.php", array("is_hard" => false, "user" => $user, "mess" => $mess, "documentArray" => $documentArray));
    ?>
    <?php if ($messageArray->GetSize() != 0)
        includeWithVariables("features/widgets/simp_list.php", array("messages" => $messageArray)); ?>
</li>