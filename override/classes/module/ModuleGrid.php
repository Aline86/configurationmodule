<?php
abstract class ModuleGrid extends ModuleGridCore{
 
    protected $_configuration;
    
 
    protected $_values = array();
    
   
    protected $_totalCount = 0;
    
   
    protected $_title;
    

    protected $_start;
 
    protected $_limit;
    
  
    protected $_sort = null;
    

    protected $_direction = null;
  
    protected $_render;
 
    protected abstract function getData();

    public function setConfiguration($id_configuration)
    {
        $this->_configuration = new Configuration($id_configuration);
    }
    public function ajaxProcess()
    {
      $query = 'SELECT * FROM configuration';
      echo Tools::jsonEncode(array(
        'data'=> Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query),
        'fields_display' => $this->fieldsDisplay
      ));
      die();
    }
    public function setLang($id_lang)
    {
        $this->_id_lang = $id_lang;
    }
  
    public function create($render, $type, $width, $height, $start, $limit, $sort, $dir)
    {
        if (!Validate::isModuleName($render)) {
            die(Tools::displayError());
        }
        if (!Tools::file_exists_cache($file = _PS_ROOT_DIR_ . '/modules/' . $render . '/' . $render . '.php')) {
            die(Tools::displayError());
        }
        require_once $file;
        $this->_render = new $render($type);
        $this->_start = $start;
        $this->_limit = $limit;
        $this->_sort = $sort;
        $this->_direction = $dir;
        $this->getData();
        $this->_render->setTitle($this->_title);
        $this->_render->setSize($width, $height);
        $this->_render->setValues($this->_values);
        $this->_render->setTotalCount($this->_totalCount);
        $this->_render->setLimit($this->_start, $this->_limit);
    }

    public function render()
    {
        $this->_render->render();
    }

    public function engine($params)
    {
        Tools::dieObject($params);
        if (!($render = Configuration::get('PS_STATS_GRID_RENDER'))) {
            return Context::getContext()->getTranslator()->trans('No grid engine selected', array(), 'Admin.Modules.Notification');
        }
        if (!Validate::isModuleName($render)) {
            die(Tools::displayError());
        }
        if (!file_exists(_PS_ROOT_DIR_ . '/modules/' . $render . '/' . $render . '.php')) {
            return Context::getContext()->getTranslator()->trans('Grid engine selected is unavailable.', array(), 'Admin.Modules.Notification');
        }
        $grider = Context::getContext()->link->getAdminLink('AdminStats', true, [], ['action' => 'graphGrid', 'ajax' => 1, 'render' => $render, 'module' => Tools::safeOutput(Tools::getValue('module'))]);
        $context = Context::getContext();
        $grider .= '&id_configuration=' . (int) $context->configuration->id;
        $grider .= '&id_lang=' . (int) $context->language->id;
        if (!isset($params['width']) || !Validate::IsUnsignedInt($params['width'])) {
            $params['width'] = 600;
        }
        if (!isset($params['height']) || !Validate::IsUnsignedInt($params['height'])) {
            $params['height'] = 920;
        }
        if (!isset($params['start']) || !Validate::IsUnsignedInt($params['start'])) {
            $params['start'] = 0;
        }
        if (!isset($params['limit']) || !Validate::IsUnsignedInt($params['limit'])) {
            $params['limit'] = 40;
        }
        $grider .= '&width=' . $params['width'];
        $grider .= '&height=' . $params['height'];
        if (isset($params['start']) && Validate::IsUnsignedInt($params['start'])) {
            $grider .= '&start=' . $params['start'];
        }
        if (isset($params['limit']) && Validate::IsUnsignedInt($params['limit'])) {
            $grider .= '&limit=' . $params['limit'];
        }
        if (isset($params['type']) && Validate::IsName($params['type'])) {
            $grider .= '&type=' . $params['type'];
        }
        if (isset($params['option']) && Validate::IsGenericName($params['option'])) {
            $grider .= '&option=' . $params['option'];
        }
        if (isset($params['sort']) && Validate::IsName($params['sort'])) {
            $grider .= '&sort=' . $params['sort'];
        }
        if (isset($params['dir']) && Validate::isSortDirection($params['dir'])) {
            $grider .= '&dir=' . $params['dir'];
        }
        require_once _PS_ROOT_DIR_ . '/modules/' . $render . '/' . $render . '.php';
        return call_user_func(array($render, 'hookGridEngine'), $params, $grider);
    }
 
    public function getDate()
    {
        return ModuleGraph::getDateBetween($this->_configuration);
    }

    public function getLang()
    {
        return $this->_id_lang;
    }
}