<?php // Plugin Settings Page
if(!is_admin())
	return;
?>

<div class="wrap">
  <?php echo "<h2><span class='dashicons dashicons-admin-generic'></span> ". __( 'Thank You NHS Banner Settings', 'mytextdomain' ) . "</h2>"; ?>
  <p>Please donate to Success Local's <a href="https://www.justgiving.com/fundraising/sl-plugin-donation" target="_blank">Just Giving page</a> raising money for NHS Charities Together.</p>
  <form method="post" action="options.php">
    <div class="metabox-holder">
      <div class="postbox" style="padding-left:20px;">
        <div class="tool-box">
          <p>Additional settings to help the banner sit correctly on your website.</p>
          <?php
             settings_fields( 'thank_you_nhs_options' );
             //do_settings_sections('thank_you_nhs_options');
          ?>
          <?php $options = get_option( 'thank_you_nhs_settings' );
          $tosanitise = $options['customclass'];
          $sanitisedclass = sanitize_text_field($tosanitise);
          //var_dump($tosanitise);
          //var_dump($sanitisedclass);
          ?> 
          <table class="form-table">
            <tr valign="top">
              <th scope="row"><?php _e( 'Banner Float', 'mytextdomain' ); ?></th>
              <td>
                <input id="bannernofloat" type="radio" name="thank_you_nhs_settings[float]" value="nofloat" checked<?php checked('nofloat', $options['float']); ?> />
                <label for="bannernofloat">No Float Banner</label>
                <br/>
                <br/>
                <input id="bannerfloat" type="radio" name="thank_you_nhs_settings[float]" value="float" <?php checked('float', $options['float']); ?> />
                <label for="bannerfloat">Float Banner</label>
              </td>
           </tr>
           <tr valign="top">
              <th scope="row"><?php _e( 'Banner Position', 'mytextdomain' ); ?></th>
              <td>
                <input id="bannerabove" type="radio" name="thank_you_nhs_settings[position]" value="abovefooter" checked<?php checked('abovefooter', $options['position']); ?> />
                <label for="bannerabove">Above Footer</label>
                <br/>
                <br/>
                <input id="bannerbelow" type="radio" name="thank_you_nhs_settings[position]" value="belowfooter" <?php checked('belowfooter', $options['position']); ?>/>
                <label for="bannerbelow">Below Footer</label>
              </td>
            </tr>
            <tr valign="top">
              <th scope="row"><?php _e( 'Target Custom Class or ID (HTML Footer by Default)', 'mytextdomain' ); ?></th>
              <td>
                <input id="customclass" type="text" name="thank_you_nhs_settings[customclass]" maxlength="15" placeholder="e.g. .myclass or #myid" value="<?php echo stripslashes_deep(esc_attr($sanitisedclass)); ?>" /> Character Limit: <span id="wordCount">0</span> / 15
                <script>
                  function word_count_check() {
                    var myText = document.getElementById("customclass");
                    var wordCount = document.getElementById("wordCount");
                    var characters = myText.value.split('');
                    wordCount.innerText = characters.length;

                    if(characters.length > 15){
                        myText.value = myText.value.substring(0,15);
                        wordCount.innerText = 15;
                    }
                  };

                  jQuery(document).ready(function() {
                    word_count_check();
                  });

                  jQuery('input').keyup(function (e){
                    word_count_check();
                  });
                </script>
              </td>
            </tr>
          </table> 
        </div> <!-- tool-box -->
        <div id="save-action">
          <?php submit_button('Save all customised settings'); ?>
        </div><!-- save-action -->
      </div><!-- postbox -->
    </div><!-- metabox-holder -->
  </form>
  <a href="https://www.justgiving.com/fundraising/sl-plugin-donation" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ );?>images/thank-you-admin-banner.svg" alt="Thank you NHS from Success Local Limited" style="width:100%;"/></a>
 </div><!-- wrap -->