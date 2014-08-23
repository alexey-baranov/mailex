<?php

namespace MailEx {
    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */

    /**
     * Description of Message
     *
     * @author alexey_baranov
     */
    class Message extends \Zend\Mail\Message{
        protected static $_defaultFrom;
        protected static $_defaultFromName;

        /**
         * @param string $defaultFrom
         * @param string $defaultFromName
         */
        public static function setDefaultFrom($defaultFrom, $defaultFromName)
        {
            self::$_defaultFrom = $defaultFrom;
            self::$_defaultFromName = $defaultFromName;
        }

        /**
         * @return mixed
         */
        public static function getDefaultFrom()
        {
            return self::$_defaultFrom;
        }

        /**
         *
         * @var \Logger
         */
        protected $_log;
        
        function __construct() {
            $this->_log= \Logger::getLogger("MailEx.Message");
            
            $this->setEncoding("UTF-8");

            if (self::$_defaultFrom){
                $this->setFrom(self::$_defaultFrom, self::$_defaultFromName);
            }
        }

        function setHtmlBody($value) {
            $body= new \Zend\Mime\Message();
            
            $html= new \Zend\Mime\Part($value);
            $html->charset="UTF-8";
            $html->type = "text/html";

            $text= new \Zend\Mime\Part("");
            $text->charset="UTF-8";
            $text->type = "text/plain";
            
            $body->setParts(array($html, $text));
            
            $this->setBody($body);
            
            return $this;
        }
    }

}