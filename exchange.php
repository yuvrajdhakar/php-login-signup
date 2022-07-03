<?php
session_start();

include "utils/check-login.php";

$title = "Get exchange rate";

include "db-connection.php";


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
                                Get exchange rate
                            </h6>
                        </div>
                    </div>
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">

                        <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                            Settings
                        </h6>
                        <div class="flex flex-wrap">
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                           htmlfor="site_title">
                                        From Currency
                                    </label>
                                    <select
                                            name="from"
                                            id="from"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    >
                                        <option value="INR">INR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="USD">USD</option>
                                        <option value="AUD">AUD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                           htmlfor="site_title">
                                        To Currency
                                    </label>
                                    <select
                                            name="to"
                                            id="to"
                                            class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    >
                                        <option value="INR">INR</option>
                                        <option value="GBP">GBP</option>
                                        <option value="USD">USD</option>
                                        <option value="AUD">AUD</option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                           htmlfor="site_title">
                                        Amount
                                    </label>
                                    <input type="number"
                                           name="amount"
                                           id="amount"
                                           class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    >
                                </div>
                            </div>

                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2"
                                           htmlfor="site_title">
                                        Result: <span id="result_title"></span>
                                    </label>
                                    <input type="number"
                                           name="result"
                                           id="result"
                                           readonly
                                           placeholder="Input your data and click on fetch button"
                                           class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="hidden" id="loading">
                            <img src="assets/img/loading.gif" width="70"/>
                        </div>
                        <button
                                onclick="getExchangeRate()"
                                class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                type="button">
                            Fetch
                        </button>

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
    function getExchangeRate() {

        let from = $('#from').val();
        let to = $('#to').val();
        let amount = $('#amount').val();

        $.ajax({
            url: "exchange-ajax.php",
          //  url: "https://api.apilayer.com/exchangerates_data/convert?from="+from+"&to="+to+"&amount="+amount,
          //   headers:{
          //       "apikey":"7D11GNCS0rQPQplrept4qgwE1NvUZ1k0"
          //   },
            method:"POST",
            data: JSON.stringify({ from: from, to:to, amount:amount }),
           contentType: "application/json; charset=utf-8",
            timeout: 5000,
            beforeSend: function (xhr) {
                $("#loading").show();
            }
        }).done(function (response) {

            $("#loading").hide();
            response = JSON.parse(response);
            if (response.success) {

                let data = response.data;

                $("#result_title").html(data.result_title);
                $("#result").val(data.result);

            } else {
                console.log("no result found.");
                alert(response.message);
            }

        });
    }
</script>
</body>
</html>
