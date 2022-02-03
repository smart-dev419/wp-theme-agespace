<?php

$handlersNumbers=$_GET['handlers'];
var_dump($handlersNumbers);
header('Content-type: text/css');
//	$path_to_css = '/home/agespace/public_html/wp-content/uploads/elementor/css'; // edit path to css directory
//        
//	function get_files($dir = '.', $sort = 0) {
//		$files = scandir($dir, $sort);
//           //       var_dump($files);
//		$files = array_diff($files, array('.', '..'));
//           //         var_dump($files);
//		return $files;
//	}
//        
//        
//        
//        
//        
//	$files = get_files($path_to_css, 1);
//       // var_dump($files);
//	foreach($files as $file) {
//        //     var_dump($file);
//		include_once($path_to_css . '/' . $file);
//	} 


$path_to_css = '/home/agespace/public_html/wp-content/uploads/elementor/css'; // edit path to css directory
        
	
	
       // var_dump($files);
        $handlersNumbersArray=explode( ',',$handlersNumbers);
     
	foreach($handlersNumbersArray as $number) {
     
            $pathToInclude= $path_to_css.'/post-'.$number.'.css';
		include_once($pathToInclude);
	} 