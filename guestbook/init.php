<?php
OW::getRouter()->addRoute(new OW_Route('guestbook.list', 'guestbook/list', 'GUESTBOOK_CTRL_Index', 'viewList'));
OW::getRouter()->addRoute(new OW_Route('guestbook.add_guestbook', 'guestbook/add-guestbook', 'GUESTBOOK_CTRL_Index', 'addGuestbook'));
OW::getRouter()->addRoute(new OW_Route('guestbook.delete_guestbook', 'guestbook/delete-guestbook', 'GUESTBOOK_CTRL_Index', 'deleteGuestbook'));