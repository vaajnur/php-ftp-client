<?

require 'vendor/autoload.php';

function compareByTimeStamp($time1, $time2)
{
    if (strtotime($time1) < strtotime($time2)) 
        return 1; 
    else if (strtotime($time1) > strtotime($time2)) 
        return -1;
    else
        return 0;
}


$ftp = new \FtpClient\FtpClient();
$host = '178.206.111.22';
$ftp->connect($host);
list($login, $password) = ['becap_user' , 'mySuperPass123'];
$ftp->login($login, $password);
// важно! пассивный режим
$ftp->pasv(true);


$rem_dir = 'becap_sites/';
$local_dirs = scandir('../backups');
array_shift($local_dirs);
array_shift($local_dirs);

foreach ($local_dirs as $key => $local_dir) {
	list($source_directory, $target_directory) = ['../backups/' . $local_dir , $rem_dir.$local_dir];
	// Creates a directory
	$ftp->mkdir($rem_dir.$local_dir);
	$ftp->putAll($source_directory, $target_directory, FTP_BINARY);
}

$items = $ftp->scanDir($rem_dir);
foreach ($items as $key => $value) {
	if($value['type'] == 'directory'){
		$dirs[] = $value['name'];
	}
}

usort($dirs, 'compareByTimeStamp');
$dirs = array_reverse($dirs);

// Removes a directory (recursive)
$files = $ftp->scanDir($rem_dir.$dirs[0]);
foreach ($files as $key => $file) {
	// $ftp->delete($rem_dir.$dirs[0].'/'.$file['name']);
}
// $ftp->rmdir($rem_dir.$dirs[0]);
