<?php
function init_smtp() {
	ini_set("SMTP", getenv('SMPT_HOST'));
	ini_set("smtp_port", getenv('SMTP_PORT'));
	ini_set("sendmail_from", getenv('SMTP_USER'));
}
function patch_ingress($snippet){
	$bearer = file_get_contents("/var/run/secrets/kubernetes.io/serviceaccount/token");
	$namespace = file_get_contents("/var/run/secrets/kubernetes.io/serviceaccount/namespace");
	$ingress_name = getenv('INGRESS_NAME');
	$auth_header = "Authorization: Bearer $bearer";
	$url = "https://kubernetes/apis/extensions/v1beta1/namespaces/$namespace/ingresses/$ingress_name?fieldManager=kubectl-annotate";
	$escaped_snippet = json_encode($snippet);
	$data = "{\"metadata\":{\"annotations\":{\"nginx.ingress.kubernetes.io/server-snippet\":$escaped_snippet}}}";
	echo($data);
	$headers = array('Content-Type: application/merge-patch+json', $auth_header);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec($curl);
	curl_close($curl);
}
function block_ip($ips){
	$deny_list = "";
	foreach($ips as $ip) {
		$deny_list .= "  deny  $ip;\n";
	}

	$snippet = <<<EOD
location / {
  allow  all;
$deny_list
}
EOD;

	patch_ingress($snippet);
}

function get_blocked_ips($conn) {

	$result = pg_query($conn, 'SELECT ipaddr FROM blocked;');

	if (!$result) {
	   echo('ERROR: DB connection failed.');
	   header('HTTP/1.1 500 Internal Server Error');
	   exit(0);
	}

	$ips = array();
	while ($row = pg_fetch_row($result)) {
	  $ips[] = $row[0];
	}

	return $ips;

}
function send_mail($ip, $timestamp, $uri) {
	$message = "Blocked: '$ip' at '$timestamp' with path: '$uri'";
	$user = getenv('SMTP_USER');
	$headers = "From: '$user'";

	mail("test@domain.com", "BLOCKED", $message, $headers);
}

function init_db(){
	$dbhost = getenv('POSTGRESQL_HOST');
	$dbuser = getenv('POSTGRESQL_USER');
	$dbpassword = getenv('POSTGRESQL_PASSWORD');
	$dbname = getenv('POSTGRESQL_DBNAME');

	$conn = pg_connect("host='$dbhost' dbname='$dbname' user='$dbuser' password='$dbpassword'");
	if(!$conn) {
	   echo('ERROR: DB connection failed.');
	   header('HTTP/1.1 500 Internal Server Error');
	   exit(0);
	}

	$initQuery = <<<'EOD'
CREATE TABLE IF NOT EXISTS blocked (
   date TIMESTAMP NOT NULL,
   path VARCHAR (1000),
   ipaddr VARCHAR (15)
);
EOD;

	pg_query($conn, $initQuery);
	return $conn;
}

function log_to_db($conn, $ip, $timestamp, $uri){
	$values = "( '$timestamp', '$uri', '$ip' )";
	$query = "INSERT INTO blocked (date, path, ipaddr) VALUES ". $values;
	$result = pg_query($conn, $query);
}

$c = init_db();

$ip = $_SERVER['REMOTE_ADDR'];
$ips = get_blocked_ips($c);
if(!empty($ips) && in_array($ip, $ips)){
	header('HTTP/1.1 429 Too Many Requests');
	exit(0);
}

$timestamp = date('Y-m-d H:i:s');
$uri = $_SERVER['REQUEST_URI'];
log_to_db($c, $ip, $timestamp, $uri);
block_ip(get_blocked_ips($c));

//init_smtp();
//send_mail($ip, $timestamp, $uri);


?>
