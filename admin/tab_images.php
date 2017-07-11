<?php
// show available offers
if ($offers && is_array($offers) && count($offers) > 0 && count($result) > 0)
{  
  foreach($offers as $offer)
    if (in_array($module, $offer->modules) && in_array('search_page', $offer->visibility) && !isset($hidden_offers[$offer->id]))
      echo '<div class="mpp_offer"><div class="mpp_offer_text">'.$offer->content.'</div><div class="mpp_offer_close" data-id="'.$offer->id.'">X</div><br class="mpp_clear" /></div>';
}
?>

<?php
foreach($result as $image)
{
?>
<div class="mpp_image" style="height:100%;">
  <a data-tooltip-mpp="mpp_image_tooltip_<?php echo $image['id']; ?>" class="mpp_image_link" href="<?php echo $image['id']; ?>" onclick="return false;">
    <div class="mpp_image_div">
      <table width="100%" height="100%" style="padding:0;" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="middle">
            <img class="mpp_image_img" width="100%" height="auto" src="<?php echo $image['thumbnail_url']; ?>" />
          </td>
        </tr>
      </table>
    </div>
  </a>
</div>
<?php
}
?>
<br class="mpp_clear" />

<div id="mpp_tooltips" class="stickytooltip">
  <div style="padding:5px">
  <?php
  foreach($result as $image)
  {
  ?>
    <div id="mpp_image_tooltip_<?php echo $image['id']; ?>" class="atip">
      <div style="overflow: hidden;">
        <img src="<?php echo $image['image_url']; ?>" /><br />
      </div>
      <div style="float: left;">
        <?php echo $image['title']; ?>
      </div>
      <br class="mpp_clear" />
    </div>
  <?php
  }
  ?>
  </div>
</div>