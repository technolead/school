<?php

/*
  Developer: Samir Kumar Das
  Email: cse.samir@gmail.com
  This is the base class of the site. All debug related method should be declared here.
 */

class Debug {

    private static $startTime = '';
    private static $endTime = '';
    private static $debugMode = DEBUG_MODE;
    private static $debugEmail = DEBUG_EMAIL;
    // if debug mode is set for debug mode
    private static $logFile = LOG_FILE;
    private static $errorMsg = '';
    private static $victimFile = '';

   

    public static function startTimer() {
        self::$startTime = self::getMicroTime();
    }

    public static function endTimer() {
        self::$endTime = self::getMicroTime();
    }

    public static function displayTimer() {
        $execution_time = self::getExecutionTime();
        echo "<br>=======================Timer=======================<br>";
        echo "&nbsp;&nbsp;&nbsp; Time to execute is <b>$execution_time</b> sec      ";
        echo "<br>=================================================<br>";
    }

    /**
     * Returns the computed execution time.
     *
     * @return   float
     * @access   public
     */
    public static function getExecutionTime() {
        return $execution_time = self::$endTime - self::$startTime;
    }

    /* there are three kind of error mode
      1. Screen
      2. Email
      3. log File
     */

    public static function reportError($msg, $file_name="") {

        self::$victimFile = $file_name;
        self::$errorMsg = $msg;

        if (self::$debugMode == 'screen') {
            echo self::$errorMsg . " (File name: " . self::$victimFile . ")<br>";
        } elseif (self::$debugMode == 'file') {
            self::logError();
        } elseif (self::$debugMode == 'email') {
            self::$sendErrorViaEmail();
        }
    }

    //log a error in a file
    public static function logError() {
        if (is_file(self::$logFile) && is_writable(self::$logFile)) {
            $fp_log = fopen(self::$logFile, 'a');
            $error = "Date : " . date('Y-m-d H:i:s') . "\r\n";
            $error.="File Name : " . self::$victimFile . "\r\n";
            $error.="Error  : " . self::$errorMsg . "\r\n";
            $error.="----------------------------------------------------------------------------" . "\r\n" . "\r\n";
            fputs($fp_log, $error);
            fclose($fp_log);
        }
    }

    //email a error
    public static function sendErrorViaEmail() {
        $error = "Date : " . date('Y-m-d H:i:s') . "<br>";
        $error.="File Name : " . self::$victimFile . "<br>";
        $error.="Error  : " . self::$errorMsg . "<br>";
        $error.="----------------------------------------------------------------------------" . "<br>";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        @mail($debugEmail, 'Error reporting', $error);
    }

    //get time in microsec
    public static function getMicroTime() {
        return microtime(true);
    }

    //print a var or array
    public static function printVar($var) {
        if (is_array($var))
            print_r($var);
        elseif (is_object($var))
            var_dump($var);
        else
            print($var);
    }

    public static function writeLog($var, $title='') {
        $logger=APPPATH."logger.txt";
        $file_handler = fopen($logger, 'a+');
        if (is_array($var)) {
            foreach ($var as $val) {
                if (empty($title)) {
                    fwrite($file_handler, $val . "\n");
                } else {
                    fwrite($file_handler, $title . ' : ' . $val . "\n");
                }
            }
        } else {
            if (empty($title)) {
                fwrite($file_handler, $var . "\n");
            } else {
                fwrite($file_handler, $title . ' : ' . $var . "\n");
            }
        }
        fclose($file_handler);
    }

    public static function printViewForm($var, $title='') {
        $file_handler = fopen('view_form.txt', 'a+');
        if (is_array($var)) {
            foreach ($var as $val) {
                if (empty($title)) {
                    fwrite($file_handler, $val . "\n");
                } else {
                    fwrite($file_handler, $title . ' : ' . $val . "\n");
                }
            }
        } else {
            if (empty($title)) {
                fwrite($file_handler, $var . "\n");
            } else {
                fwrite($file_handler, $title . ' : ' . $var . "\n");
            }
        }
        fclose($file_handler);
    }

}
?>