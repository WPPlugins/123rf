  <div id="poststuff" class="metabox-holder">

    <div id="post-body">
      <div id="post-body-content" class="meta-box-sortables">

        <?php
        // show settings boxes for each module
        foreach($this->modules as $module)
        {
          $className = $module->getName();
        ?>
        <div id="mpp_box_<?php echo $className; ?>" class="mpp_postbox postbox<?php echo (isset($boxes['mpp_box_'.$className]) && $boxes['mpp_box_'.$className]?' mpp_closed closed':''); ?>">
          <div class="handlediv" title="<?php _e('Click to toggle', self::ld); ?>"><br></div>
          <h3 class="hndle">
            <img src="<?php echo $module->getIcon(); ?>" width="16" height="16" />
            <span><?php echo $module->getTitle(); ?></span>
            <?php if ($module->isNew()) { ?>
            <span style="font-size: 9px;color: #ff0000;top: -4px;position: relative;font-weight: bold;margin-left: 0px;"><?php _e('NEW', self::ld); ?></span>
            <?php } ?>
          </h3>
          <div class="inside">
            <form id="mpp_form_<?php echo $className; ?>">
            <?php
              $module->settings();
            ?>
            </form>
            <br />
            <div class="mpp_save_area">
              <span class="mpp_settings_saved"><?php _e('Settings saved.', self::ld); ?></span>
              <span class="mpp_save_loader"><img id="mpp_save_loader_<?php echo $className; ?>" src="<?php echo $this->_url; ?>/admin/images/loader.gif" width="15" height="15" /></span>
              <input class="button-primary mpp_button_save" disabled id="mpp_save_<?php echo $className; ?>" type="submit" name="save" title="<?php _e('Save', self::ld); ?>" value="<?php _e('Save', self::ld); ?>" />
            </div>

            <?php if (!class_exists('ZipArchive')) { ?>
            <br class="mpp_clear" />
            <p>
              <b><?php _e('Backup feature is not available, please install/enable ZIP extension on server.', self::ld); ?></b>
            </p>
            <?php } else { ?>
            <a href="#" onclick="return false;" class="mpp_show_backup_options"><b><?php _e('Show backup options', self::ld); ?></b></a>
            <a href="#" onclick="return false;" class="mpp_hide_backup_options" style="display: none;"><b><?php _e('Hide backup options', self::ld); ?></b></a>
            <br class="mpp_clear" />
            <div class="mpp_backup_options" style="display: none;">
              <b><?php _e('Available backups', self::ld); ?></b><br />
              <div class="mpp_backup_list">
                <?php require 'options_backup_list.php'; ?>
              </div>
              <input class="button-primary" type="button" data-module="<?php echo $module->getName(); ?>" name="mpp_download_backup" value="<?php _e('Download a new backup', self::ld); ?>" />
              <span class="mpp_download_backup_loader"><img src="<?php echo $this->_url; ?>/admin/images/loader.gif" width="15" height="15" /></span>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php
        }
        ?>

        <div id="mpp_box_settings" class="postbox<?php echo (isset($boxes['mpp_box_settings']) && $boxes['mpp_box_settings']?' mpp_closed closed':''); ?>">
          <div class="handlediv" title="<?php _e('Click to toggle', self::ld); ?>"><br></div>
          <h3 class="hndle"><span><?php _e('Settings for embed images', self::ld); ?></span></h3>
          <div class="inside">
            <form id="mpp_form_settings">
              <table class="form-table">
                <input type="hidden" name="mpp_default_language" id="mpp_default_language" value="0" />
                <input type="hidden" name="mpp_test_mode" id="mpp_test_mode" value="0" />
                <input type="hidden" name="mpp_sync_offers" id="mpp_sync_offers" value="0" />
                <input type="hidden" name="mpp_show_add_button" id="mpp_show_add_button" value="0" />

                <tr>
                  <th scope="row"><label for="mpp_image_caption"><?php _e('Image caption', self::ld); ?></label></th>
                  <td>
                    <?php $image_caption = isset($settings['mpp_image_caption'])?$settings['mpp_image_caption']:$this->default_settings['mpp_image_caption']; ?>
                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_image_caption" value="0" id="mpp_image_caption_0"<?php echo ($image_caption==0?' checked':''); ?> />
                      <label for="mpp_image_caption_0"><?php esc_html_e('Image title', self::ld); ?></label>
                    </div>

                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_image_caption" value="1" id="mpp_image_caption_1"<?php echo ($image_caption==1?' checked':''); ?> />
                      <label for="mpp_image_caption_1"><?php esc_html_e('Custom', self::ld); ?></label><br />
                      <input type="text" class="mpp_image_caption_label" size="50" name="mpp_image_caption_custom" value="<?php echo isset($settings['mpp_image_caption_custom'])?self::strip($settings['mpp_image_caption_custom']):$this->default_settings['mpp_image_caption_custom']; ?>" />
                    </div>

                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_image_caption" value="2" id="mpp_image_caption_2"<?php echo ($image_caption==2?' checked':''); ?> />
                      <label for="mpp_image_caption_2"><?php esc_html_e('Custom with copyright', self::ld); ?></label><br />
                      <input type="text" class="mpp_image_caption_label" size="50" name="mpp_image_caption_custom_copyright" value="<?php echo isset($settings['mpp_image_caption_custom_copyright'])?self::strip($settings['mpp_image_caption_custom_copyright']):$this->default_settings['mpp_image_caption_custom_copyright']; ?>" />
                    </div>

                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_image_caption" value="3" id="mpp_image_caption_3"<?php echo ($image_caption==3?' checked':''); ?> />
                      <label for="mpp_image_caption_3"><?php esc_html_e('Copyright notice (automatically generated)', self::ld); ?></label>
                    </div>

                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_image_caption" value="4" id="mpp_image_caption_4"<?php echo ($image_caption==4?' checked':''); ?> />
                      <label for="mpp_image_caption_4"><?php esc_html_e('None', self::ld); ?></label>
                    </div>
                  </td>
                </tr>

                <tr>
                  <th scope="row"><label for="mpp_alt_text"><?php _e('Image Alternative Text', self::ld); ?></label></th>
                  <td>
                    <?php $alt_text = isset($settings['mpp_alt_text'])?$settings['mpp_alt_text']:$this->default_settings['mpp_alt_text']; ?>
                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_alt_text" value="0" id="mpp_alt_text_0"<?php echo ($alt_text==0?' checked':''); ?> />
                      <label for="mpp_alt_text_0"><?php esc_html_e('Keyword(s)', self::ld); ?></label>
                    </div>
                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_alt_text" value="1" id="mpp_alt_text_1"<?php echo ($alt_text==1?' checked':''); ?> />
                      <label for="mpp_alt_text_1"><?php esc_html_e('Image Title', self::ld); ?></label>
                    </div>
                    <div class="mpp_image_caption_group">
                      <input type="radio" name="mpp_alt_text" value="2" id="mpp_alt_text_2"<?php echo ($alt_text==2?' checked':''); ?> />
                      <label for="mpp_alt_text_2"><?php esc_html_e('None', self::ld); ?></label>
                    </div>
                  </td>
                </tr>

              </table>
            </form>
            <div class="mpp_save_area">
              <span class="mpp_settings_saved"><?php _e('Settings saved.', self::ld); ?></span>
              <span class="mpp_save_loader"><img id="mpp_save_loader_settings" src="<?php echo $this->_url; ?>/admin/images/loader.gif" width="15" height="15" /></span>
              <input class="button-primary mpp_button_save" disabled id="mpp_save_settings" type="submit" name="save" title="<?php _e('Save', self::ld); ?>" value="<?php _e('Save', self::ld); ?>" />
            </div>
            <br class="clear" />
          </div>
        </div>
      </div>
    </div>
    <br class="clear">
  </div>
</div>
