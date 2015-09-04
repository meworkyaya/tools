<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class Influence extends Model
{    
    
    protected static $dataDir = '../../data/';
    protected static $dataFileLocations = 'data_locations.txt';
    protected static $dataFileSnapshots = 'data_snapshots.txt';
    
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
        
        $file = self::$dataDir . self::$dataFileSnapshots;
        
        $res = [];
        $res['start'] = time();
        
        for( $i = 1; $i <= $locations; $i++ ){
            
            $location = new \app\models\InLocations();
            $location->save();
            
            $id = $location->id;
            
            $subres = self::generateSnapshots( $id, $snapshots, $snapshotsDelta );
            
            unset( $location );
            // $res = array_merge( $res, $subres );
            // $res['items'] = array_merge( $res, self::generateSnapshots( $id, $snapshots, $snapshotsDelta ) );
        }

        $res['end'] = time();
        $res['delta'] = $res['end'] - $res['start'];
        
        
        return $res;
    }


    
    /**
    * gnerate data files
    * 
    * @param mixed $locations
    * @param mixed $snapshots
    * @param mixed $snapshotsDelta
    */
    public static function generateDataFile( $locations, $snapshots, $snapshotsDelta ){
        $res = [];
        $res['start'] = time();
        
        self::generateLocationsDataFile( $locations, $snapshots, $snapshotsDelta );
        self::generateSnapshotsDataFile( $locations, $snapshots, $snapshotsDelta );

        $res['end'] = time();
        $res['delta'] = $res['end'] - $res['start'];
        
        
        return $res;
    }

    
    
    /**
    * generate data by creating file
    * 
    */
    public static function generateLocationsDataFile( $locations, $snapshots, $snapshotsDelta ){
        $file = self::$dataDir . self::$dataFileLocations;
        
//        $sql = "INSERT INTO `in_locations` VALUES\n";
//        for( $i = 1; $i < $locations; $i++ ){            
//            $sql .= "({$i}, 0, 0),\n";
//        }
//        $sql .= "({$i}, 0, 0);\n";
        
        
        $sql = "";
        
        file_put_contents( $file, "" ); // clear file        
        for( $i = 1; $i < $locations; $i++ ){            
            $sql = "{$i}\t0\t0\n";
            
            file_put_contents( $file, $sql, FILE_APPEND );
        }
        
        return;
    }
    

    
    /**
    * generate data by creating file
    * 
    */
    public static function generateSnapshotsDataFile( $locations, $snapshots, $snapshotsDelta ){
        $file = self::$dataDir . self::$dataFileSnapshots;

        $viewsMax = 1000;
        $ratingMax = 6;

        
        $count = $snapshots + rand( 0, $snapshotsDelta);
        
        $begin = new \DateTime( '2015-08-28' );
        $end = new \DateTime( '2015-08-28' );
        $end = $end->modify( "-{$count} day" );       
        
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($end, $interval , $begin);

        
        $sql = "";
        
        $views = 567;
        $rating = 3;
        
        file_put_contents( $file, "" );
        
        for( $i = 0; $i < $locations; $i++ ){     
            
            $idCount = $i * $count + 1;
               
            foreach($daterange as $date){
                
                $idCount++;                
                $dateString = $date->format("Y-m-d");                
                $sql = "{$idCount}\t{$i}\t{$dateString}\t{$views}\t{$rating}\n";
                
                file_put_contents( $file, $sql, FILE_APPEND );
            }
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
        $ratingMax = 6;
        
        $count = $snapshots + rand( 0, $snapshotsDelta);
        
        $begin = new \DateTime( '2015-08-28' );
        $end = new \DateTime( '2015-08-28' );
        $end = $end->modify( "-{$count} day" );       
        
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($end, $interval , $begin);

        $res = [];
        $res[ $owner_id ] = 0;
        
        foreach($daterange as $date){
            $dateString = $date->format("Y-m-d");
            
            // $res[ $owner_id ] += 1;
            
            $snapshot = new \app\models\InSnapshots();
            $snapshot->location_id = $owner_id;
            $snapshot->date = $dateString;
            $snapshot->views = rand( 0,  $viewsMax);
            $snapshot->rating = rand( 0,  $ratingMax);
            
            $snapshot->save();
            
            unset( $snapshot );
            
        }
        
        return $res;
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
