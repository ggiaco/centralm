<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE {$this->getTable('polcode_productmessage')} ADD `create_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
");

$installer->endSetup();