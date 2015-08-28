<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class Influence extends Model
{
    
    /**
    * clear data at table
    * 
    */
    public static function clearData(){
        $res1 = \Yii::$app->db->createCommand('TRUNCATE in_locations; ')->execute();
        $res2 = \Yii::$app->db->createCommand('TRUNCATE in_snapshots; ')->execute();
        
        $ar = [  $res1, $res2 ];
        
        return $ar;
    }
    

    /**
    * generate data
    * 
    */
    public static function generateData( $locations, $snapshots, $snapshotsDelta ){
        
        for( $i = 1; $i < $locations; $i++ ){
            $location = new \app\models\InLocations();
            $location->save();
            
            $id = $location->id;
        }
        
        return;
    }
    
    
    /**
    * generate list of snapshots
    * 
    * @param mixed $owner_id
    * @param mixed $snapshots
    * @param mixed $snapshotsDelta
    */
    public static function generateSnapshots( $owner_id, $snapshots, $snapshotsDelta ){
        
        $viewsMax = 1000;
        $ratingMax = 5;
        
        $count = $snapshots + rand( 0, $snapshotsDelta);
        
        $begin = new DateTime( '2015-08-28' );
        $end = $end->modify( "-{$count} day" );       
        
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);

        foreach($daterange as $date){
            // $dateString =             
            echo $date->format("Ymd") . "<br>";
        }
        exit();
        
        
//        for( $i = 1; $i < $snapshots + rand( 0, $snapshotsDelta); $i++ ){
//            $snapshot = new \app\models\InSnapshots();
//            
//            $snapshot->location_id = $owner_id;
//            $snapshot->views = rand( 0, $viewsMax );
//            $snapshot->rating = rand( 0, $ratingMax );
//            
//            
//        }
        
    }

    
}
