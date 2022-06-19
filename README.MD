# Flow component

This component allows you to describe and execute complex processes. Unlike symfony/workflow, the logic is tied to node and the code resides in node processors.

## Installation

```bash
$ composer require pe/component-flow
```

## Usage

```php
<?php
namespace App;

use PE\Flow\Definition\Flow;
use PE\Flow\Definition\Link;
use PE\Flow\Definition\Node;
use PE\Flow\Definition\Port;
use PE\Flow\Processing\Executor;
use PE\Flow\Processing\ProcessorInterface;
use PE\Flow\Validation\Validator;

// Create flow (step order is important)
$flow = new Flow('flow', ['label' => 'Automation']);
// Step 1: add blocks
$flow->addNode(new Node('block1', 'start'))
$flow->addNode(new Node('block2', 'process'))
$flow->addNode(new Node('block3', 'stop'))
// Step 2: add blocks ports
$flow->addPort(new Port('port1', Port::TYPE_O, 'block1'));
$flow->addPort(new Port('port2', Port::TYPE_I, 'block2'));
$flow->addPort(new Port('port3', Port::TYPE_O, 'block2'));
$flow->addPort(new Port('port4', Port::TYPE_I, 'block3'));
// Step 3: link blocks ports
$flow->addLink(new Link('link1', 'port1', 'port2'));
$flow->addLink(new Link('link2', 'port3', 'port4'));

// For ensure flow is executable you can run validation
$isValid = (new Validator())->validate($flow, $messages);

if ($isValid) {
    // If valid you can execute flow
    // At least one processor required
    $processor = new class implements ProcessorInterface {
        public function getPriority(): int {
            return 0;
        }
    
        public function support(NodeInterface $node): bool {
            return 'process';
        }
    
        public function execute(NodeInterface $node, FlowInterface $flow): void {
            // Do some logic for block
        }
    }
    
    // Execution (chunked example)
    $executor = new Executor([$processor]);
    for ($i = 0; $i < 10, $i++) {
        $executor->execute($flow);
    }
} else {
    var_dump($messages);// Show errors in some way
}
```