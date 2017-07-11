<?php
// handle login state
$loginClass = '';
if (isset($settings['checkLogin']))
  if ($settings['checkLogin'])
    $loginClass = ' mpp_login_correct';
  else
    $loginClass = ' mpp_login_incorrect';
?>

<table class="form-table">
  <input type="hidden" name="mpp_enabled" value="1" id="<?php $this->fieldID('mpp_enabled'); ?>">
  <tr>
    <th scope="row"><label for="<?php $this->fieldID('mpp_login'); ?>">Customer id</label></th>
    <td>
      <input class="<?php echo $loginClass; ?>" id="<?php $this->fieldID('mpp_cusid'); ?>" size="50" maxlength="255" type="text" name="mpp_cusid" value="<?php echo esc_attr((isset($settings['mpp_cusid'])?$settings['mpp_cusid']:'')); ?>" />
    </td>
  </tr>

  <tr>
    <th scope="row"><label for="<?php $this->fieldID('mpp_login'); ?>">Commercial key</label></th>
    <td>
      <input class="<?php echo $loginClass; ?>" id="<?php $this->fieldID('mpp_comkey'); ?>" size="50" maxlength="255" type="text" name="mpp_comkey" value="<?php echo esc_attr((isset($settings['mpp_comkey'])?$settings['mpp_comkey']:'')); ?>" />
    </td>
  </tr>

  <tr>
    <th scope="row"><label for="<?php $this->fieldID('mpp_login'); ?>">Access key</label></th>
    <td>
      <input class="<?php echo $loginClass; ?>" id="<?php $this->fieldID('mpp_acckey'); ?>" size="50" maxlength="255" type="text" name="mpp_acckey" value="<?php echo esc_attr((isset($settings['mpp_acckey'])?$settings['mpp_acckey']:'')); ?>" />
    </td>
  </tr>

  <tr>
    <th scope="row"><label for="<?php $this->fieldID('mpp_password'); ?>">Secret key</label></th>
    <td>
      <input class="<?php echo $loginClass; ?>" id="<?php $this->fieldID('mpp_password'); ?>" size="50" maxlength="255" type="text" name="mpp_password" value="<?php echo esc_attr((isset($settings['mpp_password'])?$settings['mpp_password']:'')); ?>" />
    </td>
  </tr>

  <tr class="mpp_offer_signup<?php echo ($data?' mpp_hidden':''); ?>">
    <th scope="row"></th>
    <td><a href="<?php echo $this->getRegisterLink(); ?>" target="_blank"><?php _e("Don't have an account? Register now!", self::ld); ?></a></td>
  </tr>

  <tr>
    <th scope="row"></th>
    <td class="mpp_login_info<?php echo ($data?'':' mpp_hidden'); ?>">
      <div class="mpp_login_info_text">
      <?php
      if ($data)
        require_once $this->_path.'/admin/login_data.php';
      ?>
      </div>
      <input type="button" class="button-secondary mpp_logout_button" name="mpp_logout_button" value="<?php _e('Logout', self::ld); ?>" />
    </td>
  </tr>
</table>
