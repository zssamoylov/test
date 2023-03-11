<?php
use mysqli;

class Database
{
    /**
     * @param string $query
     *
     * @return array|false|null
     */
    public function fetchAssocQuery(string $query): array|false|null
    {
        $connection = $this->connect();
        $result = $connection->query($query);

        $row = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

        $connection->close();

        return $row;
    }

    /**
     * @return mysqli
     */
    public function connect(): mysqli
    {
        $connection = new mysqli(
            DB_SERVER_NAME,
            DB_USER_NAME,
            DB_PASSWORD,
            DB_NAME,
        );

        if ($connection->connect_error) {
            die($connection->connect_error);
        }

        return $connection;
    }

}