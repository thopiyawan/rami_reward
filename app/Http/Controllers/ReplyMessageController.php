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
class ReplyMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function replymessage2($replyToken,$userMessage1,$userMessage2)
    {
            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));


                      $textMessage1 = new TextMessageBuilder($userMessage1);
                      $textMessage2 = new TextMessageBuilder($userMessage2);

                      $multiMessage = new MultiMessageBuilder;
                      $multiMessage->add($textMessage1);
                      $multiMessage->add($textMessage2);
                      $textMessageBuilder = $multiMessage; 
     
          
             
                $response = $bot->replyMessage($replyToken,$textMessageBuilder); 


    }
    public function replymessage_result($replyToken,$preg_week,$bmi,$cal,$weight_criteria,$text,$user){

            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));
                   

                    if ($weight_criteria =='น้ำหนักน้อย') {
                      $result='1';
                    } elseif ($weight_criteria =='น้ำหนักปกติ') {
                      $result='2';
                    } elseif ($weight_criteria == 'น้ำหนักเกิน') {
                      $result='3';
                    } elseif ($weight_criteria =='อ้วน') {
                      $result='4';
                    }
                  


                   $actionBuilder1 = array(
                            // new MessageTemplateActionBuilder(
                            //     'กราฟน้ำหนัก', // ข้อความแสดงในปุ่ม
                            //     'กราฟน้ำหนัก'
                            // ),
                            new UriTemplateActionBuilder(
                                          'กราฟน้ำหนัก', // ข้อความแสดงในปุ่ม
                                          'https://peat.none.codes/graph/'.$user
                                          ),
                            new MessageTemplateActionBuilder(
                                'ทารกในครรภ์',// ข้อความแสดงในปุ่ม
                                'ทารกในครรภ์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                        );
                   $actionBuilder2 = array(
                            new MessageTemplateActionBuilder(
                                'น้ำหนักตัวที่เหมาะสม',// ข้อความแสดงในปุ่ม
                                'น้ำหนักตัวที่เหมาะสม' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new MessageTemplateActionBuilder(
                                'ข้อมูลโภชนาการ',// ข้อความแสดงในปุ่ม
                                'ข้อมูลโภชนาการ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                        );
                        $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(
                                    new CarouselColumnTemplateBuilder(
                                        'ขณะนี้คุณมีอายุครรภ์'.$preg_week.'สัปดาห์',
                                        'ค่าดัชนีมวลกายของคุณคือ'.$bmi.'อยู่ในเกณฑ์'. $weight_criteria,
                                        'https://peat.none.codes/week/'.$preg_week.'.jpg',
                                        $actionBuilder1
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                        'จำนวนแคลอรี่ที่คุณต้องการต่อวันคือ '.$cal,
                                        'รายละเอียดการรับประทานอาหารสามารถกดปุ่มด้านล่างได้เลยค่ะ',
                                        'https://peat.none.codes/food/1_'.$result.'.jpg',
                                        $actionBuilder2
                                    ),                                        
                                )
                            )
                        );
              $response = $bot->replyMessage($replyToken,$textMessageBuilder);

    }
     public function replymessage($replyToken,$userMessage,$case)
    {
            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));
            
            switch($case) {
     
                 case 1 : 
                        $textMessageBuilder = new TextMessageBuilder($userMessage);
                    break;
                 case 2 : 
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'ครั้งสุดท้ายที่มีประจำเดือน',
                                          'ครั้งสุดท้ายที่มีประจำเดือน' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'กำหนดการคลอด',
                                          'กำหนดการคลอด' 
                                          ) 
                                         );

                        $imageUrl = NULL;
                        $textMessageBuilder = new TemplateMessageBuilder('ขอทราบอายุครรภ์ของคุณหน่อยค่ะ',
                        new ButtonTemplateBuilder(
                              $userMessage, 
                              'กรุณาเลือกตอบข้อใดข้อหนึ่งเพื่อให้ทางเราคำนวณอายุครรภ์ค่ะ', 
                               $imageUrl, 
                               $actionBuilder  
                           )
                        );              
                    break;
                 case 3 : 
                         $textMessageBuilder = new TemplateMessageBuilder('อายุครรภ์ของคุณ', new ConfirmTemplateBuilder( $userMessage ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ใช่',
                                        'อายุครรภ์ถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ใช่',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    ); 
                    break;

                 case 4 : 

                  $textReplyMessage = $userMessage;
                  $textMessage1 = new TextMessageBuilder($textReplyMessage);
                  $textReplyMessage =   "รายละเอียดของระดับ". "\n".
                                        "เบา -  วิถีชีวิตทั่วไป ไม่มีการออกกำลังกาย หรือมีการออกกำลังกายน้อย". "\n".
                                        "ปานกลาง - วิถีชีวิตกระฉับกระเฉง หรือ มีการออกกำลังกายสม่ำเสมอ". "\n".
                                        "หนัก - วิถีชีวิตมีการใช้แรงงานหนัก ออกกำลังกายหนักเป็นประจำ". "\n";
                  $textMessage2 = new TextMessageBuilder($textReplyMessage);
                  $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'เบา',// ข้อความแสดงในปุ่ม
                                          'เบา' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'ปานกลาง',// ข้อความแสดงในปุ่ม
                                          'ปานกลาง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'หนัก',// ข้อความแสดงในปุ่ม
                                          'หนัก' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ) 
                                         );

                     $imageUrl = NULL;
                    $textMessage3 = new TemplateMessageBuilder('ระดับของการออกกำลังกาย',
                     new ButtonTemplateBuilder(
                              'ระดับของการออกกำลังกาย', // กำหนดหัวเรื่อง
                              'เลือกระดับด้านล่างได้เลยค่ะ', // กำหนดรายละเอียด
                               $imageUrl, // กำหนด url รุปภาพ
                               $actionBuilder  // กำหนด action object
                         )
                      );                            

                  $multiMessage = new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  $multiMessage->add($textMessage3);
                  $textMessageBuilder = $multiMessage; 

                    break;
                 case 5 : 
                  $text1 = 'คุณต้องการแก้ไขข้อมูลไหม?';
                  $textMessage1 = new TextMessageBuilder($userMessage);
                  $textMessage2 = new TemplateMessageBuilder('คุณต้องการแก้ไขข้อมูลไหม?', new ConfirmTemplateBuilder( $text1 ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'แก้ไข',
                                        'แก้ไขข้อมูล'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ยืนยันข้อมูล',
                                        'ยืนยันข้อมูล'
                                    )
                                )
                        )
                    ); 
                  $multiMessage =     new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  // $multiMessage->add($textMessage3);
                  $textMessageBuilder = $multiMessage; 
                    break;
                  case 6 : 
                  $textMessageBuilder = new TemplateMessageBuilder('คุณสนใจให้ดิฉันเป็นผู้ช่วยอัตโนมัติของคุณไหม', new ConfirmTemplateBuilder( 'คุณสนใจให้ดิฉันเป็นผู้ช่วยอัตโนมัติของคุณไหม' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'สนใจ',
                                        'สนใจ'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่สนใจ',
                                        'ไม่สนใจ'
                                    )
                                )
                        )
                    ); 

                    break;

                 case 7:
                    
                     $users_register = (new SqlController)->users_register_select($userMessage);
                     $preg_week = $users_register->preg_week;

