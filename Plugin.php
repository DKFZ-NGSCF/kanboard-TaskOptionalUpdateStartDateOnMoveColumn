<?php

namespace Kanboard\Plugin\TaskOptionalUpdateStartDateOnMoveColumn;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\TaskOptionalUpdateStartDateOnMoveColumn\Action\TaskOptionalUpdateStartDateOnMoveFromColumn;
use Kanboard\Plugin\TaskOptionalUpdateStartDateOnMoveColumn\Action\TaskOptionalUpdateStartDateOnMoveFromToColumn;
use Kanboard\Plugin\TaskOptionalUpdateStartDateOnMoveColumn\Action\TaskOptionalUpdateStartDateOnMoveToColumn;

class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->register(new TaskOptionalUpdateStartDateOnMoveFromColumn($this->container));
        $this->actionManager->register(new TaskOptionalUpdateStartDateOnMoveFromToColumn($this->container));
        $this->actionManager->register(new TaskOptionalUpdateStartDateOnMoveToColumn($this->container));
    }

    public function getPluginName()
    {
        return 'TaskOptionalUpdateStartDateOnMoveColumn';
    }

    public function getPluginDescription()
    {
        return t('Assign a start date when moving from/to a (specific) column if no start date is set');
    }

    public function getPluginAuthor()
    {
        return 'Lasse Faber';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/DKFZ-NGSCF/kanboard-TaskAssignDueDateOnMoveColumnByPriority';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.43';
    }
}