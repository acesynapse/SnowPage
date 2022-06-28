<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace App\Twig;

defined('ABSPATH') || die(http_response_code(418));

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('imageurl', [$this, 'imageUrl']),
        ];
    }

    function isImage ($url) {
      $headers = array_map('strtolower', @get_headers($url));
      $keysearch = 'content-type: image/jpeg';
      if(in_array($keysearch, $headers)) {
        return true;
      } else {
        return false;
      }
    }

    public function imageUrl($number) {
      $urlone = "https://secure.syndetics.com/index.aspx?isbn={$number}/LC.GIF";
      $urltwo = "https://secure.syndetics.com/index.aspx?upc={$number}/LC.GIF";
      $urlthree = "https://secure.syndetics.com/index.aspx?oclc={$number}/LC.GIF";
      $urlfour = "https://covers.openlibrary.org/b/isbn/{$number}-L.jpg";
      $urlfive = "https://content.chilifresh.com/?isbn={$number}&size=L";
      $sizearray = array();
      if (isImage($urlone) == true) {
        $sizearray[$urlone] = getimagesize($urlone)[1];
      }
      if (isImage($urltwo) == true) {
        $sizearray[$urltwo] = getimagesize($urltwo)[1];
      }
      if (isImage($urlthree) == true) {
        $sizearray[$urlthree] = getimagesize($urlthree)[1];
      }
      if (isImage($urlfour) == true) {
        $sizearray[$urlfour] = getimagesize($urlfour)[1];
      }
      if (isImage($urlfive) == true) {
        $sizearray[$urlfive] = getimagesize($urlfive)[1];
      }
      asort($sizearray);
      $imageurl = array_key_last($sizearray);
      return $imageurl;
    }
}
