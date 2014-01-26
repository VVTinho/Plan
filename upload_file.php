<?php

	error_reporting(0);

	$change="";
	$abc="";

	// Filluppladning maxstorlek 10Mb.
	define ("MAX_SIZE","10000");
	function getExtension($str) {

		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

	$errors=0;

	if($_SERVER["REQUEST_METHOD"] == "POST") {

	 	$image =$_FILES["file"]["name"];
		$uploadedfile = $_FILES['file']['tmp_name'];

	 	if ($image) {

	 		$filename = stripslashes($_FILES['file']['name']);

	  		$extension = getExtension($filename);
	 		$extension = strtolower($extension);


	 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {

	 			$change='<div class="msgdiv">Odefinerad bild fil</div> ';
	 			$errors=1;
	 		}
	 		else {

	 			$size=filesize($_FILES['file']['tmp_name']);


				if ($size > MAX_SIZE*1024) {

					$change='<div class="msgdiv">För stor fil!</div> ';
					$errors=1;
				}


				if($extension=="jpg" || $extension=="jpeg" ) {

					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefromjpeg($uploadedfile);
				}

				else if($extension=="png") {

					$uploadedfile = $_FILES['file']['tmp_name'];
					$src = imagecreatefrompng($uploadedfile);
				}

				else {

					$src = imagecreatefromgif($uploadedfile);
				}

				echo $scr;

				// echo $filename;
				echo "<span class=\"imagename\">$filename</span>";

				list($width,$height)=getimagesize($uploadedfile);

				// Storlek på bilderna som vissas.
				$newwidth=1024;
				$newheight=($height/$width)*$newwidth;
				$tmp=imagecreatetruecolor($newwidth,$newheight);

				// Storlek på thumbs bilderna som skapas.
				$newwidth1=1024;
				$newheight1=($height/$width)*$newwidth1;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

				$filename = "uploadedImages/". $_FILES['file']['name'];

				$filename1 = "uploadedImages/thumbs/small". $_FILES['file']['name'];

				imagejpeg($tmp,$filename,100);

				imagejpeg($tmp1,$filename1,100);

				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);

				// Skicka in bildens images nr 1. Sql ej klar.
				$sql="INSERT INTO images SET images=1";
				$result=mysql_query($sql);
			}
		}

	}

	// Om inga fel har uppståt, printa meddelandet.
	if(isset($_POST['Submit']) && !$errors) {

		// mysql_query("update {$prefix}users set img='$big',img_small='$small' where user_id='$user'");
		$change=' <div class="msgdiv">Bilden har laddats upp!</div>';
	}
?>


<div id="container">
	<?php echo $change; ?>

	<div id="posts">&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename; ?>" />  &nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $filename1; ?>"/>
	<form method="post" action="" enctype="multipart/form-data" name="form1">
		Bild:<input size="25" name="file" type="file" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10pt" class="box"/>
		<input type="submit" id="mybut" value="skicka" name="Submit"/>
		Bilden kommer att cropas till 1024 * 800:
		<div id="dotted-line"></div>

		<div id="page-links">
			<a href="../index.php">Gå tillbaka till Planlösningen &nbsp;</a>
		</div>
	</form>
</div>
