<?php
/**
 * Created by PhpStorm.
 * User: stepGT
 * Date: 11/5/2018
 * Time: 1:26 PM
 */

namespace Engine\TCCore\TCTemplate;


use Engine\TCCore\TCConfig\TCConfig;

class TCTheme {

  const TC_RULES_NAME_FILE = [
    'header' => 'header-%s',
    'footer' => 'footer-%s',
    'sidebar' => 'sidebar-%s',
  ];

  const TC_URL_THEME_MASK = '/content/themes/%s';

  protected static $tcUrl = '';

  protected static $tcData = [];

  public $asset;

  public $theme;

  function __construct() {
    $this->theme = $this;
    $this->asset = new TCAsset();
  }

  /**
   * @return string
   */
  public static function getURL() {
    $currentTheme = TCConfig::item('defaultTheme');
    return sprintf(self::TC_URL_THEME_MASK, $currentTheme);
  }

  /**
   * @param null $name
   */
  public static function header($name = NULL) {
    $name = (string) $name;
    $file = self::TCThemeDetectNameFile($name, __FUNCTION__);
    TCComponent::TCComponentLoad($file);
  }

  /**
   * @param string $name
   */
  public static function footer($name = '') {
    $name = (string) $name;
    $file = self::TCThemeDetectNameFile($name, __FUNCTION__);
    TCComponent::TCComponentLoad($file);
  }

  /**
   * @param string $name
   */
  public static function sidebar($name = '') {
    $name = (string) $name;
    $file = self::TCThemeDetectNameFile($name, __FUNCTION__);
    TCComponent::TCComponentLoad($file);
  }

  /**
   * @param string $name
   * @param array $data
   */
  public static function block($name = '', $data = []) {
    $name = (string) $name;
    //
    if ($name !== '') {
      TCComponent::TCComponentLoad($name, $data);
    }
  }

  /**
   * @return array
   */
  public static function TCThemeGetData() {
    return static::$tcData;
  }

  /**
   * @param array $data
   */
  public static function TCThemeSetData($data) {
    static::$tcData = $data;
  }

  /**
   * @param $name
   * @param $function
   *
   * @return string
   */
  private static function TCThemeDetectNameFile($name, $function) {
    return empty(trim($name)) ? $function : sprintf(self::TC_RULES_NAME_FILE[$function], $name);
  }
}