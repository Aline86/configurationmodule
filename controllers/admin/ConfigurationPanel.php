<?php
require_once _PS_MODULE_DIR_ . '/configurationmodule/classes/Sample.php';
class ConfigurationPanelController extends ModuleAdminController
{
public function __construct()
    {
        
        parent::__construct();
        $this->bootstrap = true;
        $this->table='configuration';
        $this->identifier = 'id_configuration';
        $this->className='ConfigurationModule';
        $this->allow_export = true;
        $this->fields_list =  [           
        'id_configuration' => [ //nom du champ sql
            'title' => $this->module->l('ID CONFIGURATION'), //Titre
            'align' => 'center', // Alignement
            'class' => 'fixed-width-xs' //classe css de l'élément
        ],
        'id_shop_group' => [ //nom du champ sql
            'title' => $this->module->l('ID SHOP GROUP'), //Titre
            'align' => 'center', // Alignement
            'class' => 'fixed-width-xs' //classe css de l'élément
        ],
        'id_shop' => [ //nom du champ sql
            'title' => $this->module->l('ID SHOP'), //Titre
            'align' => 'center', // Alignement
            'class' => 'fixed-width-xs' //classe css de l'élément
        ],
        'name' => [
            'title' => $this->module->l('name'),
            'align' => 'left',
        ],
        'value' => [
            'title' => $this->module->l('value'),
            'align' => 'left',
        ],
        'date_add' => [
            'title' => $this->module->l('DATE ADD'),
            'align' => 'left',
        ],
        'date_upd' => [
            'title' => $this->module->l('DATE UPD'),
            'lang' => true, //Flag pour dire d'utiliser la langue
            'align' => 'left',
        ]];
        
        $this->addRowAction('view');
        $this->addRowAction('delete');
        $this->addRowAction('edit');

        $this->fields_form = [
          'legend' => [
            'title' => 'Variables de Configuration',
            'icon' => 'icon-list-ul'
          ],
          'input' => [
            ['name'=>'id_shop_group','type'=>'number','label'=>'id shop group',],
            ['name'=>'id_shop','type'=>'number','label'=>'id shop',],
            ['name'=>'name','type'=>'text','label'=>'name',],
            ['name'=>'value','type'=>'number','label'=>'value',],
            ['name'=>'date_add','type'=>'date','label'=>'date_add','suffix'=>'YYYY-MM-DD HH:mm',],
            ['name'=>'date_upd','type'=>'date','label'=>'date_upd','suffix'=>'YYYY-MM-DD HH:mm',],
          ],
          'submit' => [
            'title' => $this->trans('Save', [], 'Admin.Actions'),
          ]
        ];
    
        }
        public function renderForm()
    {
        //Définition du formulaire d'édition
        $this->fields_form = [
            //Entête
            'legend' => [
                'title' => $this->module->l('Edit Sample'),
                'icon' => 'icon-cog'
            ],
            //Champs
            'input' => [
                [
                    'type' => 'number', //Type de champ
                    'label' => $this->module->l('id_shop_group'), //Label
                    'name' => 'id_shop_group', //Nom
                    'class' => 'input fixed-width-sm', //classes css
                    'size' => 50, //longueur maximale du champ
                    'required' => true, //Requis ou non
                    'empty_message' => $this->l('Please fill the id shop'), //Message d'erreur si vide
                    'hint' => $this->module->l('Enter sample name') //Indication complémentaires de saisie
                ],
                [
                    'type' => 'number',
                    'label' => $this->module->l('id_shop'),
                    'name' => 'id_shop',
                    'class' => 'input fixed-width-sm',
                    'size' => 5,
                    'required' => true,
                    'empty_message' => $this->module->l('Please fill the id shop'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->module->l('name'),
                    'name' => 'name',
                    'class' => 'input fixed-width-sm',
                    'size' => 5,
                    'required' => true,
                    'empty_message' => $this->module->l('Please fill name'),
                ],
                [
                    'type' => 'number',
                    'label' => $this->module->l('value'),
                    'name' => 'value',
                    'class' => 'input fixed-width-sm',
                    'lang' => true, //Flag pour utilisation des langues
                    'required' => true,
                    'empty_message' => $this->l('Please fill the value'),
                ],
                [
                    'type' => 'date',
                    'label' => $this->module->l('date add'),
                    'name' => 'date_add',
                    'class' => 'input fixed-width-sm',
                    'lang' => true, //Flag pour utilisation des langues
                    'required' => true,
                    'empty_message' => $this->l('Please fill the value'),
                ],
                [
                    'type' => 'date',
                    'label' => $this->module->l('date upd'),
                    'name' => 'date_upd',
                    'lang' => true,
                    'required' => true,
                    'empty_message' => $this->l('Please updtae de the date'),
                ],
            ],
            //Boutton de soumission
            'submit' => [
                'title' => $this->l('Save'), //On garde volontairement la traduction de l'admin par défaut
            ]
        ];
        return parent::renderForm();
    }
       
    }
