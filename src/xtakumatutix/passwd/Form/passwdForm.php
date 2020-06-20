<?php

namespace xtakumatutix\passwd\Form;

use pocketmine\form\Form;
use pocketmine\Player;
use xtakumatutix\passwd\Main;
use pocketmine\utils\Config;

Class passwdForm implements Form
{
    public function __construct(Main $Main)
    {
        $this->Main = $Main;
    }

    public function handleResponse(Player $player, $data): void
    {
        if ($data === null) {
            $player->kick('§cパスワードがわからない場合、管理者まで連絡してください',false);
            return;
        }
        $config = $this->Main->pass;
        $pass = $config->get($player->getName());
        if ($data[0] == $pass){
            $player->sendMessage(' §a>> 認証完了');
            return;
        }else{
            $player->sendForm(new passwdForm($this->Main));
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
                    'text' => 'パスワードを入力',
                ]
            ],
        ];
    }
}