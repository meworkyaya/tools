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
    * LOAD DATA INFILE '/tmp/data_locations.txt' INTO TABLE in_locations
    * 
    */
    public function actionFilldata()
    {
        set_time_limit( 0 );
        
        $locations = 10 * 1000;
        // $locations = 10000;
        
        $snapshots = 31;
        $snapshotsDelta = 2;
        
        \app\models\Influence::clearData();
        // $res = \app\models\Influence::generateData( $locations, $snapshots, $snapshotsDelta );
        $res = \app\models\Influence::generateDataFile( $locations, $snapshots, $snapshotsDelta );
        
        return $this->render('filldata', [ 'res' => $res ]);
    }

    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
