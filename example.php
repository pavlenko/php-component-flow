<?php

namespace PE\Component\Flow;

require_once __DIR__ . '/vendor/autoload.php';

class CreateRecipients extends Node implements SubjectProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getSubjects(): SubjectCollection
    {
        return new SubjectCollection([new Subject('Recipient1')]);
    }

    /**
     * @inheritDoc
     */
    public function process(SubjectCollection $subjects = null): void
    {
        if ($subjects) {
            $subjects->setState($this->getName());
        }
    }
}

// Create flow
$flow = new Flow();

// Add nodes, each node name must be unique
$flow->addNode(new CreateRecipients('Create Recipients'));
$flow->addNode(new Node('Send Campaign 1.1'));
$flow->addNode(new Node('Send Campaign 2.1'));
$flow->addNode(new Node('Send Campaign 2.2'));
$flow->addNode(new Node('Send Campaign 3.1'));
$flow->addNode(new Node('Stop'));

// Add lines between nodes, for each line combination of source and target must be unique
// All nodes must be defined before this
$flow->addLine(new Line('Create Recipients', 'Send Campaign 1.1'));
$flow->addLine(new Line('Send Campaign 1.1', 'Send Campaign 2.1'));
$flow->addLine(new Line('Send Campaign 1.1', 'Send Campaign 2.2'));
$flow->addLine(new Line('Send Campaign 2.1', 'Send Campaign 3.1'));

$subject = new Subject();

// Execute flow with external subjects provider
$flow->process(new SubjectCollection([$subject]));

dump($subject);
