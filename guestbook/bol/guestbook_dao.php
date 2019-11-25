<?php

class GUESTBOOK_BOL_GuestbookDao extends OW_BaseDao
{
    /**
     * Singleton instance.
     *
     * @var GUESTBOOK_BOL_GuestbookDao
     */
    private static $classInstance;
    const LIMIT = 5;

    /**
     * Returns an instance of class.
     *
     * @return GUESTBOOK_BOL_GuestbookDao
     */
    public static function getInstance()
    {
        if ( self::$classInstance === null )
        {
            self::$classInstance = new self();
        }
        return self::$classInstance;
    }
    
    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * @see OW_BaseDao::getDtoClassName()
     *
     */
    public function getDtoClassName()
    {
        return 'GUESTBOOK_BOL_Guestbook';
    }

    /**
     * @see OW_BaseDao::getTableName()
     *
     */
    public function getTableName()
    {
        return OW_DB_PREFIX . 'guestbook';
    }

    public function getGuestbookCount()
    {
        return $this->countAll();
    }

    public function getGuestbookLimit()
    {
        return self::LIMIT;
    }

    public function getGuestbookList($first, $limit) {
        $sql = 'SELECT 
                * FROM ' . $this->getTableName() . ' 
                ORDER BY createStamp DESC 
                LIMIT :first, :limit';

        $queryParams = [
            'first' => $first,
            'limit' => $limit,
        ];

        return $this->dbo->queryForObjectList($sql, $this->getDtoClassName(), $queryParams);
    }

}