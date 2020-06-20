<?php

namespace xtakumatutix\passwd;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\Player;
use pocketmine\utils\Config;
use xtakumatutix\passwd\Form\passwdForm;
use xtakumatutix\passwd\Form\passwdsetForm;

class EventListener implements Listener
{
    private $Main;

    public function __construct(Main $Main)
    {
        $this->Main = $Main;
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $config = $this->Main->pass;
        if ($config->exists($player->getName())) {
            if ($config->get($player->getName()) != "notpass") {
                $player->sendForm(new passwdForm($this->Main));
            }
        } else {
            $player->sendForm(new passwdsetForm($this->Main));
        }
    }
}