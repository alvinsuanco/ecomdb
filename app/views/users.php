<?php require_once '../partials/template.php'; ?>

<?php function get_page_content() { 
	if (isset($_SESSION['user']) || (isset($_SESSION['user'])) && $_SESSION['user']['roles_id'] == 1) {
	global $conn;
?>

	<div class="container mt-5">
		<h4 class="text-center m-3"> User Admin Page</h4>
		<div class="row">
			<div class="col-sm-10 offset-sm-2">
				<table class="table table-responsive table-striped">
					<thead>
						<tr class="text-center">
							<td> Username </td>
							<td colspan="2"> First Name </td>
							<td colspan="2"> Last Name </td>
							<td> Email </td>
							<td> Role </td>
							<td> Action </td>
						</tr>
					</thead>

					<tbody>
						<?php 
						$get_user_detail_query = "SELECT u.id, u.username, u.firstname, u.lastname, u.email, r.name AS role FROM users u JOIN roles r ON(u.roles_id = r.id); ";
						$user_details = mysqli_query($conn, $get_user_detail_query);

						foreach ($user_details as $indiv_user) {
							//var_dump($indiv_user);

						?>
						
						<tr>
							<td><?php echo $indiv_user['username']; ?></td>
							<td colspan="2"><?php echo $indiv_user['firstname']; ?></td>
							<td colspan="2"><?php echo $indiv_user['lastname']; ?></td>
							<td><?php echo $indiv_user['email']; ?></td>
							<td><?php echo $indiv_user['role']; ?></td>
							
							<td>	<?php 
									$id = $indiv_user['id'];
									if ($indiv_user['role'] == 'admin'){
										echo "<a href='../controllers/grant_admin.php?id=$id' class='btn btn-danger'> Revoke Admin </a>";
									} else {
										echo "<a href='../controllers/grant_admin.php?id=$id' class='btn btn-primary'> Make Admin </a>";
									}
								 ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table> <!-- end of table -->
			</div> <!-- end of cols -->
		</div> <!-- end of row -->
	</div> <!-- end of container -->










<?php } else {
		header("Location: ./error.php");
} ?>


<?php } ?>
