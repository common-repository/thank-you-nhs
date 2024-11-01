<?php
/* Get all of the plugin settings */
$nhs_options = get_option('thank_you_nhs_settings');

/* Menu Navigation */
$float_option = $nhs_options['float'];
if($float_option == 'nofloat') {
	$float_option = 'none';
}elseif($float_option == 'float') {
	$float_option = 'left';
}else {$float_option = 'none';}
header("Content-type: text/css; charset: UTF-8");?>
/*--------------------------------------------------------------
Thank You NHS & Key Workers
--------------------------------------------------------------*/
body {cursor:url(<?php echo esc_url( plugins_url( 'images/rainbow-cursor.png', dirname(__FILE__)));?>),auto !important}
a:hover {cursor:url(<?php echo esc_url( plugins_url( 'images/rainbow-pointer.png', dirname(__FILE__)));?>),auto !important}
.thankyounhs{float:<?php echo $float_option; ?>;width:100%;text-align:center;background:#fff;}
.thankyounhs img{max-width:100%;width:100%;display:none;}
.thankyounhs img#nhs-mob{display:block;}
@media (min-width:740px) {
  .thankyounhs img{display:block;}.thankyounhs img#nhs-mob{display:none;}
}