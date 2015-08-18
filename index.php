<?php
/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * this index php :D
 */

// include library applet for run app
include 'core/lib/Applet.php';
try {
    // set base puth for applet
    Core_Lib_Applet::setBaseDir('/var/www/test.local/htdocs');
    // run
    Core_Lib_Applet::run();
} catch (Exception $error) {
    // output error message
    echo $error->getMessage();
}
