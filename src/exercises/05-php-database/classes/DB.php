<?php
    class DB
    {
        /** @var DB|null The single instance of this class */
        private static $instance = null;

        /** @var PDO The PDO database connection */
        private $connection;

        private function __construct()
        {
            try {
                $this->connection = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        /**
         * Get the singleton instance
         *
         * @return DB The singleton instance
         */
        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Get the PDO connection
         *
         * @return PDO The database connection
         */
        public function getConnection()
        {
            return $this->connection;
        }

        private function __clone() {}

        public function __wakeup()
        {
            throw new Exception("Cannot unserialize a singleton.");
        }
    }
?>