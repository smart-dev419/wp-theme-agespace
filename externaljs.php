<?php
header('Content-type: text/javascript');
function get_content($URL){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $URL);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
}

$files = array(
    
	
);

if(isset($_GET['file'])) {
	if ($_GET['file'] == 'https://ssl.google-analytics.com/ga.js'){
		header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + ((60 * 60) * 48))); // 2 days for GA
	} else {
		header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60))); // Default set to 1 hour
	}
$out=get_content($_GET['file']);;
	echo $out;
      
}

?>