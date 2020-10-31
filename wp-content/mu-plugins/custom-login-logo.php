<?php
add_action('login_header', function(){
	echo '<div id="mask"></div>
<style>
body{
	overflow: hidden;
}
.login h1 a{
    background-image: url(http://mysmartstaff.co.za/wp-content/uploads/2018/12/smartstaff_logo_header3.png);
    margin-bottom: 0;
    background-size: contain;
    background-position: center;
    width: 220px;
    height: 60px;
}
.wp-core-ui .button-primary:hover {
    background-color: #f77b00;;
    border-color: #f77b00;;
}

.wp-core-ui .button-primary {
    background-color: #f77b00;
    border-color: #f77b00;
}

.login #nav a, .login #backtoblog a {
    color: white;
}

.dashicons, .login #nav a:hover, .login #backtoblog a:hover, .login h1 a:hover {
    color: #f77b00;
}

div#mask {
    background: url(http://mysmartstaff.co.za/wp-content/uploads/2018/12/Optimized-Screen-Shot-2018-11-16-at-23.45.50.jpg);
    background-size: cover;
    background-attachment: fixed;
    overflow: hidden;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    -webkit-filter: blur(4px) grayscale(70%);
}
</style>';
});
