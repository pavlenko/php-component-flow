<?php

namespace PE\Component\Flow;

$flow = new Flow();//TODO initial state must be already defined?

$flow->addState('start');//TODO <-- this is state for target
$flow->addState('wait_for_send');
$flow->addState('wait_for_event');
$flow->addState('stop');

$flow->addTransition($t = new Transition('create_recipient', 'start', 'wait_for_send'));//TODO this is processing target logic
$flow->addTransition(new Transition('send', 'wait_for_send', 'wait_for_event'));

$flow->applyTo(new Target('start'));

$t->applyTo(new Target('start'));//TODO this change state of target