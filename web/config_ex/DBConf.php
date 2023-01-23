<?php

    class DBConf {

        static private $databases = array(
          'hostname' => '127.0.0.1',
          'database' => 'mydatabase',
          'login' => 'admin',
          'password' => '123',
          'port' => '3306'
        );

        static public function getHostname() {
          return self::$databases['hostname'];
        }

        static public function getDatabase() {
          return self::$databases['database'];
        }

        static public function getLogin() {
          return self::$databases['login'];
        }

        static public function getPassword() {
          return self::$databases['password'];
        }

        static public function getPort() {
          return self::$databases['port'];
        }

      }
