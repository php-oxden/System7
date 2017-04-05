<?php
/**
 *
 * @name    Pro -Grom HomePage
 * @link    http://www.pro-grom.pl/
 * @author  Bartosz Zwierzchowski, Vedget
 * @license http://www.pro-grom.pl/license/ New BSD License
 * @copyright (c) 2017 Bartosz Zwierzchowski
 */
namespace System7\Component\Log;
use DateTime;
use RuntimeException;
use InvalidArgumentException;
use Php7x\oXSystem\Filter;

class Log implements LogInterface
{
    const FILE_EXT = '.log';
    const FILE_DIR = APP_DIR . "/cache/logs/";

    /**
     * app envirnoment singeleton
     * @var string
     */
    private static $i_envi;

    /**
     * Loggin event hierarhi
     * @var array
     */
    protected $logLevels = array(
        LogLevel::EMERGENCY => 0,
        LogLevel::ALERT     => 1,
        LogLevel::CRITICAL  => 2,
        LogLevel::ERROR     => 3,
        LogLevel::WARNING   => 4,
        LogLevel::NOTICE    => 5,
        LogLevel::INFO      => 6,
        LogLevel::DEBUG     => 7
    );

    /**
     * log::envi()
     *
     * @param $envi
     * @return string
     */
    public static function envi($envi) {
        if (self::$i_envi === null) {
            self::$i_envi = (string) strtolower($envi);
        }
        return self::$i_envi;
    }

    /**
     * @return string full log file dir path
     */
    public static function file_path() {
        $var = self::FILE_DIR . '[' . date('Y-m-d') . ']_runtime-';
        return (string) strtolower($var);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($level, $message, array $context = array()) {
        if ( !isset(self::$i_envi) ) {
            $f_path = strtolower(self::file_path() . "forge_byDIM" . self::FILE_EXT);
        } else $f_path = strtolower(self::file_path() . self::$i_envi . self::FILE_EXT );

        if(!file_exists($f_path)) {
            touch($f_path);
        }

        $log_message = '[' . date('Y-m-d') . ' ('. date('H:i:s') . ')] < '. $level .' >  "'. Filter::utf8($message).'".'.PHP_EOL;
        file_put_contents($f_path, $log_message, FILE_APPEND);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = array()) {
        $this->log(LogLevel::EMERGENCY, $message, array( $context = array()));
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = array()) {
        $this->log(LogLevel::ALERT, $message, array( $context = array()));
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = array()) {
        $this->log(LogLevel::CRITICAL, $message, array( $context = array()));
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = array()) {
        $this->log(LogLevel::ERROR, $message, array( $context = array()));
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = array()) {
        $this->log(LogLevel::WARNING, $message, array( $context = array()));
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = array()) {
        $this->log(LogLevel::NOTICE, $message, array( $context = array()));
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = array()) {
        $this->log(LogLevel::INFO, $message, array( $context = array()));
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = array()) {
        $this->log(LogLevel::DEBUG, $message, array( $context = array()));
    }

    /**
     * Gets the correctly formatted Date/Time for the log entry.
     *
     * PHP DateTime is dump, and you have to resort to trickery to get microseconds
     * to work correctly, so here it is.
     *
     * @return string
     */
    private function getTimestamp() {
        $originalTime = microtime(true);
        $micro = sprintf("%06d", ($originalTime - floor($originalTime)) * 1000000);
        $date = new DateTime(date('Y-m-d H:i:s.'.$micro, $originalTime));
        return $date->format($this->options['dateFormat']);
    }
}