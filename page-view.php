<?php
// Start the session
session_start();

include "db-connection.php";

$slug = $_GET['slug'];

if (!empty($slug)) {
    $result = $conn->query("Select * from pages where slug='$slug' and status='published'");
//&& $result->num_rows == 1
    if ($result) {
        $page = $result->fetch_assoc();
        if ($page) {
            $page_id = $page['ID'];

            if (!empty($_POST['content'])) {
                //insert a comment

                $content = $_POST['content'];
                $user = 'Guest';

                if ($_SESSION['user_id']) {
                    $user = $_SESSION['user_id'];
                }

                $parent_id = null;

                if(!empty($_POST['parent_id'])){
                    $parent_id = $_POST['parent_id'];
                }

                $result_comment = $conn->prepare("INSERT INTO comments (content, user, page_id, parent_id) values(?, ?,?, ?);");

                $result_comment->bind_param("ssii", $content, $user, $page_id, $parent_id);
                $result_comment->execute();
            }

            $comments = $conn->query("Select * from comments where parent_id is null and  page_id=$page_id");


            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    .async-hide {
                        opacity: 0 !important;
                    }
                </style>
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <meta name="theme-color" content="#000000"/>
                <link rel="stylesheet"
                      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
                <link rel="stylesheet" href="app.css"/>
                <title><?php echo $page['title']; ?> - Sky e-Solutions</title>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                <script>
                    function hideTheForm(id){
                        $("#reply_form_" + id).hide();
                    }

                    function showTheForm(id){
                        $("#reply_form_" + id).show();
                    }
                </script>
            </head>
            <body class="text-blueGray-700 antialiased">
            <nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg">
                <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                    <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                        <a class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase text-white"
                           href="front.php">Sky e-Solutions</a
                        >
                        <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                                type="button" onclick="toggleNavbar('example-collapse-navbar')">
                            <i class="text-white fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="lg:flex flex-grow items-center bg-white lg:bg-opacity-0 lg:shadow-none hidden"
                         id="example-collapse-navbar">
                        <ul class="flex flex-col lg:flex-row list-none mr-auto">
                            <li class="flex items-center">
                                <a class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                                   href="blog.php"><i
                                            class="lg:text-blueGray-200 text-blueGray-400 far fa-file-alt text-lg leading-lg mr-2"></i>
                                    Blog</a
                                >
                            </li>
                        </ul>
                        <ul class="flex flex-col lg:flex-row list-none lg:ml-auto items-center">
                            <li class="inline-block relative">
                                <a class="lg:text-white lg:hover:text-blueGray-200 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
                                   href="#pablo" onclick="openDropdown(event,'demo-pages-dropdown')">
                                    Demo Pages
                                </a>
                                <div class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                                     id="demo-pages-dropdown">
<span class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400">
Admin Layout
</span>
                                    <a href="./admin/dashboard.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Dashboard
                                    </a>
                                    <a href="./admin/settings.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Settings
                                    </a>
                                    <a href="./admin/tables.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Tables
                                    </a>
                                    <a href="./admin/maps.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Maps
                                    </a>
                                    <div class="h-0 mx-4 my-2 border border-solid border-blueGray-100"></div>
                                    <span class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400">
Auth Layout
</span>
                                    <a href="./auth/login.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Login
                                    </a>
                                    <a href="./auth/register.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Register
                                    </a>
                                    <div class="h-0 mx-4 my-2 border border-solid border-blueGray-100"></div>
                                    <span class="text-sm pt-2 pb-0 px-4 font-bold block w-full whitespace-nowrap bg-transparent text-blueGray-400">
No Layout
</span>
                                    <a href="./landing.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Landing
                                    </a>
                                    <a href="./profile.html"
                                       class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
                                        Profile
                                    </a>
                                </div>
                            </li>

                            <li class="flex items-center">
                                <a class="bg-white text-blueGray-700 active:bg-blueGray-50 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
                                   href="index.php">
                                    <i class="fas fa-arrow-alt-circle-down"></i> Login
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main>
                <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
                    <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1267&amp;q=80');
          ">
                        <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
                    </div>
                    <div class="container relative mx-auto">
                        <div class="items-center flex flex-wrap">
                            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                                <div class="pr-12">
                                    <h1 class="text-white font-semibold text-5xl">
                                        <?php echo $page['title']; ?>
                                    </h1>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px"
                         style="transform: translateZ(0px)">
                        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                             preserveAspectRatio="none"
                             version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                            <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </div>

                <section class="relative py-20">
                    <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
                         style="transform: translateZ(0px)">
                        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                             preserveAspectRatio="none"
                             version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                            <polygon class="text-white fill-current" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                    <div class="container mx-auto px-4">

                        <?php

                        if ($page['image_path']) {
                            ?>
                            <img src="<?php echo $page['image_path']; ?>">

                            <?php
                        }
                        echo html_entity_decode($page['content']);

                        ?>

                        <div class="pt-4">

                            <div>
                                <div class="flex items-center justify-center bg-gray-100">
                                    <div class="flex h-auto w-full flex-col space-y-2 bg-white px-3 py-2 shadow">
                                        <?php
                                        while ($row_comment = $comments->fetch_assoc()) {
                                            ?>
                                            <div class="flex items-center space-x-2">
                                                <div class="group relative flex flex-shrink-0 cursor-pointer self-start">
                                                    <img src="https://images.unsplash.com/photo-1507965613665-5fbb4cbb8399?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDQzfHRvd0paRnNrcEdnfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                                                         alt="" class="h-8 w-8 rounded-full object-fill"/>
                                                </div>

                                                <div class="flex items-center justify-center space-x-2">
                                                    <div class="block">
                                                        <div class="flex  space-x-2">
                                                            <div class="w-auto rounded-xl bg-gray-100 px-2 pb-2">
                                                                <div class="font-medium">
                                                                    <a href="#" class="text-sm hover:underline">
                                                                        <small><?php echo $row_comment['user']; ?></small>
                                                                    </a>
                                                                </div>
                                                                <div class="text-xs">  <?php echo $row_comment['content']; ?></div>
                                                            </div>
                                                            <div class="flex transform items-center justify-center self-stretch opacity-0 transition-opacity duration-200 hover:opacity-100">
                                                                <a href="#" class="">
                                                                    <div class="flex h-6 w-6 transform cursor-pointer items-center justify-center rounded-full text-xs transition-colors duration-200 hover:bg-gray-100">
                                                                        <svg class="h-6 w-4" fill="none"
                                                                             stroke="currentColor" viewBox="0 0 24 24"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                                                        </svg>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="flex w-full items-center justify-start text-xs">
                                                            <div class="flex items-center justify-center space-x-1 px-2 font-semibold text-gray-700">
                                                                <a href="#" class="hover:underline">
                                                                    <small>Like (<?php echo $row_comment['likes'];?>)</small>
                                                                </a>
                                                                <small class="self-center">.</small>
                                                                <a class="hover:underline reply_click_class" id="reply_click_<?php echo $row_comment['id'];?>" onclick="showTheForm(<?php echo $row_comment['id'];?>)">
                                                                    <small>Reply</small>
                                                                </a>
                                                                <small class="self-center">.</small>
                                                                <a href="#" class="hover:underline">
                                                                    <small><?php echo $row_comment['created_at']; ?></small>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <!-- Subcomment Sample -->
                                                        <?php

                                                        $resultReplyComments = $conn->query("Select * from comments where parent_id=".$row_comment['id']);
                                                        while ($row_reply_comment = $resultReplyComments->fetch_assoc()) {

                                                        ?>
                                                        <div class="flex items-center space-x-2 space-y-2">
                                                            <div class="group relative flex flex-shrink-0 cursor-pointer self-start pt-2">
                                                                <img src="https://images.unsplash.com/photo-1610156830615-2eb9732de349?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDExfHJuU0tESHd3WVVrfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                                                                     alt="" class="h-8 w-8 rounded-full object-fill"/>
                                                            </div>

                                                            <div class="flex items-center justify-center space-x-2">
                                                                <div class="block">
                                                                    <div class="w-auto rounded-xl bg-gray-100 px-2 pb-2">
                                                                        <div class="font-medium">
                                                                            <a href="#" class="text-sm hover:underline">
                                                                                <small><?php echo $row_reply_comment['user'];?> </small>
                                                                            </a>
                                                                        </div>
                                                                        <div class="text-xs"><?php echo $row_reply_comment['content'];?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex w-full items-center justify-start text-xs">
                                                                        <div class="flex items-center justify-center space-x-1 px-2 font-semibold text-gray-700">
                                                                            <a href="#" class="hover:underline">
                                                                                <small>Like</small>
                                                                            </a>
                                                                            <small class="self-center">.</small>
                                                                            <a href="#" class="hover:underline">
                                                                                <small>Reply</small>
                                                                            </a>
                                                                            <small class="self-center">.</small>
                                                                            <a href="#" class="hover:underline">
                                                                                <small><?php echo $row_reply_comment['created_at'];?></small>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="translate flex -translate-y-2 transform items-center justify-center self-stretch opacity-0 transition-opacity duration-200 hover:opacity-100">
                                                                <a href="#" class="">
                                                                    <div class="flex h-6 w-6 transform cursor-pointer items-center justify-center rounded-full text-xs transition-colors duration-200 hover:bg-gray-100">
                                                                        <svg class="h-6 w-4" fill="none"
                                                                             stroke="currentColor" viewBox="0 0 24 24"
                                                                             xmlns="http://www.w3.org/2000/svg">
                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                                                        </svg>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <!-- New Subcomment Paste Here !! -->
                                                        <?php } ?>
                                                        <div class="hidden" id="reply_form_<?php echo $row_comment['id']; ?>">
                                                            <form method="post" class="w-full p-4">
                                                                <input type="hidden" name="parent_id" value="<?php echo $row_comment['id']; ?>" />
                                                                <label class="mb-2 block">
                                                                    <textarea name="content"
                                                                              placeholder="Leave your reply comment"
                                                                              required="required"
                                                                              class="mt-1 block w-full rounded"
                                                                              rows="3"></textarea>
                                                                </label>
                                                                <button type="submit"
                                                                        class="rounded bg-blue-600 px-3 py-2 text-sm text-blue-100">
                                                                    Reply Comment
                                                                </button>
                                                                <button type="button" onclick="hideTheForm(<?php echo $row_comment['id']; ?>)"
                                                                        class="rounded bg-red-600 px-3 py-2 text-sm text-blue-100">
                                                                   Cancel
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- New Comment Paste Here -->

                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <br/>
                            <!-- <form method="post">
                                 <textarea name="content" placeholder="Leave your comment" required="required"></textarea>
                                 <button type="submit" class="px-2 py-1 text-white bg-green-500 rounded shadow-xl">submit
                                 </button>
                             </form>-->
                            <form method="post" class="w-full p-4">
                                <label class="mb-2 block">
                                    <span class="text-gray-600">Add a comment</span>
                                    <textarea name="content" placeholder="Leave your comment" required="required"
                                              class="mt-1 block w-full rounded" rows="3"></textarea>
                                </label>
                                <button type="submit" class="rounded bg-blue-600 px-3 py-2 text-sm text-blue-100">
                                    Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </section>


            </main>
            <footer class="relative bg-blueGray-200 pt-8 pb-6">
                <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20 h-20"
                     style="transform: translateZ(0px)">
                    <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                         preserveAspectRatio="none"
                         version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap text-center lg:text-left">
                        <div class="w-full lg:w-6/12 px-4">
                            <h4 class="text-3xl font-semibold">Let's keep in touch!</h4>
                            <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
                                Find us on any of these platforms, we respond 1-2 business days.
                            </h5>
                            <div class="mt-6 lg:mb-0 mb-6">
                                <button class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                        type="button">
                                    <i class="fab fa-twitter"></i></button
                                >
                                <button class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                        type="button">
                                    <i class="fab fa-facebook-square"></i></button
                                >
                                <button class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                        type="button">
                                    <i class="fab fa-dribbble"></i></button
                                >
                                <button class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                                        type="button">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="flex flex-wrap items-top mb-6">
                                <div class="w-full lg:w-4/12 px-4 ml-auto">
<span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Useful Links</span
>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://www.creative-tim.com/presentation?ref=njs-landing">About
                                                Us</a
                                            >
                                        </li>
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://blog.creative-tim.com?ref=njs-landing">Blog</a
                                            >
                                        </li>
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://www.github.com/creativetimofficial?ref=njs-landing">Github</a
                                            >
                                        </li>
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://www.creative-tim.com/bootstrap-themes/free?ref=njs-landing">Free
                                                Products</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                                <div class="w-full lg:w-4/12 px-4">
<span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Other Resources</span
>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-landing">MIT
                                                License</a
                                            >
                                        </li>
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://creative-tim.com/terms?ref=njs-landing">Terms &amp;
                                                Conditions</a
                                            >
                                        </li>
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://creative-tim.com/privacy?ref=njs-landing">Privacy Policy</a
                                            >
                                        </li>
                                        <li>
                                            <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                               href="https://creative-tim.com/contact-us?ref=njs-landing">Contact Us</a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-6 border-blueGray-300"/>
                    <div class="flex flex-wrap items-center md:justify-between justify-center">
                        <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                            <div class="text-sm text-blueGray-500 font-semibold py-1">
                                Copyright © <span id="get-current-year"></span> Notus JS by
                                <a href="https://www.creative-tim.com?ref=njs-landing"
                                   class="text-blueGray-500 hover:text-blueGray-800">Creative Tim</a
                                >.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            </body>
            <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
            <script>
                // (function () {
                //     $(".reply_click_class").on("click", function () {
                //         $("#" + this.id.replace("reply_click_", "reply_form_")).show();
                //     });
                //
                // })();
            </script>
            <script>
                /* Make dynamic date appear */
                (function () {
                    if (document.getElementById("get-current-year")) {
                        document.getElementById(
                            "get-current-year"
                        ).innerHTML = new Date().getFullYear();
                    }
                })();

                /* Function for opning navbar on mobile */
                function toggleNavbar(collapseID) {
                    document.getElementById(collapseID).classList.toggle("hidden");
                    document.getElementById(collapseID).classList.toggle("block");
                }

                /* Function for dropdowns */
                function openDropdown(event, dropdownID) {
                    let element = event.target;
                    while (element.nodeName !== "A") {
                        element = element.parentNode;
                    }
                    Popper.createPopper(element, document.getElementById(dropdownID), {
                        placement: "bottom-start",
                    });
                    document.getElementById(dropdownID).classList.toggle("hidden");
                    document.getElementById(dropdownID).classList.toggle("block");
                }
            </script>
            </html>
            <?php
        } else {
            header("Location: 404.php");
            die();
        }
    } else {
        header("Location: 404.php");
        die();
    }
} else {
    header("Location: 404.php");
    die();
}
?>