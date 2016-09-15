hello world!
<br/>
<?php
// load cloudfoundry database credentials
$vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
if ($vcap_services->{'p-mysql'}) { //if "mysql" db service is bound to this application
    $db = $vcap_services->{'p-mysql'}[0]->credentials;
} else if ($vcap_services->{'cleardb'}) { //if cleardb mysql db service is bound to this application
    $db = $vcap_services->{'cleardb'}[0]->credentials;
} else {
    echo "Error: No suitable MySQL database bound to the application. <br>";
    die();
}
$mysql_database = $db->name;
$mysql_port = $db->port;
$mysql_server_name = $db->hostname . ':' . $db->port;
$mysql_username = $db->username;
$mysql_password = $db->password;
echo "Connecting to MySQL... \n";
$mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
} else {
    echo "Connected to MySQL!";
}
?>

<pre>
<?php
print_r($_ENV);
?>
</pre>
