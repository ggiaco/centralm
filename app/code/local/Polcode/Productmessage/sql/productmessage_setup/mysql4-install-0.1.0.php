<?php

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$this->getTable('polcode_productmessage')};
CREATE TABLE {$this->getTable('polcode_productmessage')}(
`productmessage_id` int(11) unsigned NOT NULL auto_increment,
`product_id` int(11),
`name` varchar(250),
`email` varchar(250),
`phone` varchar(20),
`message` text,
`product_name` varchar(200),
PRIMARY KEY (`productmessage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();