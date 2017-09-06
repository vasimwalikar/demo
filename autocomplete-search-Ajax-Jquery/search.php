<?php

$connection = mysql_connect('localhost','root','root') or die(mysql_error());
$database = mysql_select_db('culture_place') or die(mysql_error());

	if($_POST){

		$q=$_POST['search'];

		$sql_res=mysql_query("select id,name,email from admin where name like '%$q%' or email like '%$q%' order by id LIMIT 5");
		
		while($row=mysql_fetch_array($sql_res)){

			$username=$row['name'];
			$email=$row['email'];
			$b_username='<strong>'.$q.'</strong>';
			$b_email='<strong>'.$q.'</strong>';
			$final_username = str_ireplace($q, $b_username, $username);
			$final_email = str_ireplace($q, $b_email, $email);

			?>
			<div class="show" align="left">
				<img src="author.PNG" style="width:50px; height:50px; float:left; margin-right:6px;" /><span class="name"><?php echo $final_username; ?></span>&nbsp;<br/><?php echo $final_email; ?><br/>
			</div>
			<?php
		}

	}
?>
