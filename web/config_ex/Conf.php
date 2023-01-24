<?php

    class Conf {
        static private $enable_captcha = True;
        static private $secret_re_captcha_public = "XXX-XXX";
        static private $secret_re_captcha_private = "XXX-XXX";
        static private $domain = "chades.fr";

        static public function isCaptchaEnable() {
            return self::$enable_captcha;
        }

        static public function getCaptchaPublicKey() {
            return self::$secret_re_captcha_public;
        }

        static public function getCaptchaPrivateKey() {
            return self::$secret_re_captcha_private;
        }

        static public function getDomain() {
            return self::$domain;
        }
    }
