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

/*Yii::app()->clientScript->registerCssFile(
    Yii::app()->assetManager->publish(
            Yii::getPathOfAlias('application.modules.workflow.assets'), false, -1, true).
    '/css/workflowFunnel.css');*/

Yii::app()->clientScript->registerCss('workflowCenterWidgetCss',"

.workflow-status img {
    margin-right: 4px;
    opacity: 0.8;
}

.workflow-status img:hover {
    opacity: 1;
}

div.workflow-status {
    overflow: hidden;
    display: block;
    line-height: 20px;
    height: 24px;
    max-width: 340px;
    margin-right: 10px;
}

div.workflow-status b {
    float: left;
}

div.workflow-status a {
    float: right;
}

");

?>

<!-- dialog for completing a stage requiring a comment-->
<div id='workflowCommentDialog'>
<form>
<div class="row"><?php echo Yii::t('workflow','Please summarize how this stage was completed.'); ?></div>
<div class="row">
    <?php
        
    echo CHtml::textArea('workflowComment','',array('style'=>'width:260px;height:80px;'));

    echo CHtml::hiddenField('workflowCommentWorkflowId','',array('id'=>'workflowCommentWorkflowId'));
    echo CHtml::hiddenField('workflowCommentStageNumber','',array('id'=>'workflowCommentStageNumber'));
    ?>
</div>
</form>
</div>

<div id="workflowStageDetails"></div>

<?php // dialog to contain Workflow Stage Details
$workflowList = Workflow::getList();
?>
<div class="row" style="text-align:center;">
        <?php
        echo CHtml::dropDownList('workflowId',$currentWorkflow,$workflowList,    //$model->workflow
            array(
                'ajax' => array(
                    'type'=>'GET', //request type
                    'url'=>CHtml::normalizeUrl(array('/workflow/workflow/getWorkflow','modelId'=>$model->id,'type'=>$modelName)), //url to call.
                    //Style: CController::createUrl('currentController/methodToCall')
                    'update'=>'#workflow-diagram', //selector to update
                    'data'=>array('workflowId'=>'js:$(this).val()')
                    //leave out the data key to pass all form values through
                ),
                'id'=>'workflowSelector'
            )
        ); 
        ?>
</div>
<div class="row">
    <div id="workflow-diagram">
        <?php
        $workflowStatus = Workflow::getWorkflowStatus($currentWorkflow,$model->id,$modelName);    // true = include dropdowns
        echo Workflow::renderWorkflow($workflowStatus);
    ?></div>
</div>
