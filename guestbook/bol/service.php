<?php

class GUESTBOOK_BOL_Service
{
    /**
     * Singleton instance.
     *
     * @var CONTACTUS_BOL_Service
     */
    private static $classInstance;
    private $daoInstance;
    private $dbo;
    /**
     * Returns an instance of class (singleton pattern implementation).
     *
     * @return GUESTBOOK_BOL_Service
     */
    public static function getInstance()
    {
        if (self::$classInstance === null) {
            self::$classInstance = new self();
        }

        return self::$classInstance;
    }

    private function __construct()
    {
        $this->daoInstance = GUESTBOOK_BOL_GuestbookDao::getInstance();
    }

    public function getGuestbookList($first, $limit)
    {
        return $this->daoInstance->getGuestbookList($first, $limit);
    }

    public function getGuestbookLimit()
    {
        return $this->daoInstance->getGuestbookLimit();
    }

    public function getGuestbookCount()
    {
        return $this->daoInstance->getGuestbookCount();
    }

    public function addGuestbook($data)
    {
        $guestbook = new GUESTBOOK_BOL_Guestbook();
        $guestbook->name = $data['name'];
        $guestbook->surname = $data['surname'];
        $guestbook->avatar = $data['avatar'];
        $guestbook->createStamp = time();
        $this->daoInstance->save($guestbook);

        return $guestbook;
    }


    public function deleteGuestBookByIds(array $ids)
    {
        foreach ($ids as $id) {
            $entity = $this->daoInstance->findById($id);
            unlink($entity->getAvatarPath());
        }
        $this->daoInstance->deleteByIdList($ids);
    }

}