// new UriTemplateActionBuilder('กราฟ','https://peat.none.codes/graph/'.$userMessage),
                    $actionBuilder = array(
                                          // new UriTemplateActionBuilder(
                                          // 'กราฟน้ำหนัก', // ข้อความแสดงในปุ่ม
                                          // 'https://peat.none.codes/graph/'.$userMessage
                                          // ),
                                           new MessageTemplateActionBuilder(
                                         'ทารกในครรภ์',// ข้อความแสดงในปุ่ม
                                         'ทารกในครรภ์' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          )
                                         );

                    $imageUrl = 'https://peat.none.codes/week/'.$preg_week.'.jpg';
                   $textMessageBuilder = new TemplateMessageBuilder('สรุปข้อมูล',
                     new ButtonTemplateBuilder(
                               'ขณะนี้คุณมีอายุครรภ์'.$preg_week.'สัปดาห์', // กำหนดหัวเรื่อง
                               'กราฟน้ำหนักระหว่างการตั้งครรภ์', // กำหนดรายละเอียด
                               $imageUrl, // กำหนด url รุปภาพ
                               $actionBuilder  // กำหนด action object
                         )
                      );  

                    break;

                 case 8 : 
                         $textMessageBuilder = new TemplateMessageBuilder('สัปดาห์นี้คุณมีน้ำหนัก', new ConfirmTemplateBuilder( 'สัปดาห์นี้คุณมีน้ำหนัก'.$userMessage.'กิโลกรัมใช่ไหมคะ?' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ถูกต้อง',
                                        'น้ำหนักถูกต้อง'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ถูกต้อง',
                                        'ไม่ถูกต้อง'
                                    )
                                )
                        )
                    ); 
                    break;
                     case 9 : 
                  $textMessageBuilder = new TemplateMessageBuilder('คุณมีประวัติการแพ้ยาไหมคะ', new ConfirmTemplateBuilder( $userMessage ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'แพ้',
                                        'แพ้ยา'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่แพ้',
                                        'ไม่แพ้ยา'
                                    )
                                )
                        )
                    ); 

                    break;
                     case 10 : 
                  $textMessageBuilder = new TemplateMessageBuilder('คุณมีประวัติการแพ้อาหารไหมคะ', new ConfirmTemplateBuilder( $userMessage ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'แพ้',
                                        'แพ้อาหาร'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่แพ้',
                                        'ไม่แพ้อาหาร'
                                    )
                                )
                        )
                    ); 

                    break;
                    case 11 : 
                         $textMessageBuilder = new TemplateMessageBuilder('วันนี้คุณทานอะไรไปบ้างคะ?', new ConfirmTemplateBuilder( $userMessage ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ทานแล้ว',
                                        'ทานแล้ว'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ยังไม่ได้ทาน',
                                        'ยังไม่ได้ทาน'
                                    )
                                )
                        )
                    ); 
                    break;
                      case 12 : 
                         $textMessageBuilder = new TemplateMessageBuilder($userMessage, new ConfirmTemplateBuilder( $userMessage ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ออกแล้ว',
                                        'ออกแล้ว'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ยังไม่ได้ออก',
                                        'ยัง'
                                    )
                                )
                        )
                    ); 
                    break;
         
                      case 13 : 
                         $textMessageBuilder = new TemplateMessageBuilder($userMessage, new ConfirmTemplateBuilder( $userMessage ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ต้องการ',
                                        'ต้องการเชื่อมข้อมูล'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ต้องการ',
                                        'ไม่ต้องการเชื่อมข้อมูล'
                                    )
                                )
                        )
                    ); 
                    break;

                    case 14 :  
                 $textMessageBuilder = new TemplateMessageBuilder('คุณเคยลงทะเบียนกับ ulife.info ไหม?', new ConfirmTemplateBuilder('คุณเคยลงทะเบียนกับ ulife.info ไหม?' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'เคย',
                                        'เคยลงทะเบียน'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่เคย',
                                        'ไม่เคยลงทะเบียน'
                                    )
                                )
                        )
                    ); 


                   break;
                   case 15:
                      $textMessageBuilder = new TemplateMessageBuilder('แนะนำอาหาร',
                       new ImageCarouselTemplateBuilder(
                         array(
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/f_1.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/f_1.jpg'
                               )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/f_2.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/f_2.jpg'
                                )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/f_3.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/f_3.jpg'
                                )
                              ),
                                 new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/f_4.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/f_4.jpg'
                               )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/f_5.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/f_5.jpg'
                                )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/f_6.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/f_6.jpg'
                                )
                              ),    
                               new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/n_1.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/n_1.jpg'
                               )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/n_2.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/n_2.jpg'
                                )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/food/n_3.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food/n_3.jpg'
                                )
                              ),                                       
                        )
                      )
                    );
                   break;  
                     case 16:
                      $textMessageBuilder = new TemplateMessageBuilder('แนะนำการออกกำลังกาย',
                       new ImageCarouselTemplateBuilder(
                         array(
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/manual/exercise.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'http://www.raipoong.com/content/detail.php?section=12&category=26&id=467'
                               )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/manual/exercise2.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'http://www.raipoong.com/content/detail.php?section=12&category=26&id=467'
                                )
                              ),
                              new ImageCarouselColumnTemplateBuilder(
                                'https://peat.none.codes/manual/exercise3.jpg',
                              new UriTemplateActionBuilder(
                                'Uri Template', // ข้อความแสดงในปุ่ม
                                'http://www.raipoong.com/content/detail.php?section=12&category=26&id=467'
                                )
                              )                                       
                        )
                      )
                    );
                   break;  

                      case 17 : 
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'โรงพยาบาลธรรมศาสตร์',
                                          'โรงพยาบาลธรรมศาสตร์' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'โรงพยาบาลศิริราช',
                                          'โรงพยาบาลศิริราช' 
                                          ) 
                                         );

                        $imageUrl = NULL;
                        $textMessageBuilder = new TemplateMessageBuilder('โรงพยาบาลที่ฝากครรภ์',
                        new ButtonTemplateBuilder(
                              $userMessage, 
                              'กดเลือกด้านล่างเลยนะคะ', 
                               $imageUrl, 
                               $actionBuilder  
                           )
                        );  
                         break;
                      case 18 : 


                    $picFullSize = $userMessage;
                    $picThumbnail = $userMessage;
                    $textMessageBuilder = new ImageMessageBuilder($picFullSize,$picThumbnail);
                   

                    break;

                   case 19 : 


                  $text1 = 'อยากรู้อะไรกดเลยค่ะ';
                  $textMessage1 = new TextMessageBuilder($text1);
               
                    // $imageMapUrl = 'https://peat.none.codes/food/new_nutri2.jpg?_ignored=';
                     $imageMapUrl = 'https://peat.none.codes/image/menu10.jpg?_ignored=';
                    $textMessage2 = new ImagemapMessageBuilder(
                        $imageMapUrl,
                        'แนะนำอาหาร',
                        new BaseSizeBuilder(1040,1040),
                        array(
                            new ImagemapMessageActionBuilder(
                                'ไม่กิน [อาหารบางชนิด] กินอะไรแทนดี?',
                                new AreaBuilder(0,40,346,333)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ผลไม้ 1 ส่วนคือเท่าไร?',
                                new AreaBuilder(346,40,346,333)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ซื้ออาหารกินข้างนอก จะกะปริมาณอย่างไร?',
                                new AreaBuilder(692,40,346,333)
                                ),


                            new ImagemapMessageActionBuilder(
                                'กินไม่ถึง หรือกินเกิน ทำอย่างไร?',
                                new AreaBuilder(0,373,346,333)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ท้องผูก ท้องอืด ทำอย่างไร?',
                                new AreaBuilder(346,373,346,333)
                                ),
                            new ImagemapMessageActionBuilder(
                                'แพ้ท้อง กินอย่างไร?',
                                new AreaBuilder(692,373,346,333)
                                ),


                            new ImagemapMessageActionBuilder(
                                'ไม่อิ่ม ทำอย่างไร?',
                                new AreaBuilder(0,706,346,333)
                                ),
                            new ImagemapMessageActionBuilder(
                                'อาหารอะไรที่ควรหลีกเลี่ยง?',
                                new AreaBuilder(346,706,346,333)
                                ),
                             new ImagemapMessageActionBuilder(
                                'อื่น ๆ (ฝากคำถามไว้ได้)',
                                new AreaBuilder(692,706,346,333)
                                ),

                        )); 

                  $multiMessage =     new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  // $multiMessage->add($textMessage3);
                  $textMessageBuilder = $multiMessage; 
                    break;     
                      case 20 : 
                    $text1 = 'อยากรู้อะไรกดเลยค่ะ';
                    $textMessage1 = new TextMessageBuilder($text1);
                    $imageMapUrl = 'https://peat.none.codes/food/exer1.jpg?_ignored=';
                    $textMessage2 = new ImagemapMessageBuilder(
                        $imageMapUrl,
                        'แนะนำการออกกำลังกาย',
                        new BaseSizeBuilder(1040,1040),
                        array(

                            new ImagemapMessageActionBuilder(
                                'กระดกข้อเท้า',
                                new AreaBuilder(0,173,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ยกก้น',
                                new AreaBuilder(346,173,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'นอนเตะขา',
                                new AreaBuilder(692,173,346,173)
                                ),


                            new ImagemapMessageActionBuilder(
                                'นอนตะแคงยกขา',
                                new AreaBuilder(0,346,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'คลานสี่ขา',
                                new AreaBuilder(346,346,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'แมวขู่',
                                new AreaBuilder(692,346,346,173)
                                ),


                            new ImagemapMessageActionBuilder(
                                'นั่งโยกตัว',
                                new AreaBuilder(0,519,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'นั่งเตะขา',
                                new AreaBuilder(346,519,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ยืนงอเข่า',
                                new AreaBuilder(692,519,346,173)
                                ),


                            new ImagemapMessageActionBuilder(
                                'ยืนเตะขาไปข้างหลัง',
                                new AreaBuilder(0,692,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ยืนเตะขาไปด้านข้าง',
                                new AreaBuilder(346,692,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ยืนเขย่งเท้า',
                                new AreaBuilder(692,692,346,173)
                                ),


                            new ImagemapMessageActionBuilder(
                                'ยืนกางแขน',
                                new AreaBuilder(0,865,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ยืนแกว่งแขนสลับขึ้นลง',
                                new AreaBuilder(346,865,346,173)
                                ),
                            new ImagemapMessageActionBuilder(
                                'ยืนย่ำอยู่กับที่',
                                new AreaBuilder(692,865,346,173)
                                ),

                        )); 
                        $multiMessage =     new MultiMessageBuilder;
                        $multiMessage->add($textMessage1);
                        $multiMessage->add($textMessage2);
                       // $multiMessage->add($textMessage3);
                        $textMessageBuilder = $multiMessage; 
                    break;   

                    case 21 :  
                    $picFullSize = 'https://peat.none.codes/food/ex'.$userMessage.'.jpg';
                    $picThumbnail = 'https://peat.none.codes/food/ex'.$userMessage.'.jpg';
                    $textMessage1 = new ImageMessageBuilder($picFullSize,$picThumbnail);
                    // $picThumbnail = 'https://www.youtube.com/watch?v=eUvG5U8g6SY&list=PLWa93dkeDtZ_CidjnWp-EECxCA5IDjOa7&index=1'.$userMessage.'.mp4';
                    // $videoUrl = 'https://peat.none.codes/video/'.$userMessage.'.mp4';             
                    // $textMessage2 = new VideoMessageBuilder($videoUrl,$picThumbnail);

                  if($userMessage=='1'){
                    $url ='https://www.youtube.com/watch?v=eUvG5U8g6SY' ;
                  }elseif ($userMessage=='2') {
                    $url ='https://youtu.be/TdPpYXmZcr4' ;

                  }elseif ($userMessage=='3') {
                    $url ='https://youtu.be/pO8U_fZb76g' ;
                  }elseif ($userMessage=='4') {
                    $url ='https://youtu.be/Dc6C60dPXAs' ;
                  }elseif ($userMessage=='5') {
                    $url ='https://youtu.be/FHj0JX2Ofzg' ;
                  }elseif ($userMessage=='6') {
                    $url ='https://youtu.be/UuChDVqnBW4' ;
                  }elseif ($userMessage=='7') {
                    $url ='https://youtu.be/SThBwQ9ep-g' ;
                  }elseif ($userMessage=='8') {
                    $url ='https://youtu.be/NGohxaUL17g' ;
                  }elseif ($userMessage=='9') {
                    $url ='https://youtu.be/-4HhyY05FfU' ;
                  }elseif ($userMessage=='10') {
                    $url ='https://youtu.be/IS8OvBCyf-E' ;
                  }elseif ($userMessage=='11') {
                    $url ='https://youtu.be/jZsJoU2Qbdk' ;
                  }elseif ($userMessage=='12') {
                    $url ='https://youtu.be/B01N_H6FxsE' ;
                  }elseif ($userMessage=='13') {
                    $url ='https://youtu.be/0-eETKKXZ3U' ;
                  }elseif ($userMessage=='14') {
                    $url ='https://youtu.be/yrham5v5ubM' ;
                  }elseif ($userMessage=='15') {
                    $url ='https://youtu.be/0lRZGU0QLNI' ;
                  }
         
                  $textMessage2 = new TextMessageBuilder($url);
                  $multiMessage =     new MultiMessageBuilder;
                  $multiMessage->add($textMessage1);
                  $multiMessage->add($textMessage2);
                  $textMessageBuilder = $multiMessage;  
                  break;
                  case 22: 
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'บันทึกอาหาร',
                                          'บันทึกอาหาร' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'บันทึกวิตามิน',
                                          'บันทึกวิตามิน' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'บันทึกการออกกำลังกาย',
                                          'บันทึกการออกกำลังกาย' 
                                          )  
                                         );

                        $imageUrl = NULL;
                        $textMessageBuilder = new TemplateMessageBuilder('บันทึกย้อนหลัง',
                        new ButtonTemplateBuilder(
                              $userMessage, 
                              'กดเลือกด้านล่างเลยนะคะ', 
                               $imageUrl, 
                               $actionBuilder  
                           )
                        );  
                         break;
                  case 23: 

                      $text1 = $userMessage->id;
                      $text2 = $userMessage->content;

                      $textMessage1 = new TextMessageBuilder($text1);
                      $textMessage2 = new TextMessageBuilder($text2);

                      $multiMessage = new MultiMessageBuilder;
                      $multiMessage->add($textMessage1);
                      $multiMessage->add($textMessage2);
                      $textMessageBuilder = $multiMessage; 
                  break;
                  case 24:
                  $user = $userMessage;
                  $users_register = (new SqlController)->users_register_select($user);
                
                  $preg_week = $users_register->preg_week;

                  $user_Pre_weight = $users_register->user_Pre_weight;
                  $user_weight = $users_register->user_weight;
                  $user_height =  $users_register->user_height;
                  $status =  $users_register->status;

                  $bmi  = (new CalController)->bmi_calculator($user_Pre_weight,$user_height);
                  
                  $user_age =  $users_register->user_age;
                  $active_lifestyle =  $users_register->active_lifestyle;
                  $weight_criteria  = (new CalController)->weight_criteria($bmi);
                  $cal  = (new CalController)->cal_calculator($user_age,$active_lifestyle,$user_Pre_weight,$preg_week);

                   // $sq =  (new SqlController)->select_quizstep_user($user);
                   // $code_quiz1 = $sq->code_quiz;
                   // $reward_se =  (new SqlController)->reward_select($user,$code_quiz1);
                   $reward_se =  (new SqlController)->reward_select1($user);
                   $point = $reward_se->point;
                   if($point==null)
                    {
                      $point = 0;
                    }
                          $actionBuilder1 = array(
                            new UriTemplateActionBuilder(
                                'ดูบันทึกอาหาร', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/food_diary/'.$userMessage
                            ),
                            new UriTemplateActionBuilder(
                                'ดูบันทึกวิตามิน', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/vitamin_diary/'.$userMessage
                            ),
                            new UriTemplateActionBuilder(
                                'ดูบันทึกออกกำลังกาย', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/exercise_diary/'.$userMessage
                            ),
                            // new MessageTemplateActionBuilder(
                            //     'ข้อมูลส่วนตัว',// ข้อความแสดงในปุ่ม
                            //     'ข้อมูลส่วนตัว' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            // ),
                           );
                           $actionBuilder2 = array(
                            new MessageTemplateActionBuilder(
                                'บันทึกอาหาร',// ข้อความแสดงในปุ่ม
                                'บันทึกอาหารย้อนหลัง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new MessageTemplateActionBuilder(
                                'บันทึกวิตามิน',// ข้อความแสดงในปุ่ม
                                'บันทึกวิตามินย้อนหลัง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new MessageTemplateActionBuilder(
                                'บันทึกออกกำลังกาย',// ข้อความแสดงในปุ่ม
                                'บันทึกออกกำลังกายย้อนหลัง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                           );
                            $actionBuilder3 = array(
                            new MessageTemplateActionBuilder(
                                'ข้อมูลส่วนตัว',// ข้อความแสดงในปุ่ม
                                'ดูข้อมูล' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new MessageTemplateActionBuilder(
                                'ข้อมูลลูกน้อย', // ข้อความแสดงในปุ่ม
                                'ข้อมูลลูกน้อย'
                            ),
                            new MessageTemplateActionBuilder(
                                'บันทึกน้ำหนักย้อนหลัง',// ข้อความแสดงในปุ่ม
                                'บันทึกน้ำหนักย้อนหลัง' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                           );
                            $actionBuilder4 = array(
                            new UriTemplateActionBuilder(
                                'กราฟน้ำหนัก', // ข้อความแสดงในปุ่ม
                                'https://peat.none.codes/graph/'.$userMessage
                            ),
                            new MessageTemplateActionBuilder(
                                'น้ำหนักตัวที่เหมาะสม',// ข้อความแสดงในปุ่ม
                                'น้ำหนักตัวที่เหมาะสม' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new MessageTemplateActionBuilder(
                                'ข้อมูลโภชนาการ',// ข้อความแสดงในปุ่ม
                                'ข้อมูลโภชนาการ' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                           );
                              $actionBuilder5 = array(
                            new MessageTemplateActionBuilder(
                                'เงื่อนไขการรับสิทธิ์', // ข้อความแสดงในปุ่ม
                                'เงื่อนไขการรับสิทธิ์'
                            ),
                            new MessageTemplateActionBuilder(
                                'แลกของรางวัล',// ข้อความแสดงในปุ่ม
                                'แลกของรางวัล' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                            new MessageTemplateActionBuilder(
                                'รับของรางวัล',// ข้อความแสดงในปุ่ม
                                'รับของรางวัล' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                            ),
                           );
          
                        $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                        'ข้อมูลคุณแม่',
                                        'ข้อมูลส่วนตัวของคุณแม่',
                                        'https://peat.none.codes/image/diary4.jpg',
                                        $actionBuilder3
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                        'ข้อมูลโภชนาการของคุณแม่',
                                        'ค่าBMI คือ'.$bmi.' จำนวนแคลอรี่ที่คุณต้องการต่อวันคือ '.$cal,
                                        'https://peat.none.codes/image/diary5.jpg',
                                        $actionBuilder4
                                    ),                  
                                    new CarouselColumnTemplateBuilder(
                                        'ดูบันทึกย้อนหลัง',
                                        'ดูบันทึกอาหาร,การทานวิตามินและการออกกำลังกาย',
                                        'https://peat.none.codes/image/diary1.jpg',
                                        $actionBuilder1
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                        'บันทึกข้อมูลย้อนหลัง',
                                        'การบันทึกอาหาร,การทานวิตามินและการออกกำลังกายย้อนหลัง',
                                        'https://peat.none.codes/image/diary3.jpg',
                                        $actionBuilder2
                                    ), 
                                    new CarouselColumnTemplateBuilder(
                                        'แต้มสะสม',
                                        'ตอนนี้คุณแม่มีแต้มสะสม '.$point.' แต้มค่ะ',
                                        'https://peat.none.codes/card/badge.png',
                                        $actionBuilder5
                                    ), 
                                                                 
                                )
                            )
                        );
                    break;
                     case 25: 
                
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'บันทึกอาหารเช้า',
                                          'บันทึกอาหารเช้าย้อนหลัง' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'บันทึกอาหารกลางวัน',
                                          'บันทึกอาหารกลางวันย้อนหลัง' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'บันทึกอาหารเย็น',
                                          'บันทึกอาหารเย็นย้อนหลัง' 
                                          )  
                                         );

                        $imageUrl = NULL;
                        $textMessageBuilder = new TemplateMessageBuilder('ช่วงเวลาที่คุณต้องการบันทึก',
                        new ButtonTemplateBuilder(
                              'ช่วงเวลาที่คุณแม่ต้องการบันทึกย้อนหลังค่ะ', 
                              'กดเลือกด้านล่างเลยนะคะ', 
                               $imageUrl, 
                               $actionBuilder  
                           )
                        );  
                         break;
                    case 26: 
                
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'อาหารเช้า',
                                          'อาหารเช้า' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'อาหารกลางวัน',
                                          'อาหารกลางวัน' 
                                          ),
                                           new MessageTemplateActionBuilder(
                                          'อาหารเย็น',
                                          'อาหารเย็น' 
                                          ),  
                                          new MessageTemplateActionBuilder(
                                          'อาหารว่าง',
                                          'อาหารว่าง' 
                                          )  
                                         );

                        $imageUrl = NULL;
                        $textMessageBuilder = new TemplateMessageBuilder('แนะนำเมนูอาหาร',
                        new ButtonTemplateBuilder(
                              'แนะนำเมนูอาหารตามช่วงเวลาที่คุณแม่ต้องการค่ะ', 
                              'กดเลือกช่วงเวลาที่ต้องการได้เลยค่ะ', 
                               NULL, 
                               $actionBuilder  
                           )
                        );  
                         break;
                     case 27: 
                
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'ข้อมูลการใช้งาน',
                                          'ข้อมูลการใช้งาน' 
                                          ),
                                          new MessageTemplateActionBuilder(
                                          'เชื่อม Ulife.info',
                                          'เชื่อม Ulife.info' 
                                          ),
                                          new MessageTemplateActionBuilder(
                                          'วิดีโอการใช้งาน',
                                          'วิดีโอการใช้งาน' 
                                          ),
                                         );

                        $imageUrl = NULL;
                        $textMessageBuilder = new TemplateMessageBuilder('แนะนำการใช้งาน',
                        new ButtonTemplateBuilder(
                              'แนะนำการใช้งาน', 
                              'กดเลือกข้างล่างได้เลยค่ะ', 
                               NULL, 
                               $actionBuilder  
                           )
                        );  
                         break;
                      case 28: 
                
                          // กำหนด action 4 ปุ่ม 4 ประเภท
                          $actionBuilder = array(
                              new DatetimePickerTemplateActionBuilder(
                                  'Datetime Picker', // ข้อความแสดงในปุ่ม
                                  http_build_query(array(
                                      'action'=>'reservation',
                                      'person'=>5
                                  )), // ข้อมูลที่จะส่งไปใน webhook ผ่าน postback event
                                  'datetime', // date | time | datetime รูปแบบข้อมูลที่จะส่ง ในที่นี้ใช้ datatime
                                  substr_replace(date("Y-m-d H:i"),'T',10,1), // วันที่ เวลา ค่าเริ่มต้นที่ถูกเลือก
                                  substr_replace(date("Y-m-d H:i",strtotime("+5 day")),'T',10,1), //วันที่ เวลา มากสุดที่เลือกได้
                                  substr_replace(date("Y-m-d H:i"),'T',10,1) //วันที่ เวลา น้อยสุดที่เลือกได้
                              ),      
      
                          );
                          $imageUrl = 'https://www.mywebsite.com/imgsrc/photos/w/simpleflower';
                          $textMessageBuilder = new TemplateMessageBuilder('Button Template',
                              new ButtonTemplateBuilder(
                                      'button template builder', // กำหนดหัวเรื่อง
                                      'Please select', // กำหนดรายละเอียด
                                      $imageUrl, // กำหนด url รุปภาพ
                                      $actionBuilder  // กำหนด action object
                              )
                          );              
                      break;
                         case 29: 
                            $stickerID = 22;
                            $packageID = 2;
                            $textMessageBuilder = new StickerMessageBuilder($packageID,$stickerID);
                        
                      break;

                       case 30 :  
                 $textMessageBuilder = new TemplateMessageBuilder('ยืนยัน', new ConfirmTemplateBuilder('คุณแม่ยืนยันจะแลกของรางวัลชิ้นนี้ใช่ไหมคะ?' ,
                                array(
                                    new MessageTemplateActionBuilder(
                                        'ยืนยัน',
                                        'ยืนยัน'
                                    ),
                                    new MessageTemplateActionBuilder(
                                        'ไม่ยืนยัน',
                                        'ไม่ยืนยัน'
                                    )
                                )
                        )
                    ); 


                   break;
                     case 31: 
                
                        $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'แลกของรางวัล',
                                          'แลกของรางวัล' 
                                          ),
                                          new MessageTemplateActionBuilder(
                                          'รับของรางวัล',
                                          'รับของรางวัล' 
                                          ),
                                          new MessageTemplateActionBuilder(
                                          'exit',
                                          'Q' 
                                          ),
                                         );

                        $imageUrl = NULL;
                        $textMessage2 = new TemplateMessageBuilder('menu',
                        new ButtonTemplateBuilder(
                              'Menu', 
                              'เลือกด้านล่างได้เลยค่ะ', 
                              NULL, 
                              $actionBuilder  
                           )
                        );  
                        $textReplyMessage = $userMessage;
                        $textMessage1 = new TextMessageBuilder($textReplyMessage);
                        $multiMessage =     new MultiMessageBuilder;
                        $multiMessage->add($textMessage1);
                        $multiMessage->add($textMessage2);
                       // $multiMessage->add($textMessage3);
                        $textMessageBuilder = $multiMessage; 
                         break;
                  //      case 30: 
                  //         $textReplyMessage = $userMessage;
                  //         // $textMessage1 = new TextMessageBuilder($textReplyMessage);
                  //         // $textReplyMessage =   "คำถาม";
                  //         // $textMessage2 = new TextMessageBuilder($textReplyMessage);
                  //         $actionBuilder = array(
                  //                         new MessageTemplateActionBuilder(
                  //                         '1',// ข้อความแสดงในปุ่ม
                  //                         '1' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                  //                         ),
                  //                          new MessageTemplateActionBuilder(
                  //                         '2',// ข้อความแสดงในปุ่ม
                  //                         '2' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                  //                         ),
                  //                          new MessageTemplateActionBuilder(
                  //                         '3',// ข้อความแสดงในปุ่ม
                  //                         '3' // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                  //                         ) 
                  //                        );

                  //    $imageUrl = NULL;
                  //    $textMessage3 = new TemplateMessageBuilder('คำถาม',
                  //    new ButtonTemplateBuilder(
                  //             'คำถาม', // กำหนดหัวเรื่อง
                  //             'เลือกตอบด้านล่างได้เลยค่ะ', // กำหนดรายละเอียด
                  //              $imageUrl, // กำหนด url รุปภาพ
                  //              $actionBuilder  // กำหนด action object
                  //        )
                  //     );                            

                  // $multiMessage = new MultiMessageBuilder;
                  // // $multiMessage->add($textMessage1);
                  // // $multiMessage->add($textMessage2);
                  // $multiMessage->add($textMessage3);
                  // $textMessageBuilder = $multiMessage; 

             
                  //     break;
          
             }
                $response = $bot->replyMessage($replyToken,$textMessageBuilder); 
         
    }
      public function replymessage3($replyToken,$question,$choice1,$choice2,$choice3)
    {
            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));


                          // $textReplyMessage = $userMessage;
                          // $textMessage1 = new TextMessageBuilder($textReplyMessage);
                          // $textReplyMessage =   "คำถาม";
                          // $textMessage2 = new TextMessageBuilder($textReplyMessage);
                          $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          $choice1,// ข้อความแสดงในปุ่ม
                                          $choice1 // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                           new MessageTemplateActionBuilder(
                                          $choice2,// ข้อความแสดงในปุ่ม
                                          $choice2 // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          ),
                                          //  new MessageTemplateActionBuilder(
                                          // $choice3,// ข้อความแสดงในปุ่ม
                                          // $choice3 // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                          // ) 
                                         );

                     $imageUrl = NULL;
                     $textMessage3 = new TemplateMessageBuilder('คำถาม',
                     new ButtonTemplateBuilder(
                              NULL, // กำหนดหัวเรื่อง
                              $question, // กำหนดรายละเอียด
                               $imageUrl, // กำหนด url รุปภาพ
                               $actionBuilder  // กำหนด action object
                         )
                      );                            

                  $multiMessage = new MultiMessageBuilder;
                  // $multiMessage->add($textMessage1);
                  // $multiMessage->add($textMessage2);
                  $multiMessage->add($textMessage3);
                  $textMessageBuilder = $multiMessage; 

     
          
             
                $response = $bot->replyMessage($replyToken,$textMessageBuilder); 


    }
     public function replymessage4($replyToken)
    {
            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));
  
            $user_update = (new SqlController)->reward_gift(); 

              foreach($user_update as $value){  

                $a = array(
                                    new CarouselColumnTemplateBuilder(
                                        $value->name_gift,
                                        'จำนวนแต้มสะสม '.$value->point .' แต้ม',
                                        NULL,
                                        array(
                                            new MessageTemplateActionBuilder(
                                                 'แลก',// ข้อความแสดงในปุ่ม
                                                 $value->code_gift // ข้อความที่จะแสดงฝั่งผู้ใช้ เมื่อคลิกเลือก
                                            ),
                                           )
                                    ),                                  
                        );


              $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                $a
                            )
                        );

             }
          
             
                $response = $bot->replyMessage($replyToken,$textMessageBuilder); 


    }

