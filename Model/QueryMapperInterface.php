<?php

interface QueryMapperInterface
{
    /**
     * @param array $criteria
     * @param string $query
     *
     * @return string
     */
    public function mapConditionsCriteriaToQuery(array $criteria, string $query): string;

    /**
     * @param array $newGuest
     * @param string $query
     *
     * @return string
     */
    public function mapNewGuestDataToQuery(array $newGuest, string $query): string;
}