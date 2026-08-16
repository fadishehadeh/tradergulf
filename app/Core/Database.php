<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

final class Database
{
    private array $config;
    private ?PDO  $connection = null;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function connection(): PDO
    {
        if ($this->connection !== null) return $this->connection;

        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $this->config['host'],
            $this->config['port'],
            $this->config['database'],
            $this->config['charset']
        );

        $this->connection = new PDO($dsn, $this->config['username'], $this->config['password'], [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);

        return $this->connection;
    }

    public function fetch(string $sql, array $params = []): ?array
    {
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch();
        return is_array($result) ? $result : null;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function fetchValue(string $sql, array $params = []): mixed
    {
        $result = $this->fetch($sql, $params);
        return $result ? array_values($result)[0] : null;
    }

    public function execute(string $sql, array $params = []): bool
    {
        $stmt = $this->connection()->prepare($sql);
        return $stmt->execute($params);
    }

    public function lastInsertId(): string
    {
        return $this->connection()->lastInsertId();
    }
}
