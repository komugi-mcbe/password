<?php

namespace xtakumatutix\passwd\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use xtakumatutix\passwd\Main;
use pocketmine\utils\Config;

Class passwdsetForm implements Form
{
    public function __construct(Main $Main)
    {
        $this->Main = $Main;
    }

    public function handleResponse(Player $player, $data): void
    {
        $config = $this->Main->pass;
        if ($data === null) {
            $config->set($player->getName(), "notpass");
            $config->save();
            $player->sendMessage(' §c>> §fパスワードを無効にしました');
            return;
        }

        if ($data[0] == $data[1] and $data[0] == 'notpass') {
            $config->set($player->getName(), "notpass");
            $config->save();
            $player->sendMessage(' §c>> §fパスワードを無効にしました');
            return;
        }

        if ($data[0] == $data[1]){
            $config->set($player->getName(), $data[0]);
            $config->save();
            $player->sendMessage(' §a>> §fパスワードを保存しました！「'.$data[0].'」');
        }else{
            $player->sendForm(new passwdsetForm($this->Main));
        }
    }

    public function jsonSerialize()
    {
        return [
            'type' => 'custom_form',
            'title' => 'セキリュティ',
            'content' => [
                [
                    'type' => 'input',
                    'text' => "新しいパスワードを入力\nformを閉じたり、notpassと入力するとパスワードを無効にできます",
                ],
                [
                    'type' => 'input',
                    'text' => '新しいパスワードの確認',
                ]
            ],
        ];
    }
}