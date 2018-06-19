<?php

namespace App\Http\Controllers;

use App\Models\pregnants as pregnants;
use App\Models\RecordOfPregnancy as RecordOfPregnancy;
use App\Models\sequents as sequents;
use App\Models\sequentsteps as sequentsteps;
use App\Models\users_register as users_register;
use App\Models\tracker as tracker;
use App\Models\question as question;
use App\Models\quizstep as quizstep;
use App\Models\reward as reward;

use App\Http\Controllers\checkmessageController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SqlController;
use App\Http\Controllers\CalController;

use Image; 
use Carbon\Carbon;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
//use LINE\LINEBot\Event;
//use LINE\LINEBot\Event\BaseEvent;
//use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder ;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;

class checkmessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function check_day($date ,$month){
               $day = $date;
              switch ($month) {
              case ($month == '01'):
                    if($day<1 || $day>31){
                      $message = 'เดือนมกราคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                    }else{
                      $message = '';
                    }  
                    
                   
                  break;
              case ($month =='02'):
                    if($day<1 || $day>29){
                      $message = 'เดือนกุมภาพันธ์มี 28 หรือ 29 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                    }else{
                      $message = '';
                    }
                    
                  break;
              case ($month =='03'):
                    if($day<1 || $day>31){
                       $message = 'เดือนมีนาคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                    }else{
                      $message = '';
                    } 
                  break;
              case ($month =='04'):
                   if($day<1 || $day>30){
                       $message = 'เดือนเมษายนมี 30 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                  } 
              
                  break;
              case ($month =='05'):
                  if($day<1 || $day>31){
                      $message = 'เดือนพฤษภาคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                    }   
                  break;
              case ($month =='06'):
                  if($day<1 || $day>30){
                      $message = 'เดือนมิถุนายนมี 30 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                    }  

                  break;
              case ($month =='07'):

                  if($day<1 || $day>31){
                      $message = 'เดือนกรกฎาคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                    }   

                  break;
              case ($month =='08'):
                  if($day<1 || $day>31){
                    $message = 'เดือนสิงหาคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                    }   

                  break;
              case ($month =='09'):
                  if($day<1 || $day>30){
                    $message = 'เดือนกันยายนมี 30 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  } else{
                      $message = '';
                    }  
                  break;
              case ($month =='10'):
                  if($day<1 || $day>31){
                    $message = 'เดือนตุลาคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                    }  

                  break;
              case ($month =='11'):
                  if($day<1 || $day>30){
                    $message = 'เดือนพฤศจิกายนมี 30 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  }else{
                      $message = '';
                    } 

                  break;
              case ($month =='12'):
                  if($day<1 || $day>31){
                    $message = 'เดือนธันวาคมมี 31 วันเท่านั้น ลองพิมพ์ใหม่นะคะ';
                  } else{
                      $message = '';
                    } 

                  break;
               // default:
               //     $month = '00';
               //     break;   


   }
    return  $message;
 }

 public function check_month($month){

              switch ($month) {
              case ($month == 'มกราคม' || $month == 'ม.ค.'  || $month == 'มค.' || $month == 'มค' || $month == 'มกรา' || $month == 'January' || $month == 'january'|| $month == 'Jan' || $month == 'jan'|| $month == 'Jan.' || $month == 'jan.' ):
                  $month = '01';
                  break;
              case ($month == 'กุมภาพันธ์' || $month == 'ก.พ.' || $month == 'กพ.' || $month == 'กพ'|| $month == 'กุมภา'|| $month == 'February'|| $month == 'february'|| $month == 'Feb.'|| $month == 'feb.'|| $month == 'Feb'|| $month == 'feb'):
                  $month = '02';
                  break;
              case ($month == 'มีนาคม' || $month == 'มี.ค.'|| $month == 'มีค.'|| $month == 'มีค'|| $month == 'มีนา'|| $month == 'March'|| $month == 'march'|| $month == 'Mar'|| $month == 'mar'|| $month == 'Mar.'|| $month == 'mar.'):
                  $month = '03';
                  break;
              case ($month == 'เมษายน' || $month == ' เม.ย.'|| $month == ' เมย.'|| $month == 'เมย'|| $month == 'เมษา'|| $month == 'April' || $month == 'april'|| $month == 'Apr.' || $month == 'apr.'|| $month == 'Apr' || $month == 'apr'):
                  $month = '04';
                  break;
              case ($month == 'พฤษภาคม' || $month == ' พ.ค.'|| $month == ' พค.'|| $month == 'พค'|| $month == 'พฤษภา'|| $month == 'May'|| $month == 'may'):
                  $month = '05';
                  break;
              case ($month == 'มิถุนายน' || $month == 'มิ.ย.'|| $month == 'มิย.'|| $month == 'มิย'|| $month == 'มิถุนา'|| $month == 'June'|| $month == 'june'|| $month == 'Jun'|| $month == 'jun'|| $month == 'Jun.'|| $month == 'jun.'):
                  $month = '06';
                  break;
              case ($month == 'กรกฎาคม' || $month == 'ก.ค.'|| $month == 'กค.'|| $month == 'กค'|| $month == 'กรกฎา'|| $month == 'July'|| $month == 'july'|| $month == 'Jul'|| $month == 'jul'|| $month == 'Jul.'|| $month == 'jul.'):
                  $month = '07';
                  break;
              case ($month == 'สิงหาคม' || $month == 'ส.ค.'|| $month == 'สค.'|| $month == 'สค'|| $month == 'สิงหา'|| $month == 'August'|| $month == 'august'|| $month == 'Aug'|| $month == 'aug'|| $month == 'Aug.'|| $month == 'aug.'):
                  $month = '08';
                  break;
              case ($month == 'กันยายน' || $month == 'ก.ย.'|| $month == 'กย.'|| $month == 'กย'|| $month == 'กันยา'|| $month == 'September '|| $month == 'september '|| $month == 'Sep '|| $month == 'sep'|| $month == 'Sep. '|| $month == 'sep.'|| $month == 'Sept. '|| $month == 'sept.'|| $month == 'Sept '|| $month == 'sept'):
                  $month = '09';
                  break;
              case ($month == 'ตุลาคม' || $month == 'ต.ค.'|| $month == 'ตค.'|| $month == 'ตค'|| $month == 'ตุลา'|| $month == 'October'|| $month == 'october'|| $month == 'Oct'|| $month == 'oct'|| $month == 'Oct.'|| $month == 'oct.'):
                  $month = '10';
                  break;
              case ($month == 'พฤศจิกายน' || $month == 'พ.ย.'|| $month == 'พย.'|| $month == 'พย'|| $month == 'พฤศจิกา' || $month == 'November'|| $month == 'november'|| $month == 'Nov.'|| $month == 'nov.'|| $month == 'Nov'|| $month == 'nov'):
                  $month = '11';
                  break;
              case ($month == 'ธันวาคม' || $month == 'ธ.ค.'|| $month == 'ธค.'|| $month == 'ธค'|| $month == 'ธันวา'|| $month == 'December'|| $month == 'december'|| $month == 'Dec'|| $month == 'dec'|| $month == 'Dec.'|| $month == 'dec.'):
                  $month = '12';
                  break;   
               default:
                   $month = '00';
                   break;   
                }
                return  $month;
 }
   public function meal_planing($cal){
         if ($cal <= '1,600') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 8 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 2 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 7 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 6 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 1 แก้ว';
                } elseif ($cal >= '1,601' && $cal <= '1,700') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 8 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 8 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 6 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 1 แก้ว';
                }elseif ($cal >='1,701' && $cal <='1,800') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 9 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 8 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 6 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 1 แก้ว';
                }elseif ($cal >='1,801' && $cal<='1,900') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 9 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 8 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 8 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 1 แก้ว';
                }elseif ($cal >='1,901' && $cal<='2,000') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 10 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 9 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 8 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 1 แก้ว';
                }elseif ($cal >='2,001' && $cal<='2,100' ) {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 10 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 9 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 8 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($cal >= '2,101' && $cal<='2,200') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 10 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 9 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 9 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($cal >= '2,201' && $cal <= '2,300') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 11 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 10 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 9 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($cal >= '2,301' && $cal <='2,400') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 12 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 3 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 10 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 9 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 2 แก้ว';
                }elseif ($cal >= '2,401' && $cal <= '2,500') {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 12 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 4 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 11 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 9 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 2 แก้ว';
                }else {
                        $Nutrition =  'พลังงานที่ต้องการในแต่ละวันคือ'. "\n".
                                      '🍚ข้าววันละ 12 ทัพพี'. "\n".
                                      '🥒ผักวันละ 3 ทัพพี'."\n".
                                      '🍎ผลไม้วันละ 4 ส่วน (1 ส่วนคือปริมาณผลไม้ที่จัดใส่จานรองกาแฟเล็ก ๆ ได้ 1 จานพอดี)'."\n".
                                      '🍗เนื้อวันละ 12 ส่วน (1 ส่วนคือ 2 ช้อนโต๊ะ)'."\n".
                                      '🐷ไขมันวันละ 10 ช้อนชา'."\n".
                                      '🥛นมไขมันต่ำวันละ 2 แก้ว';
                }
                return $Nutrition;
    }
      public function user_data($user)
    {          
                   $users_register = users_register::where('user_id',$user)
                                                   ->whereNull('deleted_at')
                                                   ->first();

                   $user_name = $users_register->user_name;
                   $user_age = $users_register->user_age;
                   $user_height = $users_register->user_height;
                   $user_Pre_weight = $users_register->user_Pre_weight;
                   $user_weight = $users_register->user_weight;
                   $preg_week = $users_register->preg_week;
                   $phone_number = $users_register->phone_number;
                   $email = $users_register->email;
                   $hospital_name = $users_register->hospital_name;

                   $hospital_number = $users_register->hospital_number;
                   $history_medicine = $users_register->history_medicine;
                   $history_food = $users_register->history_food;
                   $bmi  = (new CalController)->bmi_calculator($user_Pre_weight,$user_height);
                   $userMessage = '------สรุปข้อมูล------'. "\n".
                                  '1. ชื่อ: '.$user_name. "\n".
                                  '2. อายุ: '.$user_age.'ปี'. "\n".
                                  '3. ส่วนสูง: '.$user_height."\n".
                                  '4. น้ำหนักก่อนตั้งครรภ์: '.$user_Pre_weight."\n".
                                  '5. น้ำหนักปัจจุบัน: '.$user_weight."\n".
                                  'BMI:'.$bmi."\n".
                                  '6. อายุครรภ์: '.$preg_week.'สัปดาห์'."\n".
                                  '7. เบอร์โทรศัพท์: '.$phone_number."\n".
                                  '8. อีเมล: '.$email."\n".
                                  '9. โรงพยาบาลที่ฝากครรภ์: '.$hospital_name."\n".
                                  // '10. เลขประจำตัวผู้ป่วย: '.$hospital_number."\n".
                                  // '11. แพ้ยา: '.$history_medicine."\n".
                                  '10. แพ้อาหาร: '.$history_food;
                   return $userMessage;
    }

    public function match($array, $userMessage)
            {
                foreach($array as $needle){
                    if (strpos($userMessage, $needle) !== false) {
                        return true;
                    }
                }
                return false;
            }
  
  

}
