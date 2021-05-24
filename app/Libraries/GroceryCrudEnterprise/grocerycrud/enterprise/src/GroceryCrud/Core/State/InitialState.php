<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud;
use GroceryCrud\Core\Render\RenderAbstract;

class InitialState extends StateAbstract implements StateInterface
{

    public function getCachedData()
    {
        $render = new RenderAbstract();

        $cache = $this->gCrud->getCache();

        $output = $cache->getItem($this->getUniqueId() . '+data');

        $render->output = $output;
        $render->outputAsObject = json_decode($output);
        $render->isJSONResponse = true;

        return $render;
    }

    public function render()
    {
        $this->setInitialData();

        $output = $this->showInitData();

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;
    }

    public function showInitData()
    {
        $data = (object)[];
        $config = $this->gCrud->getConfig();

        $data->i18n = $this->_getI18n();
        $data->subject = (object) [
            'subject_single' => $this->gCrud->getSubject() !== null ? $this->gCrud->getSubject() : '',
            'subject_plural' => $this->gCrud->getSubjectPlural() !== null ? $this->gCrud->getSubjectPlural() : ''
        ];

        $actionButtons = $this->gCrud->getActionButtons();

        $operations = (object) array(
            'add' => $this->gCrud->getLoadAdd(),
            'edit' => $this->gCrud->getLoadEdit(),
            'read' => $this->gCrud->getLoadRead(),
            'deleteSingle' => $this->gCrud->getLoadDelete(),
            'deleteMultiple' => $this->gCrud->getLoadDeleteMultiple(),
            'exportData' => $this->gCrud->getLoadExport(),
            'print' => $this->gCrud->getLoadPrint(),
            'clone' => $this->gCrud->getLoadClone(),
            'actionButtons' => !empty($actionButtons)
        );

        $data->columns = $this->transformFieldsList($this->gCrud->getColumns(), $this->gCrud->getUnsetColumns());
        $data->addFields = $this->getAddFields();
        $data->editFields = $this->getEditFields();
        $data->cloneFields = $this->getCloneFields();
        $data->readFields = $this->transformFieldsList($this->gCrud->getReadFields(), $this->gCrud->getUnsetReadFields());
        $data->readOnlyAddFields = $this->gCrud->getReadOnlyAddFields();
        $data->readOnlyEditFields = $this->gCrud->getReadOnlyEditFields();
        $data->readOnlyCloneFields = $this->gCrud->getReadOnlyCloneFields();

        $data->paging = (object)[
            'defaultPerPage' => $config['default_per_page'],
            'pagingOptions'  => $config['paging_options']
        ];
        $data->config = (object)[
            'skin' => $this->getSkin(),
            'dateFormat' => $this->getDateFormat()
        ];
        $data->primaryKeyField = $this->getPrimaryKeyField();
        $data->fieldTypes = $this->filterTypesPrivateInfo($this->getFieldTypes());
        $data->fieldTypesAddForm = $this->filterTypesPrivateInfo($this->getFieldTypesAddForm());
        $data->fieldTypesEditForm = $this->filterTypesPrivateInfo($this->getFieldTypesEditForm());
        $data->fieldTypesReadForm = $this->filterTypesPrivateInfo($this->getFieldTypesReadForm());
        $data->fieldTypesCloneForm = $this->filterTypesPrivateInfo($this->getFieldTypesCloneForm());
        $data->fieldTypesColumns = $this->filterTypesPrivateInfo($this->getFieldTypeColumns());
        $data->operations = $operations;
        $data->extraConfiguration = $this->extraConfigurations();

        $data = $this->addcsrfToken($data);

        return $data;
    }

    public function extraConfigurations() {
        $data = (object)[];

        $config = $this->gCrud->getConfig();

        $hasTextEditor = count($this->gCrud->getTextEditorFields()) > 0;

        if ($hasTextEditor) {
            $data->textEditorType =
                array_key_exists('text_editor_type', $config) ? $config['text_editor_type'] : 'full';
        }

        if (array_key_exists('hash_in_url', $config)) {
            $data->hashInUrl = $config['hash_in_url'];
        }

        if (array_key_exists('open_in_modal', $config)) {
            $data->openInModal = $config['open_in_modal'];
        }

        return $data;
    }

    public function filterTypesPrivateInfo($fieldTypes) {
        foreach ($fieldTypes as &$fieldType) {
            if ($fieldType->dataType === GroceryCrud::FIELD_TYPE_UPLOAD) {
                unset($fieldType->options->uploadPath);
            }
            if ($fieldType->dataType === GroceryCrud::FIELD_TYPE_BLOB) {
                $fieldType->options = null;
            }
        }

        return $fieldTypes;
    }

    public function getPrimaryKeyField() {
        $cachedString = $this->getUniqueCacheName(self::WITH_TABLE_NAME) . '+primaryKeyField';
        if ($this->config['backend_cache'] && $this->isInCache($cachedString)) {
            return $this->getCacheItem($cachedString);
        }

        $primaryKey = $this->gCrud->getModel()->getPrimaryKeyField();

        if ($this->config['backend_cache']) {
            $this->gCrud->getCache()->setItem($cachedString, $primaryKey);
        }

        return $primaryKey;
    }

    public function getFullLanguagePath() {
        $config = $this->gCrud->getConfig();
        $language = $this->gCrud->getLanguage() !== null ? $this->gCrud->getLanguage() : $config['default_language'];

        $gCrudLanguagePath = $this->gCrud->getLanguagePath();

        if ($gCrudLanguagePath === null ) {
            return (__DIR__ . '/../../i18n/') . $language . '.php';
        }

        if (is_dir($gCrudLanguagePath)) {
            if (substr($gCrudLanguagePath, -1) !== '/') {
                $gCrudLanguagePath .= '/';
            }

            return $gCrudLanguagePath . $language . '.php';
        }

        // If this is not DIR we assume that we have the full path
        return $gCrudLanguagePath;
    }

    public function _getI18n()
    {
        $languagePath = $this->getFullLanguagePath();

        if (file_exists($languagePath)) {
            // Good old fashion way :)
            $i18nArray = include($languagePath);
            $i18n = (object)$i18nArray;
        } else {
            throw new \Exception('Language path "' . $languagePath . '" does not exist');
        }

        foreach ($this->gCrud->getLandStrings() as $name => $string) {
            $i18n->$name = $string;
        }

        if ($this->gCrud->getSubject() !== null) {
            $i18n->subject = $this->gCrud->getSubject();
        }

        if ($this->gCrud->getSubjectPlural() !== null) {
            $i18n->subject_plural = $this->gCrud->getSubjectPlural();
        }

        return $i18n;
    }
}