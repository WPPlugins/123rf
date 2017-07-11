<div class="mpp_offer mpp_offer_detail" style="margin-bottom: 15px; display: none"><div class="mpp_offer_text">
</div><br class="mpp_clear" /></div>

<div class="mpp_detail_header">
  <b>#<?php echo $image['id']; ?> - <?php echo $image['title']; ?></b><br />
</div>
<div>
  <div class="mpp_detail_image" style="width: <?php echo $image['thumbnail_width']; ?>px">
    <img src="<?php echo $image['thumbnail_url']; ?>" width="<?php echo $image['thumbnail_width']; ?>" /><br />
    &copy; <?php echo $image['creator_name']; ?>
  </div>
  <div class="mpp_detail_licenses">
    <?php
    if (isset($image['licenses_subscription']) && $image['licenses_subscription'])
    {
    ?>
    <div class="mpp_buy_method">
      <label for="mpp_buy_credits">
        <input type="radio" id="mpp_buy_credits" checked name="mpp_buy_method" value="1" /> <?php _e('Credits', self::ld); ?>
      </label>
      <label for="mpp_buy_subscription">
        <input type="radio" id="mpp_buy_subscription" name="mpp_buy_method" value="2" /> <?php _e('Subscription', self::ld); ?>
      </label>
    </div>
    <?php
    }
    ?>
    <table cellspacing="0" cellpadding="0">
      <thead>
        <tr style="background:none; color: #000;">
          <th></th>
          <th align="left"><?php _e('Resolution', self::ld); ?></th>
          <th><?php _e('Credits', self::ld); ?></th>
        </tr>
      </thead>
      <tbody>
        <tr style="background:#d3d3d3;">
          <td colspan="4">Web Use (72 dpi)</td>
        </tr>
      <?php
      $abs1 = $abs2 = false;
      $i = 0;
      foreach($image['licenses'] as $id=>$license)
      {
        $size = "";
        if($i == 0)
          $size = "s";
        else if($i == 1)
          $size = "m";
        else if($i == 2)
          $size = "ml";
        else if($i == 3)
          $size = "l";
        else if($i == 4)
          $size = "xl";
        else if($i <= 6)
          $size = "xxl";

        if($i == 2){
          ?>
          <tr style="background:#d3d3d3;">
            <td colspan="4">Web or Print Use (300 dpi)</td>
          </tr>
          <?php
        } else if($i == 7){
          ?>
          <tr style="background:#d3d3d3;">
            <td colspan="4">Extended Licenses</td>
          </tr>
          <?php
        }
      ?>
        <tr class="mpp_license_row mpp_license_credits" id="mpp_row_<?=$license['name']; ?>">
          <td style="display:none;"><input type="radio" style="display:block;" id="mpp_license_<?php echo $id; ?>" name="mpp_license" value="<?php echo $license['name']; ?>" /></td>
          <td <?=$i != 1 && $i != 6 ? 'style="border-bottom: 1px solid #e5e5e5;"' : ''; ?> valign="middle" align="center"><?=$size == "" ? $license['name'] : '<img src="' . $this->_url . '/admin/images/sizes/sizenew_' . $size . '.gif" width="18px" />'; ?></td>
          <td <?=$i != 1 && $i != 6 ? 'style="border-bottom: 1px solid #e5e5e5;"' : ''; ?> valign="middle"><b>JPG</b> <span style="margin-left:5px;"><?php echo implode(" x ", explode("x", $license['dimensions'])); ?> px</span></td>
          <td <?=$i != 1 && $i != 6 ? 'style="border-bottom: 1px solid #e5e5e5;"' : ''; ?> valign="middle" align="center"><?php echo $license['price']; ?>
        </tr>
      <?php
      $i++;
      }
      $last_id = $id;
      ?>

      <?php
      if (isset($image['licenses_subscription']) && $image['licenses_subscription'])
      {
        foreach($image['licenses_subscription'] as $id=>$license)
        {
      ?>
        <tr class="mpp_license_row mpp_license_subscription">
          <td align="center"><input type="radio" id="mpp_license_<?php echo $last_id.'_'.$id; ?>" name="mpp_license" value="<?php echo $license['name']; ?>" /></td>
          <td><?php echo $license['title']; ?></td>
          <td><?php echo $license['dimensions']; ?></td>
          <td align="center"><?php echo $license['price']; ?> <?php $license['price'] == 1?_e('download', self::ld):_e('download', self::ld); ?>
        </tr>
      <?php
        }
      }
      ?>
      </tbody>
    </table>
    <p align="center">
      <input type="hidden" name="mpp_license_type" value="<?php echo isset($image['license_type'])?esc_attr($image['license_type']):''; ?>" />
      <input type="hidden" name="mpp_buy_id" value="<?php echo esc_attr($image['id']); ?>" />
      <input type="hidden" name="mpp_buy_title" value="<?php echo esc_attr($image['title']); ?>" />
      <input type="hidden" name="mpp_buy_author" value="<?php echo esc_attr($image['creator_name']); ?>" />
      <input type="hidden" name="mpp_image_page" value="<?php echo esc_attr($image['image_page']); ?>" />
      <input type="button" class="button-secondary mpp_orange_button" name="mpp_buy" disabled value="<?php _e('Please select license', self::ld); ?>" />
      <a href="" class="button button-secondary mpp_register" style="display: none;" target="_blank"><?php _e('Register now', self::ld); ?></a>
    </p>
    <p class="mpp_detail_error_message"></p>
    <small><center><a href="http://www.123rf.com/license.php" target="_blank">License terms/information</a></center></small>
  </div>
  <br class="mpp_clear" />
</div>