<?php

  namespace DeathBan;

  use pocketmine\plugin\PluginBase;
  use pocketmine\utils\Config;
  use pocketmine\utils\TextFormat as TF;
  use pocketmine\event\Listener;
  use pocketmine\event\player\PlayerDeathEvent;

  class Main extends PluginBase implements Listener
  {

    public function onEnable()
    {

      @mkdir($this->getDataFolder());

      $this->getServer()->getLogger()->info("Enabled.");

      $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array("ban_after_deaths" => 5));

      $this->bans = new Config($this->getDataFolder() . "bans.yml", Config::YAML, array());

    }

    public function onDisable()
    {

      $this->getServer()->getLogger()->info("Disabled.");

    }

    public function onPlayerDeath(PlayerDeathEvent $event)
    {

    }

  }

?>
