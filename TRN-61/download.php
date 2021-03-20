<?php
session_start();
$filedown = $_GET['file'];
$fileDest = '/var/www/PHP-assignment/TRN-61/TRN-55'.$filedown;
	if (!empty($filedown))
		{
			if (!empty($filedown) && file_exists($fileDest)) 
				{
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="'.basename($filedown).'"');
					header('Expires: 0');
					header('Cache-Control: public');
					header('Pragma: public');
					header('Content-Length: ' . filesize($filedown));
					readfile($fileDest);
					exit;
				}
		}
?>
