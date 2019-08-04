<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CodeGenerator config overrides
    |--------------------------------------------------------------------------
    |
    | It is a good idea to sperate your configuration form the code-generator's
    | own configuration. This way you won't lose any settings/preference
    | you have when upgrading to a new version of the package.
    |
    | Additionally, you will always know any the configuration difference between
    | the default config than your own.
    |
    | To override the setting that is found in the codegenerator.php file, you'll
    | need to create identical key here with a different value
    |
    | IMPORTANT: When overriding an option that is an array, the configurations
    | are merged together using php's array_merge() function. This means that
    | any option that you list here will take presence during a conflict in keys.
    |
    | EXAMPLE: The following addition to this file, will add another entry in
    | the common_definitions collection
    |
    |   'common_definitions' =>
    |   [
    |       [
    |           'match' => '*_at',
    |           'set' => [
    |               'css-class' => 'datetime-picker',
    |           ],
    |       ],
    |   ],
    |
     */


    'template' => 'custom',

    /*
    |--------------------------------------------------------------------------
    | The default path of where the uploaded files live.
    |--------------------------------------------------------------------------
    |
    | You can use Laravel Storage filesystem. By default, the code-generator
    | uses the default file system.
    | For more info about Laravel's file system visit
    | https://laravel.com/docs/5.5/filesystem
    |
     */
    'files_upload_path' => 'uploads',



    /*
    |--------------------------------------------------------------------------
    | Non-Field base labels to be replaced in the views.
    |--------------------------------------------------------------------------
    |*/

    'placeholder_by_html_type' => [
        'text' => 'Entrer [% field_name %] ici...',
        'number' => 'Entrer [% field_name %] ici...',
        'password' => 'Entrer [% field_name %] ici...',
        'email' => 'Entrer [% field_name %] ici...',
        'select' => 'Selectionner [% field_name %]',
        'multipleSelect' => 'Selectionner [% field_name %]',
    ],

    'generic_view_labels' => [
        'create' => [
            'text' => 'Ajouter [% model_name_title %]',
            'template' => 'create_model',
        ],
        'delete' => [
            'text' => 'Supprimer [% model_name_title %]',
            'template' => 'delete_model',
            'in-function-with-collective' => true,
        ],
        'edit' => [
            'text' => 'Modifier [% model_name_title %]',
            'template' => 'edit_model',
        ],
        'show' => [
            'text' => 'Afficher [% model_name_title %]',
            'template' => 'show_model',
        ],
        'show_all' => [
            'text' => 'Afficher tous les [% model_name_title %]',
            'template' => 'show_all_models',
        ],
        'add' => [
            'text' => 'Ajouter',
            'template' => 'add',
            'in-function-with-collective' => true,
        ],
        'update' => [
            'text' => 'Mettre à jour',
            'template' => 'update',
            'in-function-with-collective' => true,
        ],
        'confirm_delete' => [
            'text' => 'Supprimer [% model_name_title %]?',
            'template' => 'confirm_delete',
            'in-function-with-collective' => true,
        ],
        'none_available' => [
            'text' => 'Aucun [% model_name_title %] Trouvé!',
            'template' => 'no_models_available',
        ],
        'model_plural' => [
            'text' => '[% model_name_plural_title %]',
            'template' => 'model_plural',
        ],
        'model_was_added' => [
            'text' => 'Le [% model_name_title %] a été ajouté avec succès',
            'template' => 'model_was_added',
        ],
        'model_was_updated' => [
            'text' => 'Le [% model_name_title %] a été modifié avec succès!',
            'template' => 'model_was_updated',
        ],
        'model_was_deleted' => [
            'text' => 'Le [% model_name_title %] a été supprimé avec succès!',
            'template' => 'model_was_deleted',
        ],
        'unexpected_error' => [
            'text' => 'Une erreur inconnue a été trouvée!',
            'template' => 'unexpected_error',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Patterns to use to pre-set field's properties.
    |--------------------------------------------------------------------------
     */
    'common_definitions' => [
        [
            'match' => '*',
            'set' => [
                // You may use any of the field templates to create the label
                'labels' => '[% field_name_title %]',
            ],
        ],
        [
            'match' => ['title', 'name', 'label', 'subject', 'head*', 'nom', 'prenom', 'intitule', 'libelle'],
            'set' => [
                'is-nullable' => false,
                'data-type' => 'string',
                'data-type-params' => [255],
            ],
        ],
        [
            'match' => ['*count*', '*number*', 'age'],
            'set' => [
                'html-type' => 'number',
            ],
        ],
        [
            'match' => ['cout', 'total*', 'salaire*', 'montant*'],
            'set' => [
                'html-type' => 'text',
                'data-type' => 'decimal',
                "data-type-params" => [ 13, 2],
            ],
        ],
        [
            'match' => ['description*', 'detail*', 'message*'],
            'set' => [
                'is-on-index' => false,
                'html-type' => 'textarea',
                'data-type-params' => [1000],
            ],
        ],
        [
            'match' => ['picture', 'file', '*photo*', 'avatar', 'image', 'image*', '*path*'],
            'set' => [
                'is-on-index' => false,
                'html-type' => 'file',
            ],
        ],
        [
            'match' => ['*password*'],
            'set' => [
                'html-type' => 'password',
            ],
        ],
        [
            'match' => ['*email*'],
            'set' => [
                'html-type' => 'email',
            ],
        ],
        [
            'match' => ['*_id', '*_par'],
            'set' => [
                'data-type' => 'integer',
                'html-type' => 'select',
                'is-nullable' => false,
                'is-unsigned' => true,
                'is-index' => true,
            ],
        ],
        [
            'match' => ['*sexe*', '*genre*'],
            'set' => [
                'data-type' => 'string',
                'html-type' => 'radio',
                "options" => [
                    "Masculin" => "Masculin",
                    "Feminin" => "Feminin"
                ],
                'is-nullable' => false,
                "is-inline-options" => "true",
            ],
        ],
        [
            'match' => ['*_at'],
            'set' => [
                'data-type' => 'datetime',
            ],
        ],
        [
            'match' => ['created_at', 'updated_at', 'deleted_at'],
            'set' => [
                'data-type' => 'datetime',
                'is-on-form' => false,
                'is-on-index' => false,
                'is-on-show' => true,
            ],
        ],
        [
            'match' => ['date*', '*_le', 'jour*', '*arrive*', '*depart*', '*destination*', '*debut*', '*fin*'],
            'set' => [
                'data-type' => 'date',
                'date-format' => 'Y-m-d',
                'css-class' => 'datetime-picker',
            ],
        ],
        [
            'match' => ['est_*', 'a_*', 'is_*', 'with_*'],
            'set' => [
                'data-type' => 'boolean',
                'html-type' => 'checkbox',
                'is-nullable' => false,
                'options' => ["No", "Yes"],
            ],
        ],
        [
            'match' => ['tel*', 'phone*'],
            'set' => [
                'data-type' => 'string',
                'html-type' => 'tel',
                'is-nullable' => false,
            ],
        ],
    ],

];
