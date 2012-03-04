<?php

return array(

'terms' => "CREATE TABLE %s (
  term_id bigint(20) NOT NULL auto_increment,
  name varchar(55) NOT NULL default '',
  slug varchar(200) NOT NULL default '',
  term_group bigint(10) NOT NULL default 0,
  PRIMARY KEY  (term_id),
  UNIQUE KEY slug (slug)
)",

'term_taxonomy' => "CREATE TABLE %s (
  term_taxonomy_id bigint(20) NOT NULL auto_increment,
  term_id bigint(20) NOT NULL default 0,
  taxonomy varchar(32) NOT NULL default '',
  description longtext NOT NULL,
  parent bigint(20) NOT NULL default 0,
  count bigint(20) NOT NULL default 0,
  PRIMARY KEY  (term_taxonomy_id),
  UNIQUE KEY term_id_taxonomy (term_id,taxonomy)
)",

'term_relationships' => "CREATE TABLE %s (
  object_id bigint(20) NOT NULL default 0,
  term_taxonomy_id bigint(20) NOT NULL default 0,
  PRIMARY KEY  (object_id,term_taxonomy_id),
  KEY term_taxonomy_id (term_taxonomy_id)
)"

);

?>
