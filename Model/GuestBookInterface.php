<?php

interface GuestBookInterface
{
    /**
     * @return array
     */
    public function save(): array;

    /**
     * @param array $criteria
     *
     * @return bool
     */
    public function isGuestExists(array $criteria): bool;

    /**
     * @param array $guest
     *
     * @return array
     */
    public function create(array $guest): array;

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function update(array $guest): array;
}