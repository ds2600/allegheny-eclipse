<?php

namespace AlleghenyEclipse;

use \Monolog\Level;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class App {
    
    private static $config = [];
    private static $instance = null;
    private Security $security;

    public static $log;

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        self::$log = new Logger('AlleghenyEclipse');
        $logLevel = self::getConfig('/app/log/level') ?? 'info';
        self::$log->pushHandler(new StreamHandler(
            __DIR__.'/../logs/app.log',
            Level::fromName($logLevel)
        ));

        $this->secruity = new Security();
    }

    public function getSecurity(): Security {
        if(!isset($this->security)) {
            $this->security = new Security();
        }
        return $this->security;
    }

    public static function getVersion() {
        $versionFile = __DIR__.'/../VERSION';
        if(!file_exists($versionFile)) {
            throw new \Exception('Version file not found');
        }
        return trim(file_get_contents($versionFile));
    }

    public static function getEnvironment() {
        return getenv('APP_ENV') ?: 'production';
    }


