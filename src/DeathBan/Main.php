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

    }

    public function onDisable()
    {

      $this->getServer()->getLogger()->info("Disabled.");

    }

    public function onPlayerDeath(PlayerDeathEvent $event)
    {

      $player = $event->getPlayer();

      $player_name = $player->getName();

      if(!(file_exists($this->getDataFolder() . $player_name . ".txt")))
      {

        touch($this->getDataFolder() . ".txt");

        file_put_contents($this->getDataFolder() . $player_name . ".txt", 0);

      }
      else
      {

        $deaths = file_get_contents($this->getDataFolder() . $player_name . ".txt");

      }

    }

  }

?>
