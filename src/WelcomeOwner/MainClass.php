<?php

namespace WelcomeOwner;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\permission\ServerOperator;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;

class MainClass extends PluginBase implements Listener{
	public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		if(!file_exists($this->getDataFolder() . "config.yml")){
			@mkdir($this->getDataFolder());
			file_put_contents($this->getDataFolder() . "config.yml",$this->getResource("config.yml"));
		}
	}
    public function onJoin(PlayerJoinEvent $event){
    $player = $event->getPlayer();
	$owner = $this->getConfig()->get("Owner");
	$coowner = $this->getConfig->get("CoOwner");
	$name = $player->getDisplayName();
	if($name == $owner){
		$this->getServer()->broadcastMessage("The Owner has joined the game.");
	}elseif($name == $coowner){
		$this->getServer->broadcastMessage("The Co Owner has joined the game.");
	}
    }
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    	if(strtolower($command->getName()) === "owner"){
    		$owner = $this->getConfig()->get("Owner");
    		$name = $sender->getDisplayName();
    		if($sender->hasPermission("welcomeowner.command.owner")){
    			if($name == $owner){
    				$sender->sendMessage("[WelcomeOwner] You are the owner!");
    			}else{
    				$sender->sendMessage("[WelcomeOwner] The Owner is " .$owner.);
    			}
    			}else{
    				$sender->sendMessage("You don't have permission to do that!");
    			}
    	}elseif(strtolower($command->getName()) === "coowner"){
    		$coowner = $this->getConfig()->get("CoOwner");
    		$name = $sender->getDisplay/name();
    		if($sender->hasPermission("welcomeowner.command.coowner")){
    			if($name == $coowner){
    				$sender->sendMessage("[WelcomeOwner] You are the Co Owner!");
    			}else{
    				$sender->sendMessage("[WelcomeOwner] The CO Owner is " .$coowner.);
    			}
    		}else{
    			$sender->sendMessage("You don't have permission to do that!");
    		}
    	}
    }
}
