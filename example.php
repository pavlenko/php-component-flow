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


// CREATE FLOW VIA BUILDER
$builder = new Builder();

$builder->createNode('START');
$builder->createNode('FINISH');
$builder->createLine('LINE')->setFrom('START')->setTo('FINISH');

$flow1 = $builder->createFlow('FLOW');

// CREATE FLOW FROM OBJECTS
$flow = new Flow('FLOW2');

$flow->addNode(new Node('Create Recipients'));
$flow->addNode(new Node('Send Campaign 1.1'));
$flow->addNode(new Node('Send Campaign 2.1'));
$flow->addNode(new Node('Send Campaign 2.2'));
$flow->addNode(new Node('Send Campaign 3.1'));
$flow->addNode(new Node('Stop'));

$flow->addLine((new Line('online'))->setFrom('Create Recipients')->setTo('Send Campaign 1.1'));
$flow->addLine((new Line('open'))->setFrom('Send Campaign 1.1')->setTo('Send Campaign 2.1'));
$flow->addLine((new Line('click'))->setFrom('Send Campaign 1.1')->setTo('Send Campaign 2.2'));
$flow->addLine((new Line('open'))->setFrom('Send Campaign 2.1')->setTo('Send Campaign 3.1'));

foreach ($flow->getNodes() as $node) {
    $nodes = $flow->getNodesBefore($node);

    foreach ($nodes as $item) {
        $target = $item->getTarget();
        $node->process($target);//TODO <-- where to get processing target
    }
}