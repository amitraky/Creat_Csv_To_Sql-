<?php include('db.php');     
if(isset($_POST['btn']))
     
{	 
	   if($_FILES['file']['type']=='application/vnd.ms-excel'){
	   
	      $filename=mktime().'_'.$_FILES['file']['name'];
          $path='upload/'.$filename;		 
	
	    if(file_exists("upload/" . $filename))
		 {
		  echo "<span style=color:#FF0000>File is Exists</span>";
		 }
	  else
	   {	 
			 if($lct=move_uploaded_file($_FILES['file']['tmp_name'],$path))
			 {
		   
		   $file = fopen($path, 'r');
             while (($line = fgetcsv($file)) !== FALSE) {
             //$line is an array of the csv elements
           $sql="insert into tbl_custom(id,name,addr,city,mobile)values($line[0],'$line[1]','$line[2]','$line[3]',$line[4])";        
		     $res=mysql_query($sql);
			  //echo $sql;
			  }
			  echo $res==1?'<br><span style=color:#009933>File is import</span>':'File Not import';			 				

					
			 }
			 
		}
		}else {echo "<span style=color:#FF0000>Invailed File<span>";}
		
} 
	 
?>
<form  method="post" enctype="multipart/form-data">

<p>
  Filename:<input type="file" name="file" id="file" size="5">
  <br>
    <input type="submit" name="btn" value="Submit">
</p>

</form>

