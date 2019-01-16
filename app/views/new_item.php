<?php require_once "../partials/template.php"; ?>

<?php function get_page_content(){ ?>
<?php	global $conn; ?>
	
	<div class="container mt-4">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<form action="../controllers/process_add_item.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="name"> Name </label>
						<input type="text" class="form-control" name="name" id="name" required>
					</div>
					<div class="form-group">
						<label for="price"> Price </label>
						<input type="text" class="form-control" name="price" min="1" id="price" required>
					</div>
					<div class="form-group">
						<label for="description"> Description </label>
						<textarea type="text" class="form-control col-8" rows="5" name="description" id="description"> </textarea>
					</div>
					<div class="form-group">
						<label for="categories"> Categories </label>
							<select class="form-control col-8" name="category_id" id="categories" required=""> 

							<?php 
							$sql = "SELECT * FROM categories";
							$categories = mysqli_query($conn, $sql);
							foreach ($categories as $category) {
								//extract is another way of getting data. it transforms teh columns into variables
								extract($category);
								echo "<option value='$id'> $name </option>";
							}

							?>

							</select>

						<div class="form-group">
							<label for="image"> Image </label>
							<input type="file" id="image" class="form-control" name="image" required>
						</div>

						<button type="submit" class="btn btn-primary btn-block"> Add New Item</button>
					</div>
				</form>
			</div> <!-- end of 8 col -->
		</div> <!-- end of row -->
	</div> <!-- end container -->



<?php } ?>