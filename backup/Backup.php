<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php 
ini_set('max_execution_time', 0);  

 /* MYSQL EXPORT TO GZIP 
 * exporting database to sql gzip compression data.
 * 
 */
 function backup_Database($hostName,$userName,$password,$DbName,$tables = '*'){
  
  // CONNECT TO THE DATABASE
	global $conn;
	$conn = mysqli_connect($hostName,$userName,$password,$DbName);

if(!$conn)
{
	die('connection failed:' . mysqli_error($conn));
}
  
  
  
 
  // GET ALL TABLES
  if($tables == '*'){
    $tables = array();
    $result = mysqli_query($conn,'SHOW TABLES');
    while($row = mysqli_fetch_row($result)){
      $tables[] = $row[0];
    }
  }
  else{
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
 
 
  $return = "-- Database Backup  \n";
  $return .= "-- Database: " . $DbName . "\n";  
  $return .= '-- Created: ' . date("Y/m/d") . ' on ' . date("h:i") . "\n\n";  
  $return .= 'SET FOREIGN_KEY_CHECKS=0;' . "\r\n";
  $return.= 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\r\n";
  $return.= 'SET AUTOCOMMIT=0;' . "\r\n";
  $return.= 'START TRANSACTION;' . "\r\n\n";
  
  $data='';
  foreach($tables as $table){
    $result = mysqli_query($conn,'SELECT * FROM '.$table) or die(mysqli_error($conn));
    $num_fields = mysqli_num_fields($result) or die(mysqli_error($conn));
    
    $data.= 'DROP TABLE IF EXISTS '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($conn,'SHOW CREATE TABLE '.$table));
    $data.= "\n\n".$row2[1].";\n\n";
    
    for ($i = 0; $i<$num_fields; $i++) {
      while($row = mysqli_fetch_row($result)){
        $data.= 'INSERT INTO '.$table.' VALUES(';
        for($x=0; $x<$num_fields; $x++) {
          $row[$x] = addslashes($row[$x]);
   $row[$x] = clean($row[$x]); // CLEAN QUERIES
          if (isset($row[$x])) { 
   	$data.= '"'.$row[$x].'"' ; 
   } else { 
   	$data.= '""'; 
   }
   
          if ($x<($num_fields-1)) { 
   	$data.= ','; 
   }
        }  // end of the for loop 2
        $data.= ");\n";
      } // end of the while loop 
    } // end of the for loop 1
 
    $data.="\n\n\n";
  }  // end of the foreach*/
  
    $return2 = 'SET FOREIGN_KEY_CHECKS=1;' . "\r\n";
 $return2 .= 'COMMIT;';
  
  //SAVE THE BACKUP AS SQL FILE
  $filename = 'DbBackup-'.date('d-m-Y @ h.i.s').'.sql';
  $handle = fopen($filename,'w+');
  fwrite($handle,$return);
  fwrite($handle,$data); 
  fwrite($handle,$return2);  
  fclose($handle);
  
  //GZIP
  $gzfilename = $filename.".gz";
  $fp = gzopen($gzfilename, 'w9');
  gzwrite ($fp, file_get_contents($filename));
  gzclose($fp);

  unlink($filename);
  rename( $gzfilename, "backups/".$gzfilename); //destination directory  
  
   if($data)
   return true;
   else
 return false;
 }  // end of the function
 
 
//  CLEAN THE QUERIES
function clean($str) {
global $conn;	
 if(@isset($str)){
 $str = @trim($str);
 if(get_magic_quotes_gpc()) {
 $str = stripslashes($str);
 }
 return mysqli_real_escape_string($conn, $str);   
 }
 else{
 return 'NULL';
 }
}
 

if(isset($_POST['submit'])){ 


 $backup_response = backup_Database('localhost','root','red');
  if($backup_response) {
	  $sucess = "<script type=\"text/javascript\">alert(\"Database Backup Completed Successfully.\") </script>";	
 echo $sucess;  
  }
  else {
 echo 'Database Backup Failed. Contact your administrator.';    
  }   
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Backup</title>
<style type="text/css">
.maindiv {
	background-color:rgba(10, 10, 10, 0.7);
	height: 400px;
	width: 600px;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 18px;
	margin-right: auto;
	margin-bottom: auto;
	margin-left: auto;
	margin-top: 40px;
}
.contentdiv {
	background-color: #999;
	border: thin solid #E7FFB3;
	margin-top: 50px;
}

.but {
	height: 40px;
	width: 100px;
	font-size: 18px;
}
</style>
</head>

<body bgcolor="#f0f2f5">
<div class="maindiv">
  <div class="maindiv"> Backup Utility
    <form action="Backup.php" method="post" name="form1" class="contentdiv" id="form1">
  
    <p>Click Here to Backup Database</p>
    <input name="submit" type="submit" class="but" value="Backup"/>
 
  <p>&nbsp;</p>
  </form>
  <a href="<?php echo $logoutAction ?>">Log out</a>  </div>
 </div>
</body>
</html>