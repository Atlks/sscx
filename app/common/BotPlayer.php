<?php

declare(strict_types=1);

namespace app\common;

use app\common\Game;
use app\common\helper;
use app\model\User;
use app\model\BotplayerConfig;
use app\model\Setting;
use app\model\BotWords;

class BotPlayer
{
    private $game = null;

    private $menu = [];
    private $user_id = null;
    public $reply_text = "";      // 需要回复的文本
    public $reply_keyboard = "";  // 需要回复的键盘
    public $reply_mode = "";      // 需要回复的模式
    public $need_reply = false;   // 是否需要回复当前的信息
    public $send_photo = false;

    public $start = false;

    // user_id  用户Tg_id
    function __construct($user_id,$game)
    {
        $this->user_id = $user_id;
        // 设置来源
        $game->from = 3;
        $this->game = $game;
        $this->addMenu('开始命令', 'callStart');
        $this->addMenu('投注按键', 'callPlay');
    }

    public function HandleMessage($message)
    {
        $text = $message['text'];

        if (isset($this->menu[$text])) {
            $call = $this->menu[$text];
            if ($call) {
                $this->$call($message);
                return;
            }
        }

        if ($this->game) {
            $stop = Setting::find(4)->value == 1;
            if(!$stop)
                $stop = Setting::find(3)->value == 1;
            $this->reply_text = $this->game->player_exec($text, $stop);
            $this->send_photo = $this->game->sendTrend();
            if ($this->game->action()) {
                $keyboard = json_decode(BotWords::where('Id', 1)->find()->Button_Text, true);
                $reply_keyboard =
                    [
                        'inline_keyboard' => $keyboard,
                    ];
                $this->reply_keyboard =  $reply_keyboard;
            }
            else if($this->game->keyboard)
            {
                $reply_keyboard =
                [
                    'inline_keyboard' => $this->game->keyboard,
                ];
                $this->reply_keyboard =  $reply_keyboard;
            }
            $this->need_reply = !$this->send_photo;
        }
    }

    private function addMenu($key, $callback)
    {
        $str = BotplayerConfig::where('name', $key)->find()->content;
        $this->menu[$str] = $callback;
    }

    private function getContent($name)
    {
        return BotplayerConfig::where('name', $name)->find()->content;
    }

    private function callStart($message = null)
    {

        $user = User::where('Tg_Id', $this->user_id)->find();
        $this->reply_text = Helper::replaceFromUser($user, $this->getContent('开始界面'));
        $this->reply_mode = "MarkdownV2";
        $keyboard = json_decode(BotplayerConfig::where('name', '输入框菜单')->find()->content);
        /*
        $reply_keyboard =
            [
                'keyboard' => $keyboard,
                'resize_keyboard' => true,
            ];
        */
        $this->reply_keyboard = $keyboard;
        $this->start = true;
    }

    // 投注
    private function callPlay()
    {
        $this->reply_text = "👇👇👇点击下方按钮进群投注👇👇👇";
        $keyboard = json_decode($this->getContent('我要投注'), true);
        $reply_keyboard =
            [
                'inline_keyboard' => $keyboard
            ];
        $this->reply_keyboard = json_encode($reply_keyboard);
        $this->need_reply = true;
    }
}
