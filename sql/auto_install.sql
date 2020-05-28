DROP TABLE IF EXISTS `civicrm_debitcard_ledger`;
CREATE TABLE `civicrm_debitcard_ledger` (


     `id` int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Unique Ledger ID',
     `date` date NOT NULL   COMMENT 'Ledger date stamp',
     `datetime` datetime NOT NULL   COMMENT 'Ledger time stamp',
     `contact_id` int unsigned   DEFAULT null COMMENT 'FK to Contact',
     `machine_id` int unsigned    COMMENT 'Machine serial, maps to permissions in custom data',
     `is_debit` tinyint NOT NULL   COMMENT 'Debit or Credit, used to determine operator',
     `contribution_id` int unsigned   DEFAULT null COMMENT 'FK to Contribution',
     `job_time` int unsigned NOT NULL  DEFAULT 0 COMMENT 'Job time in seconds',
     `rate` int unsigned   DEFAULT 0 COMMENT 'Rate in cents',
     `amount` int    COMMENT 'Amount in cents',
     `member_store` int unsigned    COMMENT 'Container for recurring, non-accruing member credits in cents, consumed first by client',
     `pocket_store` int    COMMENT 'Container for out-of-pocket purchased credit in cents, consumed last by client',
     `prev_ledger_item` int unsigned    COMMENT 'Previous ledger id of contact, used for auditing',
     `prev_member_store` int unsigned    COMMENT 'Previous amount used for auditing',
     `prev_pocket_store` int    COMMENT 'Previous amount used for auditing',
     `is_test` tinyint NOT NULL   COMMENT 'Used for test mode',
     `notes` varchar(255)    COMMENT 'Used for documentation'
,
    PRIMARY KEY ( `id` )


,          CONSTRAINT FK_civicrm_debitcard_ledger_contact_id FOREIGN KEY (`contact_id`) REFERENCES `civicrm_contact`(`id`) ON DELETE SET NULL,          CONSTRAINT FK_civicrm_debitcard_ledger_contribution_id FOREIGN KEY (`contribution_id`) REFERENCES `civicrm_contribution`(`id`) ON DELETE SET NULL
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

