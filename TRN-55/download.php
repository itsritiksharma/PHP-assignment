<?php
$filedown = $_GET['file'];
$fileDest = '/var/www/PHP-assignment/TRN-55/'.$filedown;
if (!empty($filedown))
{
	if (!empty($filedown) && file_exists($fileDest))
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/msword');
		header('Content-Disposition: attachment; filename="'.basename($filedown).'"');
		header('Expires: 0');
		header('Cache-Control: public');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filedown));
		exit;
	}
}
?>
