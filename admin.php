<?php include('includes/header.php');?>
<?php include('includes/nav.php');?>

<!--
<?php
if(!loggedin()){
    redirect("login.php");
}


?>
-->

	<div class="jumbotron">
		<h1 class="text-center">
		    <?php
            if(loggedin()){
                echo"you are now logged in ";
            }else{
                echo"Logged in First";
            }
            ?>
            
            
            
            
            
    </h1>
	</div>


<?php include('includes/footer.php');?>