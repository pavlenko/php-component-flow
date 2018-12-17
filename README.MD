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
    'nodes' => array_map(function (Node $node) {
        return [
            'id'    => $node->getID(),
            'label' => $node->getLabel()
        ];
    }, $flow->getNodes()),
    'lines' => array_map(function (Line $line) {
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

// Create node processor via extend Node::process() method
// Or pass callable to Node
$process = function (array $subjects, array &$options = [], NodeInterface $node) {
    //TODO Do some stuff here...
};

// Then you can create flow
$flow = new Flow(
    [new Node('STATE1'), $node = new Node('STATE2', $process)],
    [new Line('STATE1', 'STATE2')]
);

// For execute flow you need to create executor
$executor = new Executor($flow);
$executor->execute($options);

// Or you can execute single node, for step by step control
$executor->execute($options, 'NODE1');
```
