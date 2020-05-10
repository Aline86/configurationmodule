<?php

require_once _PS_MODULE_DIR_ . '/configurationmodule/classes/Sample.php';
class ConfigurationModule extends Module
{
    public function __construct()
    {
        $this->author = 'Claire-Aline Haestie';
        $this->name = 'configurationmodule';
        $this->tab = 'administration';
        $this->version = '0.1.1';
        $this->need_instance = 0;
 
        parent::__construct();
 
        $this->displayName = $this->l('Prestashop sample Module');
        $this->description = $this->l('Prestashop sample Module with front controller');
    }
 
    /**
     * Installation du module
     * @return boolean
     */
    public function install()
    {
        
        return parent::install() && $this->_installTab();
                
        
    }
   
    /**
     * Désinstallation du module
     * @return boolean
     */
    public function uninstall()
    {
        return parent::uninstall()  && $this->_uninstallTab()  ;
    }
 
    /**
     * Création de la base de donnée
     * @return boolean
     */
   
 
    /**
     * Installation du controller dans le backoffice
     * @return boolean
     */
    protected function _installTab()
    {
        $tab = new Tab();
        $tab->class_name = 'ConfigurationPanel';
        $tab->module = $this->name;
        $tab->id_parent = (int)Tab::getIdFromClassName('DEFAULT');
        $tab->icon = 'settings_applications';
        $languages = Language::getLanguages();
        foreach ($languages as $lang) {
            $tab->name[$lang['id_lang']] = $this->l('Affichage des variables de configuration');
        }
        try {
            $tab->save();
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
 
        return true;
    }
    

        public function getHookController($hook_name)

        {
        // Inclusion du fichier du contrôleur
        require_once(dirname(__FILE__).'/controllers/admin/'.$hook_name.'.php');
        // Construction dynamique du nom du contrôleur
        $controller_name = $this->name.$hook_name.'Controller';
        // Instanciation du contrôleur
        $controller = new $controller_name();
        // Retourne le contrôleur
        return $controller;

        }

    public function hookActionCustomerGridDefinitionModifier(array $params)

    {

    return $controller = $this->getHookController('ConfigurationPanel');

    }
    
    /**
     * Désinstallation du controller admin
     * @return boolean
     */
    protected function _uninstallTab()
    {
        $idTab = (int)Tab::getIdFromClassName('ConfigurationPanel');
        if ($idTab) {
            $tab = new Tab($idTab);
            try {
                $tab->delete();
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        return true;
    }
 
    /**
     * Suppression de la base de données
     */
    
}