<?php {

    require_once("DefinesCatalog.php");

    $title = "Главное меню";
    require_once(HEADER);

    $exception_list = array(1 => "SQLConnection Exception", 2 => "Search Exception", "Invalid ID Exception");
}
?>

<div class="container">
    <h1 class="text-center my-3">Главная страница</h1>
    <div class="row justify-content-center">
        <a href="UsersList.php?userLogin=&page=0"
            class="col m-1 btn btn-primary btn-lg btn-block text-nowrap">Список пользователей</a>
        <a href="MessagesList.php?begin_date=<?= date("Y-m-d", 1) ?>&end_date=<?= date("Y-m-d") ?>&page=0"
            class="col m-1 btn btn-primary btn-lg btn-block text-nowrap">Список сообщений</a>
    </div>

    <?php if (isset($_GET["Exception"])): ?>
        <div class="fixed-bottom mb-2 ms-2 toast show align-items-center text-white bg-danger border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $exception_list[$_GET["Exception"]]; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    <?php endif ?>
</div>

<?php
require_once(FOOTER);
?>