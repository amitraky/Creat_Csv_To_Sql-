<?php include('db.php');
//echo mysql_field_name($wkres, 2);     

if(isset($_POST['btn']))
{	 
   if($_FILES['file']['type']=='application/vnd.ms-excel'){
	      $filename=mktime().'_'.$_FILES['file']['name'];
          $path='upload/'.$filename;		 
	
	    if(file_exists("upload/" . $filename))
		 {
		  echo "file is exists";
		 }
	  else
	   {	 
			 if($lct=move_uploaded_file($_FILES['file']['tmp_name'],$path))
			 {
			 $file = fopen($path, 'r');
			 $i=0;
             while (($line = fgetcsv($file)) !== FALSE) {
			if($i>0){
			  
			 /*echo "<pre>";
			 print_r($line);
			 echo "</pre>";*/
			 
			 $series	    = $line['13'];
			 $frequency 	= $line['14'];
			 $type          = $line['15'];
			 $impedance     = $line['16'];
			 $size          = $line['19'];
			 $termination   = $line['20'];
			
 		   echo "<br>";
		   echo $sris = mst_into_prd($series); die;
	       echo $frqcy = mst_into_prd($frequency);	   
		   echo $type = mst_into_prd($type);
		   echo $impdce = mst_into_prd($impedance);
		   echo $zise = mst_into_prd($size);		 
		   echo $trmtn = mst_into_prd($termination);	 
	
		        $sql="insert into custom_product(
				`id`,
				`catid`,
				`partNum`,
				`manufacturer`,
				`mPartNum`,
				`description`,
				`leadStatus`,
				`datasheet`,
				`productPhoto`,
				`drawing`,
				`quantity`,
				`price`,
				`minQty`,
				`series`,
				`frequency`,
				`type`,
				`impedance`,
				`voltage-input-max`,
				`capacitance-frequency`,
				`size`,
				`termination`,
				`operating`,
				`other`,
				`status`,
				`seo`,
				`slug`				
			 )
				
				values(
				
				'$line[0]',
				'$line[1]',
				'$line[2]',
				'$line[3]',
				'$line[4]',
				'$line[5]',
				'$line[6]',
				'$line[7]',
				'$line[8]',
				'$line[9]',
				'$line[10]',
				'$line[11]',
				'$line[12]',
				'$sris',
				'$frqcy',
				'$type',
				'$impdce',
				'$line[17]',
				'$line[18]',
				'$zise',
				'$trmtn',
				'$line[21]',
				'$line[22]',
				'$line[23]',
				'$line[24]',
				'$line[25]'
				
				   )";
					$res=mysql_query($sql);
				    //echo $sql;				
				}$i++;
				}
					echo $res==1?'<br>Data is save to database':'File Not import';
			 }
			 
		}
		
   }else
     {
	   echo "Invalide file";
	  }		  
		
} 
	
function mst_into_prd($input){
$wkmst="select * from wkends_masters where name='$input'";
$wkres=mysql_query($wkmst);

$row=mysql_fetch_assoc($wkres);
return $row['id'];
}
?>
<form  method="post" enctype="multipart/form-data">

<p>
  Filename<input type="file" name="file" id="file">
  <br>
    <input type="submit" name="btn" value="Submit">
</p>
</form>
