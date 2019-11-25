<?php

class GUESTBOOK_CLASS_FormDelete extends Form {
    const FORM_NAME = 'delete-guestbook';

    public function __construct()
    {
        parent::__construct(self::FORM_NAME);

        $this->setAction(OW::getRouter()->urlForRoute('guestbook.delete_guestbook'));
        $this->bindJsFunction('submit', 'guestbookConfirm');
    }
}
