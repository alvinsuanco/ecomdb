$(document).ready( () => {
	function validate_registration_form(){
		let errors = 0;
		let username = $("#username").val();
		let password = $("#password").val();
		let firstname = $("#firstname").val();
		let lastname = $("#lastname").val();
		let email = $("#email").val();
		let address = $("#address").val();

		//username should be greater than or equal to 10 chars
		if(username.length < 10) {
			$('#username').next().html('*username should be more atleast 10 characters');
			errors++;
		} else {
			$('#username').next().html(' '); //remove error message;
		}

		//password should be atleast 8 chars
		if (password.length < 8) {
			$('#password').next().html('*Please provide stronger password');
			erros++;
		} else {
			$('#password').next().html(" ");
		}

		//email
		if (!email.includes("@")) {
			$('#email').next().html("*Please provide a valid email");
			errors++;
		} else {
			$('#email').next().html(" ");
		}

		//address
		if (!address != "") {
			$('#address').next().html("Please provide a valid address");
			errors++;
		} else {
			$('#address').next().html(" ");
		}

		//fisrtname
		if(!firstname != ""){
			$("#firstname").next().html("Please provide a valid first name");
			errors++;
		} else {
			$('#fisrtname').next().html(" ");
		}

		//lastname
		if(!lastname != ""){
			$("#lastname").next().html("Please provide a valid last name");
			errors++;
		} else {
			$('#lastname').next().html(" ");
		}

		//confirm password
		if(password != $('#confirm_password').val()){
			$('#confirm_password').next().html('Password should match');
			errors++;
		} else {
			$("#confirm_password").next().html(" ");
		}


		if(errors > 0){
			return false; // this means there ar errors
		} else {
			return true;
		}
	} //end of validate_registration_form


	$("#add_user").click( (e) => {
		if(validate_registration_form() ){
			let username = $("#username").val();
			let password = $("#password").val();
			let firstname = $("#firstname").val();
			let lastname = $("#lastname").val();
			let email = $("#email").val();
			let address = $("#address").val();

			$.ajax({
				url : '../controllers/create_user.php',
				method : "POST",
				data : {
					username :username,
					password :password,
					firstname :firstname,
					lastname :lastname,
					email :email,
					address :address
				},
				"success":(data) => {
					if(data == "user_exists") {
						$("#username").next().html("Username already exists");
					} else {
						alert("user created successfully");
						//redirect broswer
						window.location.replace("../../index.php")
					}
				}
			});
		}
	});

	//login and session
	$("#login").click( (e) => {
			let username = $("#username").val();
			let password = $("#password").val();

			$.ajax({
				"url" : "../controllers/authenticate.php",
				"method" : "POST",
				"data": {
					'username':username,
					'password':password
				},
				"success":(data) => {
					if(data == "login_failed") {
						$("#username").next().html("Please provide correct credentials");
					} else {
						window.location.replace("../views/home.php");
					}
				}
			});

		});


	//prep for add to cart

	$(document).on('click', '.add-to-cart', (e) => {
		//to prevent default behavior and to override it with our own
		e.preventDefault();
		//prevent parent elements to be triggered
		e.stopPropagation();

		// target is the one who triggered event
		let item_id = $(e.target).attr("data-id");
		let item_quantity = parseInt($(e.target).prev().val());

		$.ajax({
			"url" : "../controllers/update_cart.php",
			"method" : "POST",
			"data" : {
				'item_id':item_id,
				'item_quantity':item_quantity,
				'update_from_cart_page' : 0
			},
			"success" : (data) => {
				$("#cart-count").html(data);
			}
		});	

	});


	function getTotal() {
			let total = 0;
			$(".item_subtotal").each(function(e) {
				total += parseFloat($(this).html());
			});
			$("#total_price").html(total.toFixed(2));
		}


		//edit cart
		$(".item_quantity>input").on("input", (e) =>{
			let item_id = $(e.target).attr('data-id');
			let quantity = parseInt($(e.target).val());
			let price = parseFloat($(e.target).parents('tr').find(".item_price").html());

			subTotal = quantity * price;
			$(e.target).parents('tr').find('.item_subtotal').html(subTotal.toFixed(2));

			getTotal();

			$.ajax({
				"method" : "POST",
				"url" : "../controllers/update_cart.php",
				"data" : {
					'item_id': item_id,
					'item_quantity': quantity,
					'update_from_cart_page': 1
				},
				"success": (data) => {
					// alert(data);
					$("#cart-count").html(data);
				}
			});
		});


		//delete button
		$(document).on("click", '.item-remove', (e) =>{
			e.preventDefault();
			e.stopPropagation();

			let item_id = $(e.target).attr('data-id');

			$.ajax({
				"method" : "POST",
				"url" : "../controllers/update_cart.php",
				"data" : {
					'item_id' : item_id,
					'item_quantity' : 0
				},
				"beforeSend" : () => {
					return confirm("Are you sure you want to delete?");
				},
				"success": (data) => {;
					$(e.target).parents('tr').remove();
					$("#cart-count").html(data);
					getTotal();
					window.location.replace("../views/cart.php");
				}

			});
		});


		//submit profile from update
		$('#update_info').click( ()=>{
			//alert('submitted');
			$('#update_user_details').submit();
		})
	
	


});
