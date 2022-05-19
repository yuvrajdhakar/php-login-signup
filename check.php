<?php

if($_SERVER['REQUEST_SCHEME'] == 'https'){
    echo "welcome";
}else{
    echo "You not allowed to open this page with http";
}