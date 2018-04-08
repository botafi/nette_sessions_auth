<?php

namespace App\Presenters;
use Nette;
use Nette\Application\UI;
use Nette\Security as NS;

class RegisterPresenter extends UI\Presenter
{
    public $database;

    function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    protected function createComponentRegisterForm()
    {
        $form = new UI\Form;
        $form->addText('username', 'Jméno:');
        $form->addPassword('password', 'Heslo:');
        $form->addSubmit('register', 'Zaregistrovat se');
        $form->onSuccess[] = [$this, 'registerFormSucceeded'];
        return $form;
    }

    public function registerFormSucceeded(UI\Form $form, $values)
    {
        $this->database->table('users')->insert([
            'username' => $values->username,
            'password' => NS\Passwords::hash($values->password),
            'role' => $this->getUser()->authenticatedRole
        ]);
        $this->flashMessage('Byl jste úspěšně zaregistrován.');
        $this->redirect('Homepage:');
    }
}
