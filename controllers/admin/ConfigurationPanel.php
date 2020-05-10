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
        $this->name='ConfigurationPanel';
        $this->initList();
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
       
        $this->fields_list = [
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
            ],            // For type == select only. Content for the select drop down filter list (optional).
                  ['filter_key'] => 'cl\!id_configuration',           // Define a custom filter key to be used by the filter SQL request
                                                                 // (optional, default uses the array key name, i.e. 'country').
                  ['orderby'] => 'true',                  // If true, list will be alphabetically ordered using this column values (optional, default false).
                  ['search'] => 'true',                   // If true, this column will have a search field (optional, default true).
                  ['image'] => 's',                              // If set, an image will be displayed in this field located in the '/img' subfolder defined as value here (optional).
                  ['image_id'] => 3,                             // If 'image' is set and if 'image_id' is set, it will be used as the image filename,
                                                                 // else the record item id will be used (optional)
    
            ['active'] => 'status',                        // If set, the field will be replaced by a clickable boolean switch for the item field (i.e. 'status').
            // An icon will display the current status.
            ['activeVisu'] => 'new_window',                // If set, the field will be replaced by an icon depending on the boolean value
                        // of the field specified (i.e. 'new_window') (optional).
             // If set, the return value of the defined method call
                                //  will be used as the field content (optional).                  // If set in combination with 'callback', the method will be called from the provided object
                        // instead of the current controller (optional).
                                       // If set, it will be displayed after the field value (optional).
            ['currency'] => 'true',                 // If set and type == price, the currency displayed
                        // will use the item currency and not the default currency (optional).
            ['maxlength'] => 90,                           // If set, the field value will be truncated if it has more characters than the numeric value set (optional).
            ['position'] => 'position',                    // If set to position, the field will display arrows
                        // and be drag and droppable, which will update position in db (optional).
            ['tmpTableFilter'] => 'true',           // If set to true, the WHERE clause used to filter results
                        // will use the $_tmpTableFilter variable (optional, default false).
            ['havingFilter'] => 'true',             // If set to true, the WHERE clause used to filter results
                        // will use the $_filterHaving variable (optional, default false).
            ['filter_type'] => 'int', // Specify the value format when used in the filter where clause.
                        // Useful when "filter_type" is different from "type" (i.e. type == select) (optional).
            ['color'] => 'color',                          // If set, the field value will appear inside a colored element.
                        // The color used is the "color" index of the record and is in HTML name or hexadecimal format (optional).
            // The hint will appear on column name hover (optional).
            ['ajax'] => 'true'  
        ];
        return parent::renderForm();
    }

    private function initList()
{
    $this->fields_list = [
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
    
    $helper = new HelperList();
    $helper->simple_header = false;
    $helper->shopLinkType = '';
     
    $helper->simple_header = true;
     
    // Actions to be displayed in the "Actions" column
    $helper->actions = array('edit', 'delete', 'view');
     
    $helper->identifier = 'id_configuration';
    $helper->show_toolbar = true;
    $helper->title = 'HelperList';
    $helper->table = 'ps_configuration'.'_configuration';
     
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure=ps_configuration';
    return $helper;
}
   
public function postProcess()
{
    
 if (Tools::isSubmit('submitAdd'.$this->table))
 {
  // Create Object ExampleData
    $this->_defaultOrderBy = 'position';
    $this->_defaultOrderWay = 'ASC';
  $exemple_data = new ExampleData();
  $exemple_data->exampledate = array();
  $languages = Language::getLanguages(false);
   foreach ($languages as $language)
 $exemple_data->name[$language['id_lang']] = Tools::getValue('name_'.$language['id_lang']);
  // Save object
  if (!$exemple_data->save())
   $this->errors[] = Tools::displayError('An error has occurred: Can\'t save the current object');
  else
   Tools::redirectAdmin(self::$currentIndex.'&conf=4&token='.$this->token);
 }
}  

    }
