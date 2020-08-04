<?php

namespace xtakumatutix\passwd\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use xtakumatutix\passwd\Main;
use xtakumatutix\passwd\Form\passwdMainForm;
use pocketmine\utils\Config;

Class passwdcheakForm implements Form
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

        $config = $this->Main->pass;
        $pass = $config->get($player->getName());
        if (password_verify($data[0], $pass)){
            $player->sendForm(new passwdMainForm($this->Main));
            return;
        }else{
            $player->sendMessage(' §c>> §fパスワードが間違っているためキャンセルしました。');
        }
    }

    public function jsonSerialize()
    {
        return [
            'type' => 'custom_form',
            'title' => 'セキリュティ画面',
            'content' => [
                [
                    'type' => 'input',
                    'text' => 'パスワードを入力',
                ]
            ],
        ];
    }
}