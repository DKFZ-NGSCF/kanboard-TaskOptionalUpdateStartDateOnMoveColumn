<?php

namespace Kanboard\Plugin\TaskOptionalUpdateStartDateOnMoveColumn\Action;

use Kanboard\Model\TaskModel;
use Kanboard\Action\Base;

/**
 * Set the start date when a task is moved away from a specific column (if start date is not set)
 *
 * @package Kanboard\Action
 */
class TaskOptionalUpdateStartDateOnMoveFromColumn extends Base
{
    /**
     * Get automatic action description
     *
     * @access public
     * @return string
     */
    public function getDescription()
    {
        return t('Assign a start date when moved from a specific column (if start date is not set)');
    }

    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            TaskModel::EVENT_MOVE_COLUMN,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'src_column_id' => t('Source column'),
            'check_box_start_date' => t('Only if task has no start date (true/false)'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'task' => array(
                'project_id',
            ),
            'src_column_id',
        );
    }

    /**
     * Execute the action (set the task date_started)
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $values = array(
            'id' => $data['task_id'],
            'date_started' => time(),
        );

        return $this->taskModificationModel->update($values, false);
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        if ($this->getParam('check_box_start_date') == true) {
            return $data['task']['date_started'] == 0 && $data['src_column_id'] == $this->getParam('src_column_id');
        } else {
            return $data['task']['date_started'] != 0 && $data['src_column_id'] == $this->getParam('src_column_id');
        }
    }
}