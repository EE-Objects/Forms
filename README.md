# EE Objects Forms

Provides helper objects for generating shared/forms that allow for validation on a per form basis.  

### The Problems This Solve

Sometimes you just need a simple form that isn't related to any specific data model. This library provides that plus removes the burden of handling Validation of the data. 


## Requirements
- ExpressionEngine >= 5.5
- PHP >= 7.1
 
## Installation

Add `ee-objects/forms` as a requirement to your `composer.json`:

```bash
$ composer require ee-objects/forms
```

### Implementation

Once installed, the programmatic flow should be simple. Get the form, validate it, process it:

```php

$form = new MyFormObject()
$defaults = [];
$vars = [];
$form->setData($this->settings->settings('cartthrob'));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$form->setData($_POST);
	$result = $form->validate($_POST);
	if ($result->isValid()) {
        //magic time
	}

    $vars['errors'] = $result;
}

$vars['sections'] = $form->generate();
```

## Docs

Available in the [Wiki](https://github.com/EE-Objects/Forms/wiki "Wiki") and the [EeObjects Addon](https://github.com/EE-Objects/Example-Addon) repository
