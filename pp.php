<?php
/**
 * Output dump of vixed variable. If second arfument is true then
 * do exit of script execution
 *
 * @param mixed $mixed
 * @param bool $stop
 * @param string $file_name
 */
function pp($mixed, $stop = FALSE, $file_name = 'pp.log') {
  $ar = debug_backtrace();
  $key = pathinfo($ar[0]['file']);
  $key = $key['basename'] . ':' . $ar[0]['line'];
  $GLOBALS['print_r_view'][$key][] = $mixed;
  if ($stop > 0) {
    $str = '';
    $string_content = '';
    foreach($GLOBALS['print_r_view'] as $line => $values) {
      foreach($values as $key => $value) {
        $temp_ar = array($line => $value);
        $string_content = htmlspecialchars(print_r($temp_ar, TRUE));
        $tag = 'pre';
        if (defined('SITE_WAP_MODE') && SITE_WAP_MODE) {
          $tag = 'wml';
        }
        $str .= '<' . $tag . '>';
        $str .= $string_content;
        $str .= '</' . $tag . '>';
      }
    }
    switch ($stop) {
      case 1:
        echo $str;
        exit;
        break;

      case 2:
        return $str;
        break;

      case 3:
        $file = fopen($file_name, 'w');
        fwrite($file, $string_content);
        fclose($file);
        return FALSE;
        break;
    }
  }
}
