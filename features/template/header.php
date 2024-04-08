<?php {
    // require params:
    // $title - title of page
    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        // Extract the variables to a local namespace
        extract($variables);

        // Start output buffering
        ob_start();

        // Include the template file
        include $filePath;

        // End buffering and return its contents
        $output = ob_get_clean();
        if (!$print) {
            return $output;
        }
        echo $output;
    }
}
?>
<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="links/bootstrap/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="links/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="links/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="links/css/textStyle.css">
    <link rel="stylesheet" href="links/css/lightbox.css">
    <link rel="stylesheet" href="links/css/buttons.css">
    <link rel="stylesheet" href="links/css/hrefs.css">
    <link rel="stylesheet" href="links/css/tree.css">
    <link rel="stylesheet" href="links/css/img.css">

    <title>
        <?php echo $title ?>
    </title>
</head>
<html>

<body>