<?php

/**
 * @package   SnowPage
 * @author    Emric Taylor (AceSynapse), http://www.protemstudios.com/
 * @license   GNU/GPLv3 and later
 *
 * http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('ABSPATH') || die(http_response_code(418));

use Twig\TwigFunction;

      function returnphoto ($search) {
        $urlbt = "https://catalog.cclsny.org/cgi-bin/koha/opac-export.pl?op=export&bib={$search}&format=mods";
        $bibtex = file_get_contents($urlbt);
        $bibtex = str_replace( "\n", '', $bibtex);
        preg_match('/(isbn">|lccn">)(\d*)\D/', $bibtex, $bibnum);
        $bibnum = $bibnum[2];
        $src1 = (@getimagesize("https://secure.syndetics.com/index.aspx?isbn={$bibnum}/LC.GIF&client=chautauqua-cattaraugus&type=xw10&upc=&oclc="));
        $src2 = (@getimagesize("https://covers.openlibrary.org/b/isbn/{$bibnum}-L.jpg"));
        $src3 = (@getimagesize("https://covers.openlibrary.org/b/lccn/{$bibnum}-L.jpg"));

      if ($src1 != false && $src1[0] > 10) {
              $imgurl = "https://secure.syndetics.com/index.aspx?isbn={$bibnum}/LC.GIF&client=chautauqua-cattaraugus&type=xw10&upc=&oclc=";
              return $imgurl;
          } else if ($src2 != false && $src2[0] > 10) {
              $imgurl = "https://covers.openlibrary.org/b/isbn/{$bibnum}-L.jpg";
              return $imgurl;
          } else if ($src3 != false && $src3[0] > 10) {
              $imgurl = "https://covers.openlibrary.org/b/lccn/{$bibnum}-L.jpg";
              return $imgurl;
          } else {
              $imgurl = "https://www.cclsny.org/wp-content/uploads/2022/06/20220613_CCLS_StockBook.png";
              return $imgurl;
          }

      }



      function returnauthor ($search, $which) {
        $urlbt = "https://catalog.cclsny.org/cgi-bin/koha/opac-export.pl?op=export&bib={$search}&format=bibtex";
        $bibtex = file_get_contents($urlbt);
        $bibtex = str_replace( "\n", '', $bibtex);
        if ($which == 'title') {
        $title = $bibtex;
        $title = preg_replace('/(.*)(title = {)/', '', $title);
        $title = preg_replace('/(})(.*)/', '', $title);
        $title = preg_replace('/ \//', '', $title);
        $title = preg_replace('/\./', '', $title);
        $title = strtolower($title);
        $title = ucwords($title);
        $uppercase_words = array("/ A /", "/ An /", "/ And The /", "/ And /", "/ As If /", "/ As /", "/ At /", "/ But /", "/ By /", "/ For /", "/ If /", "/ In The /", "/ In A /", "/ In /", "/ Is /", "/ Nor /", "/ Off /", "/ On Top Of /", "/ On The /", "/ Of The /", "/ Of A /", "/ Of /", "/ On /", "/ Or /", "/ Out Of /", "/ So /", "/ To The /", "/ The /", "/ To /", "/ Up /", "/ Yet /");
        $lowercase_replacements = array(" a ", " an ", " and the ", " and ", " as if ", " as ", " at ", " but ", " by ", " for ", " if ", " in the ", " in a ", " in ", " is ", " nor ", " off ", " on top of ", " on the ", " of the ", " of a ", " of ", " on ", " or ", " out of ", " so ", " to the ", " the ", " to ", " up ", " yet ");
        $title = preg_replace($uppercase_words, $lowercase_replacements, $title);
        return $title;
        } else if ($which == 'author') {
        $author = $bibtex;
        $author = preg_replace('/(.*)(author = {)/', '', $author);
        $author = preg_replace('/( and|})(.*)/', '', $author);
        $author = preg_replace('/(\. |\.)/', '', $author);
        $author = explode(", ", $author);
        $author = array_reverse($author);
        $author = implode(" ", $author);
        $author = preg_replace('/(,|\.)/', '', $author);
        return $author;
      }
      }



      $urlbt = "https://cclsny.bywatersolutions.com/cgi-bin/koha/opac-search.pl?idx=&q=+gods+of+Mars&weight_search=1&count=6&format=rss";
      $bibtex = file_get_contents($urlbt);
      $bibtex = str_replace( "\n", '', $bibtex);
      preg_match_all('/=(\d*)<\/guid>/', $bibtex, $bibnum);
      $bibnum = $bibnum[0];
      $bibnum = preg_replace('/\D/', '', $bibnum);

      $authors = array();
      $titles = array();
      $linkurl = array();
      $photourl = array();

      foreach ($bibnum as $num) {
      $author = returnauthor($num, 'author');
      $title = returnauthor($num, 'title');
      $combinelink = "https://catalog.cclsny.org/cgi-bin/koha/opac-detail.pl?biblionumber={$num}";
      $photos = returnphoto($num);
      array_push ($authors, $author);
      array_push ($titles, $title);
      array_push ($linkurl, $combinelink);
      array_push ($photourl, $photos);
      }

      $final_array = array(
          'author1'   => $authors[0],
          'title1'    => $titles[0],
          'photo1'    => $photourl[0],
          'link1'     => $linkurl[0],

          'author2'   => $authors[1],
          'title2'    => $titles[1],
          'photo2'    => $photourl[1],
          'link2'     => $linkurl[1],

          'author3'   => $authors[2],
          'title3'    => $titles[2],
          'photo3'    => $photourl[2],
          'link3'     => $linkurl[2],

          'author4'   => $authors[3],
          'title4'    => $titles[3],
          'photo4'    => $photourl[3],
          'link4'     => $linkurl[3],

          'author5'   => $authors[4],
          'title5'    => $titles[4],
          'photo5'    => $photourl[4],
          'link5'     => $linkurl[4],

          'author6'   => $authors[5],
          'title6'    => $titles[5],
          'photo6'    => $photourl[5],
          'link6'     => $linkurl[5]
      );

      $twig->addGlobal('finalArray', $final_array);
