<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#000000"/>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />

    <link rel="stylesheet" href="app.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

    <title><?php if (isset($title)) {
            echo $title;
        }
        echo " | " . $setting_site_title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="node_modules/tinymce/tinymce.min.js"></script>
    <script src="node_modules/@tinymce/tinymce-jquery/dist/tinymce-jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css">

    <script type="text/javascript" charset="utf8"
            src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
</head>