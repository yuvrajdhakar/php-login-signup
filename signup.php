<html>
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="app.css" />
</head>
<body>

<!-- component -->
<!-- Create By Joker Banny -->
<div class="min-h-screen bg-no-repeat bg-cover bg-center"
	style="background-image: url('https://images.unsplash.com/photo-1486520299386-6d106b22014b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80')">
	<div class="flex justify-end">
		<div class="bg-white min-h-screen w-1/2 flex justify-center items-center">
			<div>

            <?php if(isset($_GET['error'])){ ?>
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
   <?php echo $_GET['error']; ?>
</div>
<?php } ?>


				<form action="signup-process.php" method="POST">
					<div>
						<span class="text-sm text-gray-900">Welcome</span>
						<h1 class="text-2xl font-bold">Create your account</h1>
					</div>
                    <div class="mt-5">
					<label class="block text-md mb-2" for="name">Your full name</label>
							<input class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" type="text" name="name" placeholder="Enter your full name" required="required">
        </div>

					<div class="my-3">
					<label class="block text-md mb-2" for="email">Email</label>
							<input class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" type="email" name="email" placeholder="Enter your email" required="required">
        </div>
						<div class="my-3">
                        <label class="block text-md mb-2" for="password">Password</label>
						<input class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" type="password" name="password" placeholder="Enter your password" required="required">
                        
							
        </div>
        <div class="my-3">
                        <label class="block text-md mb-2" for="confirm_password">Confirm Password</label>
						<input class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" type="password" name="confirm_password" placeholder="Retype your password" required="required">
                        
							
        </div>
						
							<div class="">
								<button class="mt-4 mb-3 w-full bg-green-500 hover:bg-green-400 text-white py-2 rounded-md transition duration-100">Signup</button>
								
							</div>
				</form>
				<a href="index.php"><p class="mt-8"> Already have an account? <span class="cursor-pointer text-sm text-blue-600"> login</span></p></a>
			</div>
		</div>
	</div>
</div>
</div>
</body>