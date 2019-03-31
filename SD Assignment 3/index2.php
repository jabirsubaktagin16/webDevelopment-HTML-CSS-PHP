<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js\jquery.min.js"></script>
<link rel="stylesheet"
href="css\bootstrap.min.css" />
<script src="js\bootstrap.min.js"></script>

</head>

<body>
<?php
$error='';
$name ='';
$email='';
$password='';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["password"]))
 {
  $error .= '<p><label class="text-danger">Please Enter Password </label></p>';
 }
 else
 {
  $password = clean_text($_POST["password"]);
 }
 
 if($error == '')
 {
  $file_open = fopen("assignment3.csv", "a");
  $no_rows = count(file("assignment3.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'id'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'password' => $password,
  );
  fputcsv($file_open, $form_data);
  $name = '';
  $email = '';
  $password = '';
 }
}
?>
<div class="container">
  <table class="table table-bordered">
  <thead>
  <tr>
      <th> ID </th>
  <th>Name</th>
  <th>Email</th>
  <th>Password</th>
</tr>
<tbody>


	<?php
		if(isset($_POST['submit']))
		{
        $fp=fopen('assignment3.csv','r');//read mode
		 $fs=filesize('assignment3.csv');//we can know file size
		 $separator=",";
		
		 while($row=fgetcsv($fp,$fs,$separator))
		 { echo '<tr>';
			 
			 echo '<td>'.$row[0].'</td>';
			  echo '<td>'.$row[1].'</td>';
			  echo '<td>'.$row[2].'</td>';
          echo '<td>'.$row[3].'</td>';
			  echo'</tr>';
		 }  
		 
		 
		}	
	   
		?>
		</tbody>
		</table>
		
</div>
</body>
</html>