public function replymessage5($replyToken,$user)
    {
            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));


                  $a = (new SqlController)->reward_gift();
                  $name_gift=[];
                  $point=[];
                  $code_gift=[];
              foreach ($a as  $value) {
                    $name_gift[] = $value->name_gift;
                    $point[] = $value->point;
                    $code_gift[] = $value->code_gift;
              } 
                  $name_gift1 = json_encode($name_gift,JSON_UNESCAPED_UNICODE);
                  $name_gift2 = json_decode($name_gift1,JSON_UNESCAPED_UNICODE);

                  $point1 = json_encode($point,JSON_UNESCAPED_UNICODE);
                  $point2 = json_decode($point1,JSON_UNESCAPED_UNICODE);

                  $code_gift1 = json_encode($code_gift,JSON_UNESCAPED_UNICODE);
                  $code_gift2 = json_decode($code_gift1,JSON_UNESCAPED_UNICODE);

                  $count = count($a);

                //   $textMessageBuilder = new TextMessageBuilder( $code_gift1 );
  
             switch ($count) {
                      case 1:
                      // $userMessage =  $c1[0]."\n".$c1[0] ;

                      $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[0] 
                                          ),
                                         );

                      $imageUrl = NULL;
                      $textMessageBuilder = new TemplateMessageBuilder('แนะนำการใช้งาน',
                        new ButtonTemplateBuilder(
                               $name_gift2[0],
                              'ใช้แต้ม '.$point2[0].' แต้ม',
                               NULL, 
                               $actionBuilder  
                           )
                        );  
                          break;
                      case 2:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[0] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[1] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[0],
                                        'ใช้แต้ม '.$point2[0].' แต้ม',
                                        NULL, 
                                        $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[1],
                                        'ใช้แต้ม '.$point2[1].' แต้ม',
                                        NULL, 
                                        $actionBuilder2  
                                    ),                                          
                                )
                            )
                      );
                          break;
                      case 3:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[0] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[1] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[2] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[0],
                                        'ใช้แต้ม '.$point2[0].' แต้ม',
                                        NULL, 
                                        $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[1],
                                        'ใช้แต้ม '.$point2[1].' แต้ม',
                                        NULL, 
                                        $actionBuilder2  
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[2],
                                        'ใช้แต้ม '.$point2[2].' แต้ม',
                                        NULL, 
                                        $actionBuilder3  
                                    ),                                                 
                                )
                            )
                      );
                          break;
                      case 4:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[0] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[1] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[2] 
                                          ),
                                         );
                      $actionBuilder4 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[3] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[0],
                                        'ใช้แต้ม '.$point2[0].' แต้ม',
                                        NULL, 
                                        $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[1],
                                        'ใช้แต้ม '.$point2[1].' แต้ม',
                                        NULL, 
                                        $actionBuilder2  
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[2],
                                        'ใช้แต้ม '.$point2[2].' แต้ม',
                                        NULL, 
                                        $actionBuilder3  
                                    ), 
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[3],
                                        'ใช้แต้ม '.$point2[3].' แต้ม',
                                        NULL, 
                                        $actionBuilder4  
                                    ),                                                 
                                )
                            )
                      );
                          break;
                      case 5:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[0] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[1] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[2] 
                                          ),
                                         );
                      $actionBuilder4 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[3] 
                                          ),
                                         );
                      $actionBuilder5 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[4] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[0],
                                        'ใช้แต้ม '.$point2[0].' แต้ม',
                                        NULL, 
                                        $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[1],
                                        'ใช้แต้ม '.$point2[1].' แต้ม',
                                        NULL, 
                                        $actionBuilder2  
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[2],
                                        'ใช้แต้ม '.$point2[2].' แต้ม',
                                        NULL, 
                                        $actionBuilder3  
                                    ), 
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[3],
                                        'ใช้แต้ม '.$point2[3].' แต้ม',
                                        NULL, 
                                        $actionBuilder4  
                                    ),  
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[4],
                                        'ใช้แต้ม '.$point2[4].' แต้ม',
                                        NULL, 
                                        $actionBuilder5  
                                    ),                                                
                                )
                            )
                      );
                          break;
                      case 6:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[0] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[1] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[2] 
                                          ),
                                         );
                      $actionBuilder4 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[3] 
                                          ),
                                         );
                      $actionBuilder5 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[4] 
                                          ),
                                         );
                      $actionBuilder6 = array(
                                          new MessageTemplateActionBuilder(
                                          'แลก',
                                          $code_gift2[5] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[0],
                                        'จำนวนแต้มสะสม '.$point2[0].' แต้ม',
                                        NULL, 
                                        $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[1],
                                        'จำนวนแต้มสะสม '.$point2[1].' แต้ม',
                                        NULL, 
                                        $actionBuilder2  
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[2],
                                        'จำนวนแต้มสะสม '.$point2[2].' แต้ม',
                                        NULL, 
                                        $actionBuilder3  
                                    ), 
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[3],
                                        'จำนวนแต้มสะสม '.$point2[3].' แต้ม',
                                        NULL, 
                                        $actionBuilder4  
                                    ),  
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[4],
                                        'จำนวนแต้มสะสม '.$point2[4].' แต้ม',
                                        NULL, 
                                        $actionBuilder5  
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                        $name_gift2[5],
                                        'จำนวนแต้มสะสม '.$point2[5].' แต้ม',
                                        NULL, 
                                        $actionBuilder6 
                                    ),                                                 
                                )
                            )
                      );
                          break;
                      // case "7":
                      //     echo "Your favorite color is red!";
                      //     break;
                      // case "8":
                      //     echo "Your favorite color is blue!";
                      //     break;
                      // case "9":
                      //     echo "Your favorite color is green!";
                      //     break;
                      default:

                      $userMessage = 'ไม่มีของรางวัล';
                      $textMessageBuilder = new TextMessageBuilder($userMessage);
                  }


                  $reward_se =  (new SqlController)->reward_select1($user);
                  $point = $reward_se->point;
                   if($point==null)
                    {
                      $point = 0;
                    }

                $textReplyMessage = 'ตอนนี้คุณแม่มีแต้มสะสม '.$point.' แต้มค่ะ หรือถ้าไม่ต้องการแลกของรางวัลคุณแม่พิมพ์ Q เพื่อออกจากหน้าการแลกของรางวัลค่ะ';
                $textMessage1 = new TextMessageBuilder($textReplyMessage);
                $multiMessage =     new MultiMessageBuilder;
                $multiMessage->add($textMessage1);
                $multiMessage->add( $textMessageBuilder);
                // $multiMessage->add($textMessage3);
                $textMessageBuilder = $multiMessage; 
                $response = $bot->replyMessage($replyToken,$textMessageBuilder); 


    }

    public function replymessage6($replyToken,$user)
    {
            $httpClient = new CurlHTTPClient('omL/jl2l8TFJaYFsOI2FaZipCYhBl6fnCf3da/PEvFG1e5ADvMJaILasgLY7jhcwrR2qOr2ClpTLmveDOrTBuHNPAIz2fzbNMGr7Wwrvkz08+ZQKyQ3lUfI5RK/NVozfMhLLAgcUPY7m4UtwVwqQKwdB04t89/1O/w1cDnyilFU=');
            $bot = new LINEBot($httpClient, array('channelSecret' => 'f571a88a60d19bb28d06383cdd7af631'));

                 $count = (new SqlController)->presenting_gift_count($user);

                 $reword = (new SqlController)->presenting_gift_group($user);
            
             switch ($count) {
                      case '1':
                      $actionBuilder = array(
                                          new MessageTemplateActionBuilder(
                                          'รับของรางวัล',
                                          $reword[0]['code_gift'] 
                                          ),
                                         );

                      $imageUrl = NULL;
                      $textMessageBuilder = new TemplateMessageBuilder('แนะนำการใช้งาน',
                        new ButtonTemplateBuilder(
                               $reword[0]['name_gift'],
                              'จำนวน: X '.$reword[0]['total'],
                               NULL, 
                               $actionBuilder  
                           )
                        );  
                          break;
                      case '2':
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[0]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[1]['code_gift'] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                         $reword[0]['name_gift'],
                                         'จำนวน: X'.$reword[0]['total'],
                                         NULL, 
                                         $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                         $reword[1]['name_gift'],
                                         'จำนวน: X'.$reword[1]['total'],
                                         NULL, 
                                         $actionBuilder2   
                                    ),                                          
                                )
                            )
                      );
                          break;
                      case 3:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[0]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[1]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[2]['code_gift'] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                         $reword[0]['name_gift'],
                                         'จำนวน: X'.$reword[0]['total'],
                                         NULL, 
                                         $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                         $reword[1]['name_gift'],
                                         'จำนวน: X'.$reword[1]['total'],
                                         NULL, 
                                         $actionBuilder2   
                                    ),  
                                     new CarouselColumnTemplateBuilder(
                                         $reword[2]['name_gift'],
                                         'จำนวน: X'.$reword[2]['total'],
                                         NULL, 
                                         $actionBuilder3   
                                    ),                                            
                                )
                            )
                      );
                          break;
                      case 4:
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[0]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[1]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[2]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder4 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[3]['code_gift'] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                         $reword[0]['name_gift'],
                                         'จำนวน: X'.$reword[0]['total'],
                                         NULL, 
                                         $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                         $reword[1]['name_gift'],
                                         'จำนวน: X'.$reword[1]['total'],
                                         NULL, 
                                         $actionBuilder2   
                                    ),  
                                    new CarouselColumnTemplateBuilder(
                                         $reword[2]['name_gift'],
                                         'จำนวน: X'.$reword[2]['total'],
                                         NULL, 
                                         $actionBuilder3   
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                         $reword[3]['name_gift'],
                                         'จำนวน: X'.$reword[3]['total'],
                                         NULL, 
                                         $actionBuilder4   
                                    ),                                             
                                )
                            )
                      );
                          break;
                      case "5":
                     $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[0]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[1]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[2]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder4 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[3]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder5 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[4]['code_gift'] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                         $reword[0]['name_gift'],
                                         'จำนวน: X'.$reword[0]['total'],
                                         NULL, 
                                         $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                         $reword[1]['name_gift'],
                                         'จำนวน: X'.$reword[1]['total'],
                                         NULL, 
                                         $actionBuilder2   
                                    ),  
                                    new CarouselColumnTemplateBuilder(
                                         $reword[2]['name_gift'],
                                         'จำนวน: X'.$reword[2]['total'],
                                         NULL, 
                                         $actionBuilder3   
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                         $reword[3]['name_gift'],
                                         'จำนวน: X'.$reword[3]['total'],
                                         NULL, 
                                         $actionBuilder4   
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                         $reword[4]['name_gift'],
                                         'จำนวน: X'.$reword[4]['total'],
                                         NULL, 
                                         $actionBuilder5  
                                    ),                                                    
                                )
                            )
                      );
                          break;
                      case "6":
                      $actionBuilder1 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[0]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder2 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[1]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder3 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[2]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder4 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[3]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder5 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[4]['code_gift'] 
                                          ),
                                         );
                      $actionBuilder6 = array(
                                          new MessageTemplateActionBuilder(
                                         'รับของรางวัล',
                                          $reword[5]['code_gift'] 
                                          ),
                                         );
                      $textMessageBuilder = new TemplateMessageBuilder('Carousel',
                            new CarouselTemplateBuilder(
                                array(

                                    new CarouselColumnTemplateBuilder(
                                         $reword[0]['name_gift'],
                                         'จำนวน: X'.$reword[0]['total'],
                                         NULL, 
                                         $actionBuilder1  
                                    ),    
                                    new CarouselColumnTemplateBuilder(
                                         $reword[1]['name_gift'],
                                         'จำนวน: X'.$reword[1]['total'],
                                         NULL, 
                                         $actionBuilder2   
                                    ),  
                                    new CarouselColumnTemplateBuilder(
                                         $reword[2]['name_gift'],
                                         'จำนวน: X'.$reword[2]['total'],
                                         NULL, 
                                         $actionBuilder3   
                                    ),   
                                    new CarouselColumnTemplateBuilder(
                                         $reword[3]['name_gift'],
                                         'จำนวน: X'.$reword[3]['total'],
                                         NULL, 
                                         $actionBuilder4   
                                    ),
                                    new CarouselColumnTemplateBuilder(
                                         $reword[4]['name_gift'],
                                         'จำนวน: X'.$reword[4]['total'],
                                         NULL, 
                                         $actionBuilder5  
                                    ),  
                                    new CarouselColumnTemplateBuilder(
                                         $reword[5]['name_gift'],
                                         'จำนวน: X'.$reword[5]['total'],
                                         NULL, 
                                         $actionBuilder6  
                                    ),                                                       
                                )
                            )
                      );
                          break;
                      // case "7":
                      //     echo "Your favorite color is red!";
                      //     break;
                      // case "8":
                      //     echo "Your favorite color is blue!";
                      //     break;
                      // case "9":
                      //     echo "Your favorite color is green!";
                      //     break;
                      default:
                      $userMessage = 'ไม่มีของรางวัล';
                      $textMessageBuilder = new TextMessageBuilder($userMessage);
                      $response = $bot->replyMessage($replyToken,$textMessageBuilder);
                  }
         
                $textReplyMessage = 'รับของรางวัล';
                $textMessage1 = new TextMessageBuilder($textReplyMessage);
                $multiMessage =     new MultiMessageBuilder;
                $multiMessage->add($textMessage1);
                $multiMessage->add( $textMessageBuilder);
                // $multiMessage->add($textMessage3);
                $textMessageBuilder = $multiMessage; 
                $response = $bot->replyMessage($replyToken,$textMessageBuilder);  


    }


}
