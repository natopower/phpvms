<?php
/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *    Forums: http://www.phpvms.net/forum
 *    Documentation: http://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Jeffrey Kobus
 * @copyright Copyright (c) 2010, Jeffrey Kobus
 * @link http://www.fs-products.net
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @ v1.0.1.1
 * 
 * APVacars Module is a modified version of kACARS_Free Module for PHPvms created by fs-products.net
 * APVacars Module is modified by Vangelis Boulasikis from kACARS_Free Module created by fs-products.net
 */



class APVacars extends CodonModule
{
    public function index()
    {
    $case = strtolower($this->get->data);
            switch($case)
            {                
                case 'verify':        
                    $results = Auth::ProcessLogin($this->get->pilotID, $this->get->password);        
                   if ($results)
                    {                        
                        echo '1';
                    }
                    else
                    {
                         echo '0';
                    }
                                   
                    
                    break;
                    
                     case 'moduleversion':        
                    {
                        echo '1.0.0.3';
                    }
                                   
                    
                    break;
                 
                  case 'isadmin':  
                  $pilotid = PilotData::parsePilotID($this->get->pilotID);      
                   $results = PilotGroups::CheckUserInGroup($pilotid, "1");        
                   if ($results)
                    {                        
                        echo '1';
                    }
                    else
                    {
                         echo '0';
                    }
                                   
                    
                    break;
                    
                 case 'getbid':                            
                    
                    $pilotid = PilotData::parsePilotID($this->get->pilotID);
                    $pilotinfo = PilotData::getPilotData($pilotid);
                    $biddata = SchedulesData::getLatestBid($pilotid);
                    $aircraftinfo = OperationsData::getAircraftByReg($biddata->registration);
                    
                    if(count($biddata) == 1)
                    {        
                        if($aircraftinfo->enabled == 1)
                        {
                           echo                                       //Split Values in VB
                                '1',";",                                    //0
                                $biddata->code.$biddata->flightnum,";",     //1
                                $aircraftinfo->fullname,";",                //2
                                $biddata->flightlevel,";",                  //3
                                $biddata->depicao,";",                      //4
                                $biddata->arricao,";",                      //5
                                $biddata->route,";",                        //6
                                $biddata->deptime,";",                      //7
                                $biddata->arrtime,";",                      //8
                                $biddata->registration,";",                 //9 
                                $aircraftinfo->name,";",                    //10
                                $aircraftinfo->maxpax,";"                   //11

                                ;                    
                        }
                        else
                        {    
                            echo '2';        // Aircraft Out of Service.                            
                        }            
                    }        
                    else        
                    {
                        echo '3';    // You have no bids!                                
                    }

                    print_r($params);
                    
                    break;    
                    
                    case 'liveupdate':    
                    
                    $pilotid = PilotData::parsePilotID($this->get->pilotID);
                    $pilotinfo = PilotData::getPilotData($pilotid);
                    $biddata = SchedulesData::getLatestBid($pilotid);
                    $aircraftinfo = OperationsData::getAircraftByReg($biddata->registration);
                    $lat = $this->get->latitude;
                    $lon = $this->get->longitude;
                    
                    # Get the distance remaining
                    $depapt = OperationsData::GetAirportInfo($this->get->depICAO);
                    $arrapt = OperationsData::GetAirportInfo($this->get->arrICAO);
                    $dist_remain = round(SchedulesData::distanceBetweenPoints(
                        $lat, $lon,    $arrapt->lat, $arrapt->lng));
                    
                    # Estimate the time remaining
                    if($this->get->groundSpeed > 0)
                    {
                        $Minutes = round($dist_remain / $this->get->groundSpeed * 60);
                        $time_remain = self::ConvertMinutes2Hours($Minutes);
                    }
                    else
                    {
                        $time_remain = '00:00';
                    }                    
                    
                    $fields = array(
                        'pilotid'        =>$pilotid,
                        'flightnum'      =>$biddata->code.$biddata->flightnum,
                        'pilotname'      =>'',
                        'aircraft'       =>$aircraftinfo->registration,
                        'lat'            =>$lat,
                        'lng'            =>$lon,
                        'heading'        =>$this->get->heading,
                        'alt'            =>$this->get->altitude,
                        'gs'             =>$this->get->groundSpeed,
                        'depicao'        =>$biddata->depicao,
                        'arricao'        =>$biddata->arricao,
                        'deptime'        =>$this->get->depTime,
                        'arrtime'        =>'',
                        'route'          =>$biddata->route,
                        'distremain'     =>$dist_remain,
                        'timeremaining'  =>$time_remain,
                        'phasedetail'    =>$this->get->status,
                        'online'         =>'',
                        'client'         =>'APVacars',
                        );
                    

                    ACARSData::UpdateFlightData($pilotid, $fields);    
                    
                    break; 
                      
                     case 'stopflight':    
                    $pilotid = PilotData::parsePilotID($this->get->pilotID);
                    $pilotinfo = PilotData::getPilotData($pilotid); 
                    self::resetFlights($pilotinfo->pilotid);
                    break; 
                     
                       case 'getairports':    
                       print_r(OperationsData::getAllAirports());
                       break;
                       
                       case 'getsettings':
                       echo WeightUnit;
                       break;
                       
                    case 'pirep':                        
                    
                    $flightinfo = SchedulesData::getProperFlightNum($this->get->flightNumber);
                    $code = $flightinfo['code'];
                    $flightnum = $flightinfo['flightnum'];
                    
                    $pilotid = PilotData::parsePilotID($this->get->pilotID);
                    
                    # Make sure airports exist:
                    #  If not, add them.
                    
                    if(!OperationsData::GetAirportInfo($this->get->depICAO))
                    {
                        OperationsData::RetrieveAirportInfo($this->get->depICAO);
                    }
                    
                    if(!OperationsData::GetAirportInfo($this->get->arrICAO))
                    {
                        OperationsData::RetrieveAirportInfo($this->get->arrICAO);
                    }
                    
                    # Get aircraft information
                    
                    
                    $ac = OperationsData::GetAircraftByReg($this->get->aircraftreg);
                    
                    # Load info
                    /* If no passengers set, then set it to the cargo */
                    $load = $this->get->pax;
                    if(empty($load))
                        $load = $this->get->cargo;                        
                    
                        // str_replace('*','<br>',$this->get->log)         
                    
                    $data = array(
                        'pilotid'            =>$pilotid,
                        'code'               =>$code,
                        'flightnum'          =>$flightnum,
                        'depicao'            =>$this->get->depICAO,
                        'arricao'            =>$this->get->arrICAO,
                        'aircraft'           =>$ac->id,
                        'flighttime'         =>$this->get->flightTime,
                        'flighttype'         =>$this->get->flightType,
                        'submitdate'         =>'UTC_TIMESTAMP()',
                        'comment'            =>$this->get->comments,
                        'fuelused'           =>$this->get->fuelused,
                        'route'              =>$this->get->route,
                        'source'             =>'APVacars',
                        'load'               =>$load,
                        'landingrate'        =>$this->get->landingrate,
                        'log'                =>$this->get->log
                    );
                    
                    //$this->log("File PIREP: \n".print_r($data, true), 'APVacars');
                    $ret = ACARSData::FilePIREP($pilotid, $data);        
                    
                    if ($ret)
                    {
                        
                            echo 'Pirep Filed';    // Pirep Filed!                            
                    }
                    else
                    {
                         echo 'Please Try Again!';    // Please Try Again!                            
                        
                    }
                    print_r($params);                        
                    
                    break;               
    
            case 'progressbar':    
                $lat = $this->get->latitude;
                $lon = $this->get->longitude;

                # Get the distance remaining
                $depapt = OperationsData::GetAirportInfo($this->get->depICAO);
                $arrapt = OperationsData::GetAirportInfo($this->get->arrICAO);
                $dist_remain = round(SchedulesData::distanceBetweenPoints(
                $lat, $lon,    $arrapt->lat, $arrapt->lng));
                $totaldistance = round(SchedulesData::distanceBetweenPoints($depapt->lat, $depapt->lng, $arrapt->lat, $arrapt->lng));
                 if ($totaldistance == 0)
                    {
                        
                            echo '0';    
                    }
                    else
                    {
                       $percomplete = ABS(number_format(((($totaldistance - $dist_remain) / $totaldistance) * 100), 2));
                        
                    }
                
               

               
                        echo $percomplete;      
                break; 


}
    }
    
    public function resetFlights($pilotid)
    {

               $sql = 'DELETE FROM '. TABLE_PREFIX.'acarsdata
                    WHERE pilotid='.$pilotid;
                DB::query($sql);
                return  $sql;
        
        
    }
        public function ConvertMinutes2Hours($Minutes)
    {
        if ($Minutes < 0)
        {
            $Min = Abs($Minutes);
        }
        else
        {
            $Min = $Minutes;
        }
        $iHours = Floor($Min / 60);
        $Minutes = ($Min - ($iHours * 60)) / 100;
        $tHours = $iHours + $Minutes;
        if ($Minutes < 0)
        {
            $tHours = $tHours * (-1);
        }
        $aHours = explode(".", $tHours);
        $iHours = $aHours[0];
        if (empty($aHours[1]))
        {
            $aHours[1] = "00";
        }
        $Minutes = $aHours[1];
        if (strlen($Minutes) < 2)
        {
            $Minutes = $Minutes ."0";
        }
        $tHours = $iHours .":". $Minutes;
        return $tHours;
    }
   
   




}



