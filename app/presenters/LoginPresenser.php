<?php

namespace App\Presenters;
use Nette;
use Nette\Application\UI;

class LoginPresenter extends UI\Presenter
{
    protected function createComponentLoginForm()
    {
        $form = new UI\Form;
        $form->addText('username', 'Jméno:');
        $form->addPassword('password', 'Heslo:');
        $form->addSubmit('login', 'Přihlásit se');
        $form->onSuccess[] = [$this, 'loginFormSucceeded'];
        return $form;
    }

    public function loginFormSucceeded(UI\Form $form, $values)
    {
        try {
            $this->getUser()->login($values->username, $values->password);
            $this->flashMessage('Byl jste úspěšně přihlášen.');
            $this->redirect('Homepage:');
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage($e->getMessage());
        }
    }

    public function actionLogout() {
        $this->getUser()->logout();
        $this->redirect('Homepage:');
    }
}
