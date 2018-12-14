<?php

namespace PE\Component\Flow;

$flow = new Flow('FLOW2');

$flow->addNode(new Node('Create Recipients'));
$flow->addNode(new Node('Send Campaign 1.1'));
$flow->addNode(new Node('Send Campaign 2.1'));
$flow->addNode(new Node('Send Campaign 2.2'));
$flow->addNode(new Node('Send Campaign 3.1'));
$flow->addNode(new Node('Stop'));

$flow->addLine(new Line('online', 'Create Recipients', 'Send Campaign 1.1'));
$flow->addLine(new Line('open', 'Send Campaign 1.1', 'Send Campaign 2.1'));
$flow->addLine(new Line('click', 'Send Campaign 1.1', 'Send Campaign 2.2'));
$flow->addLine(new Line('open', 'Send Campaign 2.1', 'Send Campaign 3.1'));

foreach ($flow->getNodes() as $node) {
    $nodes = $flow->getNodesBefore($node);

    foreach ($nodes as $item) {
        $target = $item->getTarget();
        $node->process($target);//TODO <-- where to get processing target
    }
}