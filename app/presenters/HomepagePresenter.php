<?php

namespace App\Presenters;

use Nette;


class HomepagePresenter extends Nette\Application\UI\Presenter
{
    function renderDefault() {
        $user = $this->getUser();
        $this->template->isLoggedIn = $user->isLoggedIn();
        $this->template->username = $user->getIdentity()->username;
    }
}
