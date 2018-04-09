<?php

namespace App\Presenters;

use Nette;


class BackendPresenter extends Nette\Application\UI\Presenter
{
    protected function startup()
    {
        parent::startup();
        $user = $this->getUser();
        if (!$user->isLoggedIn() || !$user->isAllowed("backend")) {
            throw new Nette\Application\ForbiddenRequestException;
        }
    }
}
