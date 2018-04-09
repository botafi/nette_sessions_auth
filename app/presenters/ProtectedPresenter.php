<?php

namespace App\Presenters;

use Nette;


class ProtectedPresenter extends Nette\Application\UI\Presenter
{
    protected function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            throw new Nette\Application\ForbiddenRequestException;
        }
    }
    function renderDefault() {
        $user = $this->getUser();
        $this->template->isLoggedIn = $user->isLoggedIn();
        $this->template->username = $user->getIdentity()->username;
    }
}
