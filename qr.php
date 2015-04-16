<?php
$permalink = get_the_permalink();
$printer = New Recipe_Print();
$printer->printQRCode( $permalink );