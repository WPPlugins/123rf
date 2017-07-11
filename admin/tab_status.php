<div id="mpp_status" style="position: absolute; right: 50px; top: 15px;">
<?php
if ($data && $module->isLogged())
{
  echo sprintf(__('You are logged in at %s.', self::ld),
                $module->getTitle());

  if (isset($data['credits']))
    echo ' '.sprintf(__('You have %s credit(s).', self::ld),
                      '<a href="'.$data['credits_link'].'" target="_blank"><b>'.($data['credits']?$data['credits']:'0').'</b></a>');
}
else
{
  echo sprintf(__('You are no longer logged into %s.', self::ld), $module->getTitle());
  echo ' ';
  echo '<a href="'.admin_url('options-general.php?page=Plugin123RF').'">'.__('Please log in', self::ld).'</a>';

  if ($l = $module->getRegisterLink())
    echo ' or <a href="'.$l.'" target="_blank">'.__('register now', self::ld).'</a>.';
}

if ($t = $module->getStatusText())
  echo ' '.$t;
?>
</div>
