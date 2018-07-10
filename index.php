
<form action="" method="POST" enctype="multipart/form-data">
<p>
    <input type="file" name="image" />
    <input type="submit" value="Upload">

</p>
</form>

<?php

use base64Image\Base64formEncode;
use base64Image\Base64pathEncode;

$image1 = new Base64formEncode();
//$image2 = new Base64pathEncode('D:\OSPanel\g1.jpg');
$a = $image1->base64Encode();
//$b = $image2->base64Encode();
echo $a . "/n/r ";
?>