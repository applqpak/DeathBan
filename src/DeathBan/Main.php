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

      $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array("ban_after_deaths" => 5, "ban_message" => "You have died too many times!"));

      $this->getServer()->getPluginManager()->registerEvents($this, $this);

    }

    public function onDisable()
    {

      $this->getServer()->getLogger()->info("Disabled.");

    }

    public function onPlayerDeath(PlayerDeathEvent $event)
    {

      $player = $event->getPlayer();

      $player_name = $player->getName();

      $ban_after_deaths = $this->cfg->get("ban_after_deaths");

      $ban_message = $this->cfg->get("ban_message");

      if(!(file_exists($this->getDataFolder() . $player_name . ".txt")))
      {

        touch($this->getDataFolder() . ".txt");

        file_put_contents($this->getDataFolder() . $player_name . ".txt", 0);

      }
      else
      {

        $deaths = file_get_contents($this->getDataFolder() . $player_name . ".txt");

        if($deaths >= $ban_after_deaths)
        {

          $player->kick($ban_message, false);

          $this->getServer()->getNameBans()->addBan($player_name, "Died too many times.", null, "DeathBan");

        }
        else
        {

          file_put_contents($this->getDataFolder() . $player_name . ".txt", $deaths + 1);

        }

      }

    }

  }

?>
