<?php

require_once('GuestBookInterface.php');

class GuestBook implements GuestBookInterface
{
    /**
     * @var Database
     */
    protected Database $database;

    /**
     * @var QueryMapperInterface
     */
    protected QueryMapperInterface $queryMapper;

    /**
     * @var string
     */
    protected $tableName = 'guest_book';

    /**
     * @param Database $database
     * @param QueryMapperInterface $queryMapper
     */
    public function __construct(
        Database $database,
        QueryMapperInterface $queryMapper
    ) {
        $this->database = $database;
        $this->queryMapper = $queryMapper;
    }

    /**
     * @return array
     */
    public function save(): array
    {
        $apiAddress = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $pageUrl = $_SERVER['HTTP_REFERER'];
        $criteria = [
            'ip_address' => $apiAddress,
            'user_agent' => $userAgent,
            'page_url' => $pageUrl,
        ];

        if ($this->isGuestExists($criteria)) {
            return $this->update($criteria);
        }

        $newGuest = [
            'ip_address' => $apiAddress,
            'user_agent' => $userAgent,
            'page_url' => $pageUrl,
            'view_date' => date("Y-m-d H:i:s"),
            'views_count' => 1,
        ];

        return $this->create($newGuest);
    }

    /**
     * @param array $criteria
     *
     * @return bool
     */
    public function isGuestExists(array $criteria): bool
    {
        $query = 'SELECT COUNT(*) as c FROM ' . $this->tableName . ' WHERE ';
        $query = $this->queryMapper->mapConditionsCriteriaToQuery($criteria, $query);

        $result = $this->database->fetchAssocQuery($query);

        return (bool)$result['c'];
    }

    /**
     * @param array $guest
     *
     * @return array
     */
    public function create(array $guest): array
    {
        $query = 'INSERT INTO ' . $this->tableName . ' ';
        $query = $this->queryMapper->mapNewGuestDataToQuery($guest, $query);
        $result = $this->database->fetchAssocQuery($query);

        return $result;
    }

    /**
     * @param array $guest
     *
     * @return array
     */
    public function update(array $guest): array
    {
        $query = 'UPDATE ' . $this->tableName . ' SET views_count = views_count + 1 WHERE ';

        $i = 1;
        foreach ($guest as $field => $value) {
            if ($i !== 1) {
                $query .= ' AND ';
            }

            $query .= $field . '=\'' . $value . '\'';
            $i++;
        }

        return $this->database->fetchAssocQuery($query);
    }
}