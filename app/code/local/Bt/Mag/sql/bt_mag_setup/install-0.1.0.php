<?php
	$this->startSetup();
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
          ->setOption('type', 'InnoDB')
          ->setOption('charset', 'utf8');
    $this->getConnection()->createTable($table);
    $this->endSetup();
