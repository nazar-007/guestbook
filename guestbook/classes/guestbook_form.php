<?php

class GUESTBOOK_CLASS_GuestbookForm extends Form
{
    private $serviceInstance;

    const FORM_NAME = 'add-guestbook';

    public function __construct()
    {
        parent::__construct(self::FORM_NAME);
        $this->serviceInstance = GUESTBOOK_BOL_Service::getInstance();

        $language = Ow::getLanguage();
        $this->setEnctype(FORM::ENCTYPE_MULTYPART_FORMDATA);

        $name = new TextField('name');
        $name->setLabel($language->text('guestbook', 'name_label'));
        $name->setRequired();
        $this->addElement($name);

        $surname = new TextField('surname');
        $surname->setLabel($language->text('guestbook', 'surname_label'));
        $surname->setRequired();
        $this->addElement($surname);

        $avatar = new FileField('avatar');
        $avatar->setLabel($language->text('guestbook', 'avatar_label'));
        $avatar->addAttribute('accept', 'image/jpeg,image/png,image/gif');
        $avatar->addValidator(new AvatarValidator());
        $this->addElement($avatar);

        $submit = new Submit('go');
        $submit->setValue($language->text('guestbook', 'submit_button'));
        $this->addElement($submit);
    }

    public function addProcess() {
        if ( OW::getRequest()->isPost() && $this->isValid($_POST)) {
            $data = $this->getValues();

            $name = uniqid() . '_' . $_FILES['avatar']['name'];
            $destination = OW::getPluginManager()->getPlugin('guestbook')->getUserFilesDir() . $name;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destination))
            {
                $data['avatar'] = $name;
            }

            return $this->serviceInstance->addGuestbook($data);
        }
    }
}

class AvatarValidator extends OW_Validator {
    public function __construct()
    {
        $this->errorMessage = OW::getLanguage()->text('guestbook', 'avatar_error_msg');
    }

    public function getJsValidator()
    {
        return "{
            validate : function( value ){
                if (!value) {
                    throw " . json_encode($this->errorMessage) . ";
                }
            }
        }";
    }

    function isValid($value)
    {
        return !empty($_FILES['avatar']) &&
            $_FILES['avatar']['error'] === UPLOAD_ERR_OK &&
            in_array($_FILES['avatar']['type'], array('image/jpeg', 'image/png', 'image/gif'), true) &&
            is_uploaded_file($_FILES['avatar']['tmp_name']);
    }
}