<?php
require('../vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\JsonFormatter;

function adminer_object()
{
  class AdminerSoftware extends Adminer
  {
    private $logger;

    // コンストラクタ
    function __construct() 
    {
      $this->logger = $this->getLogger('php://stdout', Logger::INFO);
    }

    function getLogger($filename, $level = Logger::DEBUG)
    {
      $logger = new Logger('adminer');
      $handler = new StreamHandler($filename, $level);
      $handler->setFormatter(new JsonFormatter());
      $logger->pushHandler($handler);
      $logger->pushProcessor(function ($record) {
        $record['extra']['remote_user'] = $_SERVER['REMOTE_USER'];
        $record['extra']['remote_ip'] = $_SERVER['REMOTE_ADDR'];
        $record['extra']['xff'] = $_SERVER['X-Forwarded-For'];
        return $record;
      });
      return $logger;
    }

    // 画面表示されるタイトル
    function name()
    {
      return 'WORLD';
    }

    // DB設定
    function credentials()
    {
      return array('db', 'root', 'password');
    }

    // 使用するデータベース
    function database()
    {
      // return 'world';
      return 'world';
    }

    // 認証方法、trueを返すと何も入力しなくても認証が通る。
    function login($login, $password)
    {
      return true;
    }

    // テーブル制限
    function tableName($tableStatus)
    {
      // countryテーブルを非表示
      $ignored_list = [
        'country'
      ];
      if (in_array($tableStatus["Name"], $ignored_list, true)) {
        return '';
      }
      return parent::tableName(($tableStatus));
    }

    // 列制限
    function fieldName($field, $order = 0)
    {
      // ID列を非表示
      $ignored_list = [
        'ID'
      ];
      if (in_array($field["field"], $ignored_list, true)) {
        return '';
      }
      return parent::fieldName($field, $order = 0);
    }

    function selectQuery($query, $time, $failed = false)
    {
      $output_query = str_replace("\n", " ", $query);
      $this->logger->debug($output_query);
    }

    function messageQuery($query, $time, $failed = false)
    {
      $output_query = str_replace("\n", " ", $query);
      $this->logger->info($output_query);
    }
  }

  return new AdminerSoftware();
}

include './editor.php';
