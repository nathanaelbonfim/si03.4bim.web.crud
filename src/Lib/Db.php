<?php

namespace PHPhademic\Lib;

class Db
{
    private static ?Db $instance = null;
    private \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(
            Env::get('DB_DSN'),
            Env::get('DB_USER'),
            Env::get('DB_PASSWORD')
        );

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): Db
    {
        if (self::$instance === null)
            self::$instance = new Db();

        return self::$instance;
    }

    public function query(string $query, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt;
    }

    public function fetch(string $query, array $params = []): array
    {
        return $this->query($query, $params)->fetch();
    }

    public function fetchAll(string $query, array $params = []): array
    {
        return $this->query($query, $params)->fetchAll();
    }
}