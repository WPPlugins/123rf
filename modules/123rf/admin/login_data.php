<?php        
$credits = '<b class="mpp_credits">'.(isset($data['credits'])?$data['credits']:'0').'</b>';
echo sprintf(__('Credits: %s', self::ld), $credits);
echo " (<a href='http://www.123rf.com/packages/' target='_blank'>" . sprintf(__('Buy more', self::ld)) . "</a>)";