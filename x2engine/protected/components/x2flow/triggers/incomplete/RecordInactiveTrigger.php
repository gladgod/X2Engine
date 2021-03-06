<?php
/*****************************************************************************************
 * X2Engine Open Source Edition is a customer relationship management program developed by
 * X2Engine, Inc. Copyright (C) 2011-2014 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2ENGINE, X2ENGINE DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. P.O. Box 66752, Scotts Valley,
 * California 95067, USA. or at email address contact@x2engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 *****************************************************************************************/

/**
 * X2FlowTrigger 
 * 
 * @package application.components.x2flow.actions
 */
class RecordInactiveTrigger extends X2FlowTrigger {
	public $title = 'Record Inactivity';
	public $info = 'Cronjob must be configured for this to work reliably.';
	
	public function paramRules() {
		return array(
			'title' => Yii::t('studio',$this->title),
			'info' => Yii::t('studio',$this->info),
			'modelClass' => 'modelClass',
			'options' => array(
				array('name'=>'modelClass','label'=>Yii::t('studio','Record Type'),'type'=>'dropdown','options'=>X2Model::getModelTypes(true)),
				array('name'=>'duration','type'=>'numeric','label'=>Yii::t('studio','Duration (s)')),
			));
	}
	
	public static function checkCondition($condition,&$params) {
		if(isset($condition['name']) && $condition['name'] === 'duration') {
			if($params['model']->hasAttribute('lastActivity'))
				return array ($params['model']->lastActivity < time() - (int)$condition->value,
                    '');
			elseif($params['model']->hasAttribute('lastUpdated'))
				return array ($params['model']->lastUpdated < time() - (int)$condition->value,
                    '');
			else
				return array (false, '');
		} else {
			return parent::checkCondition($condition,$params);
		}
	}
}
