<?php

class GuestBookController
{
    /**
     * @return void
     */
    public function saveGuest(): void
    {
        $database = new Database();
        $queryMapper = new QueryMapper();
        $guestBook = new GuestBook($database, $queryMapper);
        $guestBook->save();
    }
}