<?php
    define('DB_HOST', $db['Host']);
    define('DB_USER', $db['User']);
    define('DB_PASSW', $db['Passwd']);
    define('DB_DATABASE', $db['DB_name']);
    define('DB_FORMAT', $db['Format']);

    define('TEMPLATE_NAME', $settings['Template']);

    define('FOLDER_APPLICATION', $advanced['Folder_Application']);
    define('SITEKEY_RECAPTCHA', $advanced['SiteKey_ReCaptcha']);
    define('SECRETKEY_RECAPTCHA', $advanced['SecretKey_ReCaptcha']);
?>