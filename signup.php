
<?php
session_start();
include "db-connection.php";

$countriesResult = $conn->query("select * from countries");
 
 
?>
<html>
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="app.css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
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
		<div class="my-3">
		<label class="block text-md mb-2" htmlfor="grid-password"> Country </label>
						 
						<select class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" name="country"
                                                onchange="getStates(this.value)"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option value="">Select your country</option>
                                            <?php
                                            while ($country = $countriesResult->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $country['country_code'];?>"><?php echo $country['country_name']; ?></option>
                                            <?php } ?>
                                        </select> 
							
                               </div>
		                          <div class="my-3">
                                        <label class="block text-md mb-2"  htmlfor="grid-password">State </label>    
                                        <select class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" name="state"
                                        onchange="getcityes(this.value)"
                                                id="states"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option value="">Select your state</option>
                                           

                                        </select>
                                    </div>

									<div class="my-3">
                                        <label class="block text-md mb-2"  htmlfor="grid-password">City</label>
                                        <select class="px-4 w-full border-2 py-2 rounded-md text-sm outline-none" name="city"
                                                 id= "cityes"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option value="">Select your City</option>
                                            
                                        </select>
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

<script>
    function getStates(country_code){
        $.ajax({
            url: "api/get-states.php?country_code="+country_code,
            method:"GET",
            timeout: 5000,
            beforeSend: function (xhr) {
                $("#loading").show();
            }
        }).done(function (response) {

            $("#loading").hide();

            response = JSON.parse(response);
            if (response.success) {

                let data = response.data;

               let statesElement = document.getElementById("states");
                $('#states option:not(:first)').remove();
                $('#cityes option:not(:first)').remove();
                if(data){
                    for (const stateData of data) {
                        var opt = document.createElement('option');
                        opt.value = stateData.id;
                        opt.innerHTML = stateData.name;
                        statesElement.appendChild(opt);
                    }
                }

            } else {
                console.log("no result found.");
                alert(response.message);
            }

        });
    }
</script>
<script>
    function getcityes(state_id){
        $.ajax({
            url: "api/get-cities.php?state_id="+state_id,
            method:"GET",
            timeout: 5000,
            beforeSend: function (xhr) {
                $("#loading").show();
            }
        }).done(function (response) {

            $("#loading").hide();

            response = JSON.parse(response);
            if (response.success) {

                let data = response.data;

               let cityesElement = document.getElementById("cityes");
                $('#cityes option:not(:first)').remove();
                if(data){
                    for (const statessData of data) {
                        var opt = document.createElement('option');
                        opt.value = statessData.id;
                        opt.innerHTML = statessData.name;
                        cityesElement.appendChild(opt);
                    }
                }

            } else {
                console.log("no result found.");
                alert(response.message);
            }

        });
    }
</script>

</body>
 