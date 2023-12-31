<?php
if (!set_include_path("{$_SERVER['DOCUMENT_ROOT']}"))
    error("500", "set_include_path()");
if (session_status() == PHP_SESSION_NONE) session_start();

require_once ("views/partials/alert.php");
require_once("auth/auth.php");
require_once("utility/error_handling.php");
require_once("utility/utility_func.php");
require_once ("DB/DB.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User detail</title>
    <meta charset="UTF-8">

    <?php include("views/partials/head.php"); ?>

    <link rel="stylesheet" href="/f1_project/assets/css/profile_style.css">
</head>

<?php if(isset($_SESSION["err"]) && $_SESSION["err"] || isset($_SESSION["success"]) && $_SESSION["success"]){ ?>
<style>
    .container-element{
        height: 550px;
        top: 55px;
    }
</style>
<?php } ?>

<body class="bg-dark">

<?php
// error_redirector, link ai css non funzionano, why??
[$login_allowed, $user] = check_cookie();
if (check_user_auth($user)) {
    set_session($user);

    if(check_admin_auth($user)) {
        (isset($_GET["id"]) && $_GET["id"] != null) ? $id = $_GET["id"] : $id = null;
        $element = select_user($id);
        unset($id);
    }
    else{
        $element = select_user(null);
    }

    if($element != null) {
        if (isset($_GET["edit"]) && $_GET["edit"] == 1) {
            include("../partials/user_detail_edit_profile.php");
        } else {
            include("../partials/user_detail_show_profile.php");
        }
    }
    else{
        error("401", "not_authorized", "user_detail.php", "/f1_project/views/public/auth/login.php", "No user found");
    }
}
else{
    error("401", "not_authorized", "/f1_project/views/private/user_detail.php", "/f1_project/views/public/auth/login.php", "Unauthorized access.");
    exit;
}
?>
</body>
</html>


