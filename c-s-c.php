<?php
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: home.php?error='You don't have permission for that page.");
    die();
}

$title = "Country/State/City selection";

include "db-connection.php";

$countriesResult = $conn->query("select * from countries");
?>
<!DOCTYPE html>
<html>
<?php include "layouts/head.php"; ?>
<body class="text-blueGray-700 antialiased">
<noscript>You need to enable JavaScript to run this app.</noscript>
<div id="root">
    <?php include "layouts/nav.php"; ?>
    <div class="relative md:ml-64 bg-blueGray-50">
        <?php include "layouts/top.php"; ?>
        <div class="px-4 md:px-10 mx-auto w-full -m-24">
            <!-- content start here -->
            <div class="w-full px-4">
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                    <?php if (isset($_GET['success'])) { ?>
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                             role="alert">
                            <span class="font-medium">Success!</span> <?php echo $_GET['success']; ?>
                        </div>
                    <?php }

                    if (isset($_GET['error'])) { ?>
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                             role="alert">
                            <?php echo $_GET['error']; ?>
                        </div>
                    <?php } ?>
                    <div class="rounded-t bg-white mb-0 px-6 py-6">
                        <div class="text-center flex justify-between">
                            <h6 class="text-blueGray-700 text-xl font-bold">
                               your information:
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <form method="POST" enctype="multipart/form-data">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                              ditels
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                               htmlfor="grid-password">
                                            Country
                                        </label>
                                        <select name="country"
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
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                               htmlfor="grid-password">
                                            State
                                        </label>
                                        <select name="state"
                                        onchange="getcityes(this.value)"
                                                id="states"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option value="">Select your state</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                               htmlfor="grid-password">
                                            City
                                        </label>
                                        <select name="city"
                                                 id= "cityes"
                                                class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option value="">Select your City</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="hidden" id="loading">
                                    <img src="assets/img/loading.gif" width="70"/>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- content ends here.  -->
            <?php include "layouts/footer.php"; ?>
        </div>
    </div>
</div>
<?php include "layouts/footer-scripts.php"; ?>
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
</html>
