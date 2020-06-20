<?php

namespace xtakumatutix\passwd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use xtakumatutix\passwd\Form\passwdcheakForm;
use xtakumatutix\passwd\Form\passwdMainForm;

class Main extends PluginBase
{
    public function onEnable()
    {
        $this->getLogger()->notice("読み込み完了 - ver." . $this->getDescription()->getVersion());
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
        $this->pass = new Config($this->getDataFolder() . "pass.yml", Config::YAML);
        $this->ip = new Config($this->getDataFolder() . "ip.yml", Config::YAML);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if (!$this->pass->exists($sender->getName()) or $this->pass->get($sender->getName()) == "notpass") {
            $sender->sendForm(new passwdMainForm($this));
            return true;
        } else {
            $sender->sendForm(new passwdcheakForm($this));
            return true;
        }
    }
}