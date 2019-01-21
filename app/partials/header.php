<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="#">
			<img src="https://img.icons8.com/color/48/000000/food.png"></i> Mang Inasar!
		</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="navbar-nav" class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">

				<?php if (!isset($_SESSION['user']) || (isset($_SESSION['user'])) && ($_SESSION['user']['roles_id'] == 2)) { ?>
				

				<li class="nav-item">

					<a class="nav-link" href="./home.php"> <img src="https://img.icons8.com/color/48/000000/home.png">Home </a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="./catalog.php"><img src="https://img.icons8.com/color/48/000000/moleskine.png"> Catalog </a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="../views/cart.php"><img src="https://img.icons8.com/color/48/000000/add-shopping-cart.png"> Cart <span class="badge bg-light text-dark" id="cart-count"> 
						<?php 
							if (isset($_SESSION['cart'])) {
								echo array_sum($_SESSION['cart']);
							} else {
								echo 0;
							}
						?>
					 </span> </a>
				</li>

			<?php } elseif(isset($_SESSION['user']) && ($_SESSION['user']['roles_id'] == 1)) { ?>

				<li class="nav-item">
					<a class="nav-link" href="../views/items.php"> Items </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../views/order.php"> Orders </a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../views/users.php"> Users </a>
				</li>

			<?php }; ?>

				<?php if(isset($_SESSION['user'])) { ?>

				<li class="nav-item">
					<a class="nav-link" href="./vieqws/profile.php"> WELCOME!, <?php echo $_SESSION['user']['firstname']; ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="../controllers/logout.php"> Logout </a>
				</li>

			<?php } else { ?>
 				

				<li class="nav-item">
					<a class="nav-link" href="./login.php"><img src="https://img.icons8.com/color/48/000000/gender-neutral-user.png"> Login </a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="./register.php"><img src="https://img.icons8.com/color/48/000000/edit-user-male.png"> Register </a>
				</li>

			<?php } ?>
			
			</ul>
		</div> <!-- end navbar nav -->
	</nav> <!-- end nav -->

