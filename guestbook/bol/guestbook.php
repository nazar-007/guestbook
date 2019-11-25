<?php

class GUESTBOOK_BOL_Guestbook extends OW_Entity
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $surname;
    /**
     * @var string
     */
    public $avatar;
    /**
     * @var int
     */
    public $createStamp;

    public function getAvatarUrl()
    {
        return OW::getPluginManager()->getPlugin('guestbook')->getUserFilesUrl() . $this->avatar;
    }

    public function getAvatarPath()
    {
        return OW::getPluginManager()->getPlugin('guestbook')->getUserFilesDir() . $this->avatar;
    }
}
