<?php

namespace app\controllers;

class InfluenceController extends \yii\web\Controller
{
    public function actionClear()
    {
        $res1 = \Yii::$app->db->createCommand('TRUNCATE in_locations; ')->execute();
        $res2 = \Yii::$app->db->createCommand('TRUNCATE in_snapshots; ')->execute();
        
        $ar = [  $res1, $res2 ];
        
        return $this->render('clear', ['res' => $ar] );
    }

    public function actionFilldata()
    {
        return $this->render('filldata');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
