<?php

$date = date('dMYHis');
$image_data=$_POST['image_value'];

$filter_data=substr($image_data, strpos($image_data, ",")+1);
$final_data=base64_decode($filter_data);
$fp = fopen( './images/pic'.$date.'.png', 'wb' );
fwrite( $fp, $final_data);
fclose( $fp );

exit();
?>

