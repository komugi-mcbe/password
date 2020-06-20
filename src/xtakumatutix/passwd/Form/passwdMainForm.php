<?php

namespace xtakumatutix\passwd\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use xtakumatutix\passwd\Main;
use xtakumatutix\passwd\Form\passwdsetForm;
use pocketmine\utils\Config;

Class passwdMainForm implements Form
{
    public function __construct(Main $Main)
    {
        $this->Main = $Main;
    }

    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            return;
        }

        switch ($data){
            case 0:
                $player->sendForm(new passwdsetForm($this->Main));
                break;

            case 1:
                $config = $this->Main->pass;
                $config->set($player->getName(), "notpass");
                $player->sendMessage(' §a>> §fパスワードを無効にしました');
                break;
        }
    }

    public function jsonSerialize()
    {
        return [
            'type' => 'form',
            'title' => 'セキリュティ',
            'content' => 'パスワード設定メニューです',
            'buttons' => [
                [
                    'text' => 'パスワードを設定',
                ],
                [
                    'text' => 'パスワードを削除',
                ]
            ],
        ];
    }
}