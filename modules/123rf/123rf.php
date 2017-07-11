<?php
// 123RF module for Microstock Photo Plugin

class Plugin123RF_123rf extends Plugin123RF_module
{
  public function __construct()
  {
    parent::__construct();
    $this->_order = 20;
    $this->_path = dirname(__FILE__);
    $this->_url = plugins_url('', __FILE__);

    $this->icon = $this->_url.'/admin/images/123rf.png';
    $this->logo = $this->_url.'/admin/images/123rf-logo-footer.png';
    $this->name = __class__;
    $this->title = __('123RF', self::ld);
    $this->register_link = 'https://www.123rf.com/register.php';

    // definition of default settings
    $this->default_settings = array(
      'mpp_enabled' => true,
      'mpp_cusid' => '',
      'mpp_comkey' => '',
      'mpp_acckey' => '',
      'mpp_password' => '',
      'data' => false
    );
  }

  public function isLogged () {
    return isset($this->credits);
  }

  public function login($data)
  {
    if (!isset($data['mpp_cusid']) || !isset($data['mpp_comkey']) || !isset($data['mpp_acckey']) || !isset($data['mpp_password']))
      return false;

    $ex     = explode(":", $data['mpp_login']);
    $this->secret = $data['mpp_password'];
    $this->key    = $data['mpp_comkey'];
    $this->userid = $data['mpp_cusid'];
    $this->access = $data['mpp_acckey'];

    $sign = md5($this->secret . "accesskey" . $this->access . "apikey" . $this->key . "custid" . $this->userid . "method" . "123rf.customer.getCreditCount");

    $url = "http://api.123rf.com/rest/?method=123rf.customer.getCreditCount&apikey=" . $this->key . "&custid=" . $this->userid . "&accesskey=" . $this->access . "&apisign=" . $sign;
    $res = file_get_contents($url);
    $xml = new SimpleXMLElement($res);

    foreach($xml->attributes() as $k => $v){
      if($k == "stat" && $v == "ok"){
        $this->credits = $xml->customer[0]->credit->attributes()["balance"];
        return true;
      }
    }

    return false;
  }

  public function setAPIKey($k) {}

  public function getUserData()
  {
    return Array("credits" => (int) $this->credits);
  }

  public function getCategories() {}

  public function search($data)
  {
    $params = Array();
    $params["apikey"] = "d965f075fe3d86c3c63fed35ece52ec3"; // Hardcoded
    $params["keyword"] = $data['text'];
    $params["page"] = $data['page'];
    $params["perpage"] = $data['limit'];
    $params["orderby"] = $data['sort'] == "creation" ? "latest" : ($data['sort'] == "nb_downloads" ? "most_downloaded" : "random");
    $params["nudity"] = in_array("nudity", $data['filters']) ? 0 : 1;
    $params["media_type"] = $data['type'];
    $params["orientation"] = $data['orientation'];
    $params["language"] = $data['language'];
    $params["people_count"] = $data['people'];
    $params["people_age"] = $data['age'];
    $params["people_gender"] = $data['gender'];
    if($data['category'] != "all") $params["category"] = $data["category"];
    if($data['models'] != "n") $params["model_preference"] = $data["models"];
    if(trim($data['color']) != "") $params["color"] = $data["color"];

    $url = "http://api.123rf.com/rest/?method=123rf.images.search";
    foreach($params as $k => $v)
      $url .= "&$k=" . urlencode($v);
    $res = file_get_contents($url);
    $xml = new SimpleXMLElement($res);

    if($xml->attributes()["stat"] != "ok")
      return false;

    $images = Array();
    $img = $xml->images[0]->image;

    foreach($img as $imageIt) {
      $image = $imageIt->attributes();

      $thumbnail_url = "http://images.assetsdelivery.com/thumbnails/" . $image['contributorid'] . "/" . $image['folder'] . "/" . $image['filename'] . ".jpg";
      $image_url = "http://images.assetsdelivery.com/compings/" . $image['contributorid'] . "/" . $image['folder'] . "/" . $image['filename'] . ".jpg";

      $images[] = array(
          'id' => (String) $image['id'],
          'title' => (String) ucfirst($image['description']),
          'thumbnail_url' => $thumbnail_url,
          'image_url' => $image_url
      );
    }

    return Array("nb" => intval($xml->images[0]->attributes()["total"]), "images" => $images);
  }

