<?php
add_action('login_header', function(){
	echo '<div id="mask"></div>
<style>
body{
	overflow: hidden;
}
.login h1 a{
    background-image: url(http://mysmartstaff.co.za/wp-content/uploads/2018/12/smartstaff_logo_header3.png);
    background-size: contain;
    background-position: center;
    width: 220px;
    height: 60px;
}
.wp-core-ui .button-primary:hover {
    background-color: #de6e00;;
    border-color: #de6e00;;
}

.wp-core-ui .button-primary {
    background-color: #f77b00;
    border-color: #f77b00;
}

.login #nav a {
    color: white;
    text-align: center;
    display: block;
}

.dashicons, .login #nav a:hover, .login #backtoblog a:hover, .login h1 a:hover {
    color: #f77b00;
}

.login .message, .login .success, .login #login_error{
	border-left-color: #f77b00;
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
    -webkit-filter: grayscale(80%);
    filter: grayscale(80%);
}

input[type="text"]:focus, input[type="password"]:focus, input[type="color"]:focus, input[type="date"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="email"]:focus, input[type="month"]:focus, input[type="number"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="time"]:focus, input[type="url"]:focus, input[type="week"]:focus, input[type="checkbox"]:focus, input[type="radio"]:focus, select:focus, textarea:focus {
    border-color: #f67b00;
    box-shadow: 0 0 0 1px #f67b00;
}
#backtoblog{
	display: none;
}
</style>';
});
