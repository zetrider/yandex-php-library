<?php
$settings = require_once '../settings.php';
session_start();
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Yandex OAuth Callback</title>
    <script type="text/javascript" src="doc-cookies.js"></script>
</head>
<body>
<a href="index.php">Back to auth options</a>

<script>

    // handle access token, set it to cookies and close the window
    var result = /access_token=([0-9a-f]+)/.exec(document.location.hash);

    if (result != null) {
        var accessToken = result[1];

        docCookies.setItem("yaAccessToken", accessToken, '', '/');

        if (null !== opener) {
            opener.yaAuthCallback(accessToken);
            window.close();
        } else {
            document.write("JS: Access token is " + accessToken + ". Refreshing page in 5 seconds...<br />");
            setInterval(function() {
                window.location.href = window.location.search;
            }, 5000);
        }
    }

</script>

<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use Yandex\OAuth\OAuthClient;

$client = new OAuthClient('4e2ae5695212401d9602a393f78c7d6e', '1d87231b803648c59ccc6c373a94d582');

if (isset($_COOKIE['yaAccessToken'])) {

    $client->setAccessToken($_COOKIE['yaAccessToken']);
    echo "PHP: Access token from cookies is " . $client->getAccessToken();
}

/**
 * There are two ways to get an access token from Yandex OAuth API.
 * First one is to get in browser after # symbol. It's handled above with JS and PHP.
 * Second one is to use an intermediate code. It's handled below with PHP.
 *
 * This file implements both cases because the only one callback url can be set for an application.
 *
 */

if (isset($_REQUEST['code'])) {

    try {
        $client->requestAccessToken($_REQUEST['code']);
    } catch (\Yandex\OAuth\AuthRequestException $ex) {
        echo $ex->getMessage();
    }

    if ($client->getAccessToken()) {
        echo "PHP: Access token from server is " . $client->getAccessToken();
        setcookie('yaAccessToken', $client->getAccessToken(), 0, '/');
    }

} elseif (isset($_REQUEST['error'])) {

    echo "PHP: Server redirected with error '" . $_REQUEST['error'] . "' and message '" . $_REQUEST['error_description'] . "'<br />";

}

if ($client->getAccessToken() && isset($_SESSION['back'])) {

    header('Location: ' . $_SESSION['back']);
    $_SESSION['back'] = null;
}

?>
</body>
</html>

