<?php
add_filter('xmlrpc_enabled', '__return_false');

// in /etc/apache2/sites-enabled/000-default.conf
//# Block WordPress xmlrpc.php requests
//<Files xmlrpc.php>
//       order deny,allow
//deny from all
//allow from 123.123.123.123
//</Files>
//sudo service apache2 restart
