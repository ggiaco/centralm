<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('polcode_productmessage')} ADD `category_name` varchar(250);
ALTER TABLE {$this->getTable('polcode_productmessage')} ADD `subcategory_name` varchar(250);
");

$installer->endSetup();