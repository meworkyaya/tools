<?php

namespace app\controllers;

class InfluenceController extends \yii\web\Controller
{
    
    /**
    * clear data from tables
    * 
    */
    public function actionClear()
    {
        $ar = \app\models\Influence::clearData();
        
        return $this->render('clear', ['res' => $ar] );
    }

    
    /**
    * fill data
    * 
    */
    public function actionFilldata()
    {
        \app\models\Influence::clearData();
        \app\models\Influence::generateData( 10, 10, 1);
        
        return $this->render('filldata');
    }

    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
