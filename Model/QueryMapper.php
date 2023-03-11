<?php

require_once('QueryMapperInterface.php');

class QueryMapper implements QueryMapperInterface
{
    /**
     * @param array $criteria
     * @param string $query
     *
     * @return string
     */
    public function mapConditionsCriteriaToQuery(array $criteria, string $query): string
    {
        $i = 1;
        foreach ($criteria as $field => $value) {
            if ($i !== 1) {
                $query .= ' AND ';
            }
            $query .= $field . '=\'' . $value . '\'';
            $i++;
        }

        return $query;
    }

    /**
     * @param array $newGuest
     * @param string $query
     *
     * @return string
     */
    public function mapNewGuestDataToQuery(array $newGuest, string $query): string
    {
        $fields = array_keys($newGuest);
        $values = array_values($newGuest);

        $query .= '(' . implode(',', $fields) . ') VALUES (\'' . implode('\',\'', $values) . '\')';

        return $query;
    }
}