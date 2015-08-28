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
        $locations = 10;
        $snapshots = 10;
        $snapshotsDelta = 2;
        
        \app\models\Influence::clearData();
        $res = \app\models\Influence::generateData( $locations, $snapshots, $snapshotsDelta );
        
        return $this->render('filldata', [ 'res' => $res ]);
    }

    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
