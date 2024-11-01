<?php
/* Get all of the plugin settings */
$nhs_options = get_option('thank_you_nhs_settings');
$tosanitise = $nhs_options['customclass'];
$sanitisedclass = sanitize_text_field($tosanitise);

/* Banner Positions */
$position_option = $nhs_options['position'];
if($position_option == 'abovefooter') {
	$position_option = 'before';
}elseif($position_option == 'belowfooter') {
	$position_option = 'after';
}else{
  $position_option = 'before';
}
header("Content-type: text/javascript; charset: UTF-8");?>
jQuery(document).ready(function() {
	jQuery("<?php if($tosanitise) {
  //echo $tosanitise;
  echo stripslashes_deep(esc_attr($sanitisedclass));
}elseif(!$tosanitise) {
  echo 'footer';
}?>").last().<?php echo $position_option; ?>('<div class="thankyounhs"><img src="<?php echo esc_url( plugins_url( 'images/thankyounhs-mobile.svg', dirname(__FILE__)));?>" id="nhs-mob"/><img src="<?php echo esc_url( plugins_url( 'images/thankyounhs-desktop.svg', dirname(__FILE__)));?>" id="nhs-desktop"/></div>');
});