<?php


      $url='https://agespaceimages.s3.eu-west-2.amazonaws.com/wp-content/uploads/2020/08/05122156/Age-Space-Media-pack-July-2020-2_compressed.pdf';

      


$file_url =$url;
		$pdfname = basename ($file_url);
		header('Content-Type: application/pdf');
		header("Content-Transfer-Encoding: Binary");
		header("Content-disposition: attachment; filename=".$pdfname);
		readfile($file_url);