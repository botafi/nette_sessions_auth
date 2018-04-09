<?php

namespace App\Presenters;

use Nette;


class CounterPresenter extends Nette\Application\UI\Presenter
{
    function renderDefault() {
        $counter = $this->getSession("counter");
        $counter->value = $counter->value ? $counter->value + 1 : 1;
        $this->template->counter = $counter->value;
    }
}