  public function detail($id)
  {
    $params = Array();
    $params["apikey"] = "d965f075fe3d86c3c63fed35ece52ec3"; // Hardcoded
    $params["imageid"] = $id;
    
    $url = "http://api.123rf.com/rest/?method=123rf.images.getInfo.V2";
    foreach($params as $k => $v)
      $url .= "&$k=" . urlencode($v);
    $res = file_get_contents($url);
    $xml = new SimpleXMLElement($res);

    if($xml->attributes()["stat"] != "ok")
      return false;

    $imageInfo = $xml->image->attributes();
    $contrInfo = $xml->image->contributor->attributes();

    $image_url = "http://images.assetsdelivery.com/compings/" . $contrInfo['id'] . "/" . $imageInfo['folder'] . "/" . $imageInfo['filename'] . ".jpg";
    
    $licenses = Array();
    foreach($xml->image->sizes->size as $size){
      $licenses[] = array(
        'name' => $size['label'],
        'title' => $size['label'],
        'price' => $size['price'],
        'dimensions' => $size['width'] . "x" . $size['height']
      );
    }

    return array(
        'id' => (String) $imageInfo['id'],
        'title' => (String) ucfirst($xml->image->description),
        'creator_name' => (String) trim($contrInfo['realname']) != "" ? $contrInfo['realname'] : $contrInfo['id'],
        'creation_date' => date("Y-m-d"), // Not provided
        'thumbnail_url' => $image_url,
        'licenses' => $licenses,
        'licenses_subscription' => false,
        'image_page' => 'http://en.fotolia.com/id/'.$r['id'] // Not provided
    );
  }

  public function buy($data, $test = false)
  {
    $params = Array();
    $params['accesskey'] = $this->access;
    $params['apikey'] = $this->key;
    $params['custid'] = $this->userid;
    $params['imageid'] = $data['id'];
    $params['method'] = "123rf.images.download.V2";
    $params['resolution'] = $data['license'];

    $str = $this->secret;
    $url = "http://api.123rf.com/rest/?";
    foreach($params as $k => $v){
      $v = urlencode($v);
      $url .= "$k=$v&";
      $str .= $k . $v;
    }
    $url = rtrim($url, "&");
    $sign = md5($str);
    $url .= "&apisign=$sign";

    $res = file_get_contents($url);

    $xml = new SimpleXMLElement($res);

    if($xml->attributes()["stat"] != "ok"){
      if(isset($xml->err))
        return array('message' => ucfirst($xml->err));
      else
        return array('message' => __('Service currently unavailable.', self::ld));
    }

    $url = $xml->download->url;

    $filename = $data['path'].'/'.$this->format_uri($data['id'] . '-' . $params['resolution'] . '.jpg');
    $filename = $this->getValidFilename($filename, "jpg");

    $image = file_get_contents($url); 
    $handle = fopen($filename, "a"); 
    fwrite($handle, $image); 
    fclose($handle);

    return $filename;
  }

  public function getSearchFilters()
  {
    return array(
      'nudity' => __('Nudity', self::ld)
    );
  }

  public function getAffiliateLink($image_page, $aff_id) {
    return $image_page;
  }

  public function getSortOptions()
  {
    return array(
      'random' => __('Random', self::ld),
      'creation' => __('Creation Date', self::ld),
      'nb_downloads' => __('Number of Downloads', self::ld)
    );
  }
}
