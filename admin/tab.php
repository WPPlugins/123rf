<?php
add_thickbox();
?>
<div id="mpp_license_dialog" style="display: none;">
  <div class="mpp_license_text">
  </div>
  <div class="mpp_license_buttons">
    <input type="button" name="mpp_license_accept" class="button-primary mpp_license_button" value="<?php _e('Accept', self::ld); ?>" />
    <input type="button" name="mpp_license_reject" class="button-secondary mpp_license_button" value="<?php _e('Reject', self::ld); ?>" />
  </div>
</div>

<div class="mpp_ui_search">
  <div>
    <div class="mpp_search_form">
      <input type="hidden" name="mpp_search_input_copy" value="" />
      <input type="text" placeholder="<?php esc_attr_e('Search for Photos, Vectors and Illustrations at', self::ld); ?> <?php echo $module->getTitle(); ?>" class="mpp_search_input" name="mpp_search_input" value="" />
      <input type="button" name="mpp_search_button" class="button-primary mpp_search_button" value="<?php _e('Search', self::ld); ?>" /> <input type="button" name="mpp_filter_button" class="button-secondary" value="<?php _e('Show filters', self::ld); ?>" />

      <div id="mpp_filters" style="display: none;">

        <div style="float:left;">
          <?php
          $sorts = $module->getSortOptions();
          if ($sorts)
          {
          ?>
            <label for="mpp_sort"><?php _e('Sort by', self::ld); ?></label>
            <select name="mpp_sort" id="mpp_sort">
              <?php
              foreach($sorts as $id=>$sort)
                echo '<option value="'.$id.'">'.$sort.'</option>';
              ?>
            </select>
          <?php
          }
          ?>

          <label for="mpp_type"><?php _e('Media type', self::ld); ?></label>
          <select name="mpp_type" id="mpp_type">
            <option value="all">All</option>
            <option value="0">Photographies</option>
            <option value="1">Illustrations</option>
            <option value="4">Editorials</option>
          </select>

          <label for="mpp_orientation"><?php _e('Orientation', self::ld); ?></label>
          <select name="mpp_orientation" id="mpp_orientation">
            <option value="all">All</option>
            <option value="horizontal">Horizontal</option>
            <option value="vertical">Vertical</option>
            <option value="square">Square</option>
          </select>

          <label for="mpp_models"><?php _e('Models', self::ld); ?></label>
          <select name="mpp_models" id="mpp_models">
            <option value="all">All</option>
            <option value="without_people">Without people</option>
            <option value="caucasian">Caucasian</option>
            <option value="african_american">African-American</option>
            <option value="asian">Asian</option>
            <option value="hispanic">Hispanic</option>
          </select>

          <label for="mpp_language"><?php _e('Language', self::ld); ?></label>
          <select name="mpp_language" id="mpp_language">
            <option value="en">English</option>
            <option value="fr">French</option>
            <option value="de">German</option>
            <option value="it">Italian</option>
            <option value="es">Spanish</option>
            <option value="jp">Japanese</option>
            <option value="ru">Russian</option>
          </select>

          <label for="mpp_people"><?php _e('Peoples', self::ld); ?></label>
          <select name="mpp_people" id="mpp_people">
            <option value="0">Any</option>
            <option value="1">Nobody</option>
            <option value="2">2 people</option>
            <option value="3">3 people</option>
            <option value="4">4 people or more</option>
          </select>

          <label for="mpp_age"><?php _e('Peoples age', self::ld); ?></label>
          <select name="mpp_age" id="mpp_age">
            <option value="0">Any</option>
            <option value="1">Babies</option>
            <option value="2">Children</option>
            <option value="3">Teenagers</option>
            <option value="4">Adults</option>
            <option value="5">Seniors</option>
          </select>

          <label for="mpp_gender"><?php _e('Peoples gender', self::ld); ?></label>
          <select name="mpp_gender" id="mpp_gender">
            <option value="0">Any</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
          </select>

          <label for="mpp_category"><?php _e('Category', self::ld); ?></label>
          <select name="mpp_category" id="mpp_category">
            <option value="all">All</option>
            <option value="1">Animals & Pets</option>
            <option value="2">Arts & Architecture</option>
            <option value="3">Celebrations & Holidays</option>
            <option value="4">Babies & Kids</option>
            <option value="5">Background & Graphics</option>
            <option value="6">Business - Man</option>
            <option value="7">Business - Woman</option>
            <option value="8">Concepts & Stills</option>
            <option value="9">Couples & Families</option>
            <option value="10">Fruits, Food & Drinks</option>
            <option value="11">Beauty</option>
            <option value="12">Illustrations</option>
            <option value="13">Seniors</option>
            <option value="14">Nature</option>
            <option value="15">People - Lifestyle</option>
            <option value="16">Science & Technology</option>
            <option value="17">Sports & Leisure</option>
            <option value="18">Transportation & Industry</option>
            <option value="19">Landscapes & Travel</option>
            <option value="20">Health & Medical</option>
            <option value="21">Education</option>
            <option value="22">Teenagers</option>
            <option value="23">Weddings & Matrimony</option>
            <option value="24">Feelings & Emotions</option>
            <option value="25">Fitness & Wellness</option>
            <option value="26">Home Improvement</option>
            <option value="27">Pregnancy & Maternity</option>
            <option value="28">Dating & Romance</option>
            <option value="29">Mobile & Telecommunications</option>
            <option value="30">Objects & Ornament</option>
            <option value="31">Business - Concept</option>
            <option value="32">Business - People</option>
          </select>

          <?php
          $filters = $module->getSearchFilters();
          if ($filters)
          {
          ?>
            <?php
            $c = 0;
            foreach($filters as $id=>$filter)
            {          
            ?>
              <label for="mpp_search_filter_<?php echo $id; ?>"><input class="mpp_search_filter_checkbox" value="<?php echo $id; ?>" type="checkbox"<?php echo $c==0?' checked':''; ?> name="mpp_search_filter_<?php echo $id; ?>" id="mpp_search_filter_<?php echo $id; ?>" /> <?php echo $filter; ?></label>
            <?php
              $c++;
            }
            ?>
          <?php
          }
          ?>
        </div>
        <div class="button-holder" style="margin-top:5px;">
          <input type="radio" id="color-0" name="color" style="display:none;" class="regular-radio" value="" checked /><label for="color-0" style="background-color: white;"></label>
          <input type="radio" id="color-1" name="color" style="display:none;" class="regular-radio" value="0" /><label for="color-1" style="background-color: #000000;"></label>
          <input type="radio" id="color-2" name="color" style="display:none;" class="regular-radio" value="1" /><label for="color-2" style="background-color: #996100;"></label>
          <input type="radio" id="color-3" name="color" style="display:none;" class="regular-radio" value="2" /><label for="color-3" style="background-color: #636300;"></label>
          <input type="radio" id="color-4" name="color" style="display:none;" class="regular-radio" value="3" /><label for="color-4" style="background-color: #006300;"></label>
          <input type="radio" id="color-5" name="color" style="display:none;" class="regular-radio" value="4" /><label for="color-5" style="background-color: #006366;"></label>
          <input type="radio" id="color-6" name="color" style="display:none;" class="regular-radio" value="5" /><label for="color-6" style="background-color: #000080;"></label>
          <input type="radio" id="color-7" name="color" style="display:none;" class="regular-radio" value="6" /><label for="color-7" style="background-color: #639399;"></label>
          <input type="radio" id="color-8" name="color" style="display:none;" class="regular-radio" value="7" /><label for="color-8" style="background-color: #636363;"></label>
          <input type="radio" id="color-9" name="color" style="display:none;" class="regular-radio" value="8" /><label for="color-9" style="background-color: #800000;"></label>
          <input type="radio" id="color-10" name="color" style="display:none;" class="regular-radio" value="9" /><label for="color-10" style="background-color: #FF6600;"></label>
          <input type="radio" id="color-11" name="color" style="display:none;" class="regular-radio" value="10" /><label for="color-11" style="background-color: #808000;"></label>
          <input type="radio" id="color-12" name="color" style="display:none;" class="regular-radio" value="11" /><label for="color-12" style="background-color: #8000FF;"></label>
          <input type="radio" id="color-13" name="color" style="display:none;" class="regular-radio" value="12" /><label for="color-13" style="background-color: #008080;"></label>
          <input type="radio" id="color-14" name="color" style="display:none;" class="regular-radio" value="13" /><label for="color-14" style="background-color: #0000FF;"></label>
          <input type="radio" id="color-15" name="color" style="display:none;" class="regular-radio" value="14" /><label for="color-15" style="background-color: #666699;"></label>
          <input type="radio" id="color-16" name="color" style="display:none;" class="regular-radio" value="15" /><label for="color-16" style="background-color: #808080;"></label>
          <input type="radio" id="color-17" name="color" style="display:none;" class="regular-radio" value="16" /><label for="color-17" style="background-color: #FF0000;"></label>
          <input type="radio" id="color-18" name="color" style="display:none;" class="regular-radio" value="17" /><label for="color-18" style="background-color: #FF9900;"></label>
          <input type="radio" id="color-19" name="color" style="display:none;" class="regular-radio" value="18" /><label for="color-19" style="background-color: #99CC00;"></label>
          <input type="radio" id="color-20" name="color" style="display:none;" class="regular-radio" value="19" /><label for="color-20" style="background-color: #639966;"></label>
          <input type="radio" id="color-21" name="color" style="display:none;" class="regular-radio" value="20" /><label for="color-21" style="background-color: #63CCCC;"></label>
          <input type="radio" id="color-22" name="color" style="display:none;" class="regular-radio" value="21" /><label for="color-22" style="background-color: #6366FF;"></label>
          <input type="radio" id="color-23" name="color" style="display:none;" class="regular-radio" value="22" /><label for="color-23" style="background-color: #800080;"></label>
          <input type="radio" id="color-24" name="color" style="display:none;" class="regular-radio" value="23" /><label for="color-24" style="background-color: #999999;"></label>
          <input type="radio" id="color-25" name="color" style="display:none;" class="regular-radio" value="24" /><label for="color-25" style="background-color: #FF00FF;"></label>
          <input type="radio" id="color-26" name="color" style="display:none;" class="regular-radio" value="25" /><label for="color-26" style="background-color: #FFCC00;"></label>
          <input type="radio" id="color-27" name="color" style="display:none;" class="regular-radio" value="26" /><label for="color-27" style="background-color: #FFFF00;"></label>
          <input type="radio" id="color-28" name="color" style="display:none;" class="regular-radio" value="27" /><label for="color-28" style="background-color: #00FF00;"></label>
          <input type="radio" id="color-29" name="color" style="display:none;" class="regular-radio" value="28" /><label for="color-29" style="background-color: #00FFFF;"></label>
          <input type="radio" id="color-30" name="color" style="display:none;" class="regular-radio" value="29" /><label for="color-30" style="background-color: #00CCFF;"></label>
          <input type="radio" id="color-31" name="color" style="display:none;" class="regular-radio" value="30" /><label for="color-31" style="background-color: #996366;"></label>
          <input type="radio" id="color-32" name="color" style="display:none;" class="regular-radio" value="31" /><label for="color-32" style="background-color: #C0C0C0;"></label>
          <input type="radio" id="color-33" name="color" style="display:none;" class="regular-radio" value="32" /><label for="color-33" style="background-color: #FF99CC;"></label>
          <input type="radio" id="color-34" name="color" style="display:none;" class="regular-radio" value="33" /><label for="color-34" style="background-color: #FFCC99;"></label>
          <input type="radio" id="color-35" name="color" style="display:none;" class="regular-radio" value="34" /><label for="color-35" style="background-color: #FFFF99;"></label>
          <input type="radio" id="color-36" name="color" style="display:none;" class="regular-radio" value="35" /><label for="color-36" style="background-color: #CCFFCC;"></label>
          <input type="radio" id="color-37" name="color" style="display:none;" class="regular-radio" value="36" /><label for="color-37" style="background-color: #CCFFFF;"></label>
          <input type="radio" id="color-38" name="color" style="display:none;" class="regular-radio" value="37" /><label for="color-38" style="background-color: #99CCFF;"></label>
          <input type="radio" id="color-39" name="color" style="display:none;" class="regular-radio" value="38" /><label for="color-39" style="background-color: #CC99FF;"></label>
        </div>
        <br class="mpp_clear" /><br class="mpp_clear" />
      </div>

      <div class="mpp_nb_images"></div>
    </div>

    <div class="mpp_paging">
    </div>
    <br class="mpp_clear" />
  </div>  

  <div class="mpp_images"></div>
<!--
  <h3 class="mpp_categories_title"><?php _e('Browse Categories', self::ld); ?></h3>
  <div class="mpp_categories">
    <ul class="mpp_categories_main">
      <li><a href="">Category name</a></li>
    </ul>

    <br class="mpp_clear" />
  </div>

-->

  <div class="mpp_paging_bottom">
    <div class="mpp_paging">
    </div>
    <br class="mpp_clear" />
  </div>
</div>

<div class="mpp_ui_detail">
  <input type="button" class="button-secondary" name="mpp_button_back" value="<?php echo _e('Back', self::ld); ?>" />
  <div class="mpp_detail"></div>
</div>

<div class="mpp_ui_image">
</div>