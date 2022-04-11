<?php

namespace SellUI\DaDevGuy;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use libs\jojoe77777\FormAPI\SimpleForm;


class Main extends PluginBase
{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if($command->getName() === "sellui"){
            if($sender instanceof Player){
                $this->sellform($sender);
            } else {
                $sender->sendMessage("Please Use This Command In-Game!");
            }
            return true;
        }
        return false;
    }

    public function sellform($player)
    {
        $form = new SimpleForm(function (Player $player, int $data = null){
            if($data === null){
                return true;
            }

            switch($data){
                case 0:
                    $this->getServer()->dispatchCommand($player, "sell hand");
                    break;
                case 1:
                    $this->getServer()->dispatchCommand($player, "sell ores");
                    break;
                case 2:
                    $this->getServer()->dispatchCommand($player, "sell inv");
                    break;
                case 3:
                    break;
            };
        });
        $name = $player->getName();
        $form->setTitle("§l§eSellUI");
        $form->setContent("§2$name, §6Please Select What You Want To Sell!");
        $form->addButton("§3Sell Hand\n§9»» §r§oTap to Sell", 0, "textures/ui/permissions_visitor_hand");
        $form->addButton("§3Sell Ores\n§9»» §r§oTap to Sell", 0, "textures/items/diamond");
        $form->addButton("§3Sell Inventory\n§9»» §r§oTap to Sell", 0, "textures/ui/MCoin");
        $form->addButton("§3Exit\n§9»» §r§oTap to Close", 0, "textures/ui/close_button_default");
        $form->sendToPlayer($player);
        return $form;
    }
}