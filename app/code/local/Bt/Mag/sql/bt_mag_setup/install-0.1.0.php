<?php
	$this->startSetup();
    
	$table = new Varien_Db_Ddl_Table();
	$table->setName($this->getTable('bt_mag/status'))
	      ->addColumn(
		      'status_id',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  10,
			  [   'auto_increment' => true,
				  'unsigned' => true,
				  'nullable'=> false,
				  'primary' => true,
				  'description' =>'Identifiant unique d\'un status de Mag'
			  ]
		  )
	      ->addColumn(
		      'name',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  9,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Statut d\'un mag (un seul activé - activer|désactivé)'
			  ]
		  )
          ->setOption('type', 'InnoDB')
          ->setOption('charset', 'utf8');
    $this->getConnection()->createTable($table);
	$table = new Varien_Db_Ddl_Table();
	$table->setName($this->getTable('bt_mag/article'))
	      ->addColumn(
		      'article_id',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  10,
			  [   'auto_increment' => true,
				  'unsigned' => true,
				  'nullable'=> false,
				  'primary' => true,
				  'description' =>'Identifiant unique de l\'article'
			  ],
			  'Id bloc'
		  )
		  ->addColumn(
		      'title',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'titre de l\'article en BO'
			  ],
			  'Titre bloc'	
		  )
		  ->addColumn(
		      'size',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'largeur del\'article en front (50%|100%)'
			  ],
			  'Taille'	
		  )
		  ->addColumn(
		      'category',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'définit si l\'article s\'étendra en front (Bloc simple|Bloc extensible)'
			  ],
			  'Catégorie'	
		  )
		  ->addColumn(
		      'background_color',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'définit la couleur de fond de l\'article en Front'
			  ],
			  'Couleur du fond'	
		  )
		  ->addColumn(
		      'img_path',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'définit l\'image affichée dans l\'article en front'
			  ],
			  'Visuel'	
		  )
		  ->addColumn(
		      'rubric',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'définit la rubrique affichée dans l\'article en front'
			  ],
			  'Rubrique'	
		  )
		  ->addColumn(
		      'title_1',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'titre de l\'article'
			  ],
			  'Titre Ligne 1'	
		  )
		  ->addColumn(
		      'title_2',
			  Varien_Db_Ddl_Table::TYPE_VARCHAR,
			  255,
			  [    'nullable' => false,
			       'description' =>'sous-titre de l\'article'
			  ],
			  'Titre Ligne 2'	
		  ) 
		  ->addColumn(
		      'content',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  null,
			  [    'nullable' => false,
			       'description' =>'corps de l\'article'
			  ],
			  'Contenu article'	
		  ) 
		  ->addColumn(
		      'update_time',
			  Varien_Db_Ddl_Table::TYPE_DATETIME,
			  null,
			  [    'nullable' => false,
			       'description' =>'date de la dernière mise à jour'
			  ]
		  )
		  ->addColumn(
		      'created_time',
			  Varien_Db_Ddl_Table::TYPE_DATETIME,
			  null,
			  [    'nullable' => false,
			       'description' =>'date de création'
			  ]
		  )
          ->setOption('type', 'InnoDB')
          ->setOption('charset', 'utf8');
    $this->getConnection()->createTable($table);
    
	$table = new Varien_Db_Ddl_Table();
	$table->setName($this->getTable('bt_mag/mag'))
	      ->addColumn(
		      'magazine_id',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  10,
			  [   'auto_increment' => true,
				  'unsigned' => true,
				  'nullable'=> false,
				  'primary' => true,
				  'description' =>'Identifiant unique du Mag'
			  ],
			  'Id bloc'
		  )
	      ->addColumn(
		      'under_number',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  255,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Sous numéro du Mag'
			  ],
			  'Sous n°'
		  )
	      ->addColumn(
		      'title',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  255,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Titre du Mag'
			  ],
			  'Titre'
		  )
	      ->addColumn(
		      'uri',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  255,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Url du Mag'
			  ],
			  'Clé url'
		  )
	      ->addColumn(
		      'push_forward',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  3,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Mag mis en avant (1 seul oui/non)'
			  ],
			  'Mis en avant'
		  )
	      ->addColumn(
		      'status',
			  Varien_Db_Ddl_Table::TYPE_TEXT,
			  9,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Mag (1 seul activer/désactivé)'
			  ],
			  'Statut'
		  )
		  ->addColumn(
		      'update_time',
			  Varien_Db_Ddl_Table::TYPE_DATETIME,
			  null,
			  [    'nullable' => false,
			       'description' =>'date de la dernière mise à jour'
			  ]
		  )
		  ->addColumn(
		      'created_time',
			  Varien_Db_Ddl_Table::TYPE_DATETIME,
			  null,
			  [    'nullable' => false,
			       'description' =>'date de création'
			  ]
		  )
          ->setOption('type', 'InnoDB')
          ->setOption('charset', 'utf8');
    $this->getConnection()->createTable($table);
    
	$table = new Varien_Db_Ddl_Table();
	$table->setName($this->getTable('bt_mag/mag_article'))
	      ->addColumn(
		      'mag_article_id',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  10,
			  [   'auto_increment' => true,
				  'unsigned' => true,
				  'nullable'=> false,
				  'primary' => true,
				  'description' =>'Identifiant unique de l\'association mag/article'
			  ],
			  'mag_article_id'
		  )
	      ->addColumn(
		      'mag_id',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  10,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Identifiant unique du mag'
			  ]
		  )
	      ->addColumn(
		      'article_id',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  10,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'Identifiant unique de l\'article'
			  ]
		  )
	      ->addColumn(
		      'position',
			  Varien_Db_Ddl_Table::TYPE_INTEGER,
			  2,
			  [
				  'unsigned' => true,
				  'nullable'=> false,
				  'description' =>'position de l\'article dans le mag'
			  ],
			  'position'
		  )
          ->setOption('type', 'InnoDB')
          ->setOption('charset', 'utf8');
    $this->getConnection()->createTable($table);
    $this->endSetup();
