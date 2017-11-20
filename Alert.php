<?php
namespace aminkt\widgets\alert;


use yii\base\Widget;

class Alert extends Widget
{
    public static $messages=[];

    public static function error($title, $message, $name = null){
        if(!$name)
            $name = time()+rand(0,100);
        \Yii::$app->session->setFlash($name, ['cat'=>'error', 'title'=>$title, 'message'=>$message]);
    }

    public static function info($title, $message, $name = null){
        if(!$name)
            $name = time()+rand(0,100);
        \Yii::$app->session->setFlash($name, ['cat'=>'info', 'title'=>$title, 'message'=>$message]);
    }

    public static function warning($title, $message, $name = null){
        if(!$name)
            $name = time()+rand(0,100);
        \Yii::$app->session->setFlash($name, ['cat'=>'warning', 'title'=>$title, 'message'=>$message]);
    }

    public static function success($title, $message, $name = null){
        if(!$name)
            $name = time()+rand(0,100);
        \Yii::$app->session->setFlash($name, ['cat'=>'success', 'title'=>$title, 'message'=>$message]);
    }

    public function init(){
		foreach (\Yii::$app->session->getAllFlashes() as $key => $message) {
			if($message['cat'] == 'info' or $message['cat'] == 'error' or $message['cat'] == 'warning' or $message['cat'] == 'success') {
				static::$messages[] = ['cat'=>$message['cat'], 'title'=>$message['title'], 'message'=>$message['message']];
				\Yii::$app->session->removeFlash($key);
			}
		}
    }

    /**
     * Show alert in the place called this function.
     * @param array $config Message configuration like this:
     *
     * ['cat'=>'info', 'title'=>'Alert title', 'message'=>'Alert message.']
     * @return string
     */
    public static function show($config){
        if($config){
            $config = [$config];
            return static::generateAlert($config);
        }
        return null;
    }

    public function run(){
        if(static::$messages)
            return static::generateAlert(static::$messages);
    }


    /**
     *  Generate Alert
     * @param array $messages
     * @return string
     */
    private static function generateAlert($messages){
        $html = '';
        foreach($messages as $message) {
            $c = $message['cat']=='error'?'danger':$message['cat'];
            $t = $message['title'];
            $m = $message['message'];

            $html.=<<<HTML
<div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-$c alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
HTML;
                        $icon = 'fa-info-circle';
                        if($c == 'warning')
                            $icon = 'fa-warning';
                        elseif($c == 'danger')
                            $icon = 'fa-times-circle';
                        elseif($c == 'success')
                            $icon = 'fa-check';
$html.=<<<HTML
                        <i class="fa $icon "></i>
                        <strong>$t</strong><br>
                        $m
                    </div>
                </div>
            </div>
            <!-- /.row -->
HTML;
        }
        return $html;
    }
}