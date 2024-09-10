<?php
require_once("./wrk/Wrk.php");
require_once("./bean/Info.php");
require_once("./wrk/Connexion.php");
$wrk = new Wrk();
session_start();
if (isset($_SERVER['REQUEST_METHOD'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == "getpixels") {
                $wrk->getPixels();
            }
        }

    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == "draw") {
                $wrk->drawPixel($_POST['id'], $_POST['color']);
            }
            if ($_POST['action'] == "login") {
                if ($_POST['password'] == "ZHaksf9673gaoOioa7") {
                    $_SESSION['logged'] = true;
                }
            }
            if ($_POST['action'] == "reset") {
                if (isset($_SESSION['logged'])) {
                    $wrk->resetDatabase();
                    echo "Database reset success";
                } else {
                    echo "You're not connected";
                    http_response_code(401);
                }
            }
            if ($_POST['action'] == "stop") {
                session_destroy();
            }
        }

    } else {
        http_response_code(405);
    }
}
$Wrk = null;

?>
