# Flow representation and execution component

## Requirements

The following versions of PHP are supported.

* PHP 7.1+

## Installation

To install, use composer:

```
php composer.phar require pe/component-cronos-planned
```

## Usage

Define flow for representation

```php
<?php
namespace PE\Component\Flow;

// Create flow instance
$flow = new Flow([new Node('A'), new Node('B')], [new Line('A', 'B')]);

// You can add nodes later
$flow->addNode(new Node('C'));

// You can add lines later, but only after adding all required nodes
$flow->addLine(new Line('B', 'C'));

// Then you can convert flow to some view
return [
    'label' => $flow->getLabel(),
    'nodes' => array_map(function (NodeInterface $node) {
        return [
            'id'    => $node->getID(),
            'label' => $node->getLabel()
        ];
    }, $flow->getNodes()),
    'lines' => array_map(function (LineInterface $line) {
        return [
            'sourceID' => $line->getSourceID(),
            'targetID' => $line->getTargetID(),
            'label'    => $line->getLabel(),
        ];
    }, $flow->getNodes()),
];
```

Define flow for execution

```php
<?php
namespace PE\Component\Flow;

// Minimal requirements for execute is implement SubjectProviderInterface
// You can implement interface in custom node class for self providing 
class SubjectProvider implements SubjectProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getSubjectCollection(string $id): SubjectCollection
    {
        return new SubjectCollection([new Subject('STATE1')]);
    }    
}

// And create node processor via extend Node::process() method
// Or pass callable to Node
$process = function (NodeInterface $node, SubjectCollection $collection) {
    //TODO Do some stuff here...
    $collection->setState('STATE2');
};

// Then you can create flow
$flow = new Flow(
    [new Node('STATE1'), $node = new Node('STATE2', $process)],
    [new Line('STATE1', 'STATE2')]
);

// For execute flow you need to create executor
$executor = new Executor(new SubjectProvider());
$executor->executeFlow($flow);

// Or you can execute single node, for step by step control
$executor->executeNode($node);
```
