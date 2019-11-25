<?php

class GUESTBOOK_CTRL_Index extends OW_ActionController
{
    private $serviceInstance;

    public function __construct()
    {
        parent::__construct();

        $this->serviceInstance = GUESTBOOK_BOL_Service::getInstance();
    }

    public function init()
    {
        $language = OW::getLanguage();

        $menuItems = array();

        $tabs = [
            ["label" => $language->text('guestbook', 'view_tab'), "url" => "guestbook.list"],
            ["label" => $language->text('guestbook', 'add_tab'), "url" => "guestbook.add_guestbook"],
        ];

        foreach ($tabs as $tab) {
            $item = new BASE_MenuItem();
            $item->setLabel($tab['label']);
            $item->setUrl(OW::getRouter()->urlForRoute($tab['url']));

            $menuItems[] = $item;
        }

        $this->addComponent('menu', new BASE_CMP_ContentMenu($menuItems));
    }


    public function viewList() {
        $page = !empty($_GET['page']) && (int) $_GET['page'] ? abs((int) $_GET['page']) : 1;
        $limit = $this->serviceInstance->getGuestbookLimit();
        $first = ( $page - 1 ) * $limit;

        $guestbookCount = $this->serviceInstance->getGuestbookCount();
        $pageCount = ceil($guestbookCount / $limit);

        $guestbook_list = $this->serviceInstance->getGuestbookList($first, $limit);

        $this->addComponent('paging', new BASE_CMP_Paging($page, $pageCount, $limit));
        $this->assign('guestbook_list', $guestbook_list);

        $this->addForm(new GUESTBOOK_CLASS_FormDelete());

        OW::getDocument()->addScript(OW::getPluginManager()->getPlugin('guestbook')->getStaticJsUrl() . 'guestbook.js');
        OW::getDocument()->addStyleSheet(OW::getPluginManager()->getPlugin('guestbook')->getStaticCssUrl() . 'guestbook.css');
    }

    public function addGuestbook()
    {
        $form = new GUESTBOOK_CLASS_GuestbookForm();

        if ($form->addProcess()) {
            $this->redirect(OW::getRouter()->urlForRoute('guestbook.list'));
        }

        $this->addForm($form);
    }

    public function deleteGuestbook()
    {
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $this->serviceInstance->deleteGuestBookByIds($ids);
        }

        $this->redirect(OW::getRouter()->urlForRoute('guestbook.list'));
    }
}
