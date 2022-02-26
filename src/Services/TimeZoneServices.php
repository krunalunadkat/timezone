<?php

/**
 * @file providing the service that timezone set in config form'.
 *
 */

namespace Drupal\timezone\Services;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DateFormatterInterface;

/**
 * Class TimeZoneServices
 * @package Drupal\timezone\Services
 */
class TimeZoneServices {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Class constructor.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The configuration factory.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $dateFormatter
   *   The date formatter service.
   */
  public function __construct(ConfigFactoryInterface $configFactory , DateFormatterInterface $dateFormatter){
    $this->configFactory = $configFactory;
    $this->dateFormatter = $dateFormatter;
  }
  
  /**
   * {@inheritdoc}
   */
  public function getData() {
    $config = $this->configFactory->get('timezone.settings');
    $timezone = $config->get('timezone');
    $date = $this->dateFormatter->format(strtotime('now'), 'custom' , 'jS M Y - h:i A' , $timezone);
    return $date;
  }
}
