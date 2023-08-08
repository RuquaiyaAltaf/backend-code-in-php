<?php include('includes/header.php');?>
<?php include('includes/nav.php');?>

	<div class="jumbotron">
		<h1 class="text-center"><?php   display_message(); ?> </h1>
	</div>


<div class="row">
    <div class="col-md-12">
        <?php display_message(); ?>

    </div>
</div>

 <?php
$sql ="SELECT *FROM users";
$result= query($sql);
confirm($result);
$row = fetch_array($result);
echo $row['username']; 
?>

	<?php include('includes/footer.php');?>
