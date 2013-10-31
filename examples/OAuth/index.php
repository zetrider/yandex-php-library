<?php
$settings = require_once '../settings.php';
session_start();
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Yandex OAuth Test Page</title>
</head>
<body>
<p><a href="?type=code">Run server authentication via code</a> which uses intermediate code and secret key to get access token.</p>
<p><a href="?type=token">Run server authentication with JS help</a> which do not need a secret key.</p>
<p><a href="?type=invalid">Try to send invalid authentication type parameter</a> to cause Yandex service return an error.</p>
</body>
</html>
<?php
if (isset($_REQUEST['back'])) {
    $_SESSION['back'] = $_REQUEST['back'];
}


use Yandex\OAuth\OAuthClient;

// Client secret is not required in this case
$client = new OAuthClient($settings['global']['clientId']);

if (isset($_REQUEST['type'])) {

    switch ($_REQUEST['type']) {
        case 'code':
            $client->authRedirect();
            break;
        case 'token':
            $client->authRedirect(true, OAuthClient::TOKEN_AUTH_TYPE);
            break;
        case 'invalid':
            $client->authRedirect(true, 'invalid');
            break;
        default:
            // do nothing
            break;
    }
}
