<?php

namespace revivalpmmp\pureentities\entity\monster\walking;

use revivalpmmp\pureentities\entity\monster\WalkingMonster;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use revivalpmmp\pureentities\data\Data;

class Silverfish extends WalkingMonster{
    const NETWORK_ID = Data::SILVERFISH;

    public $width = 0.4;
    public $height = 0.2;

    public function getSpeed() : float{
        return 1.4;
    }

    public function initEntity(){
        parent::initEntity();

        $this->setMaxDamage(8);
        $this->setDamage([0, 1, 1, 1]);
    }

    public function getName(){
        return "Silverfish";
    }

    public function attackEntity(Entity $player){
        if($this->attackDelay > 10 && $this->distanceSquared($player) < 1){
            $this->attackDelay = 0;

            $ev = new EntityDamageByEntityEvent($this, $player, EntityDamageEvent::CAUSE_ENTITY_ATTACK, $this->getDamage());
            $player->attack($ev->getFinalDamage(), $ev);
        }
    }

    public function getDrops(){
        return [];
    }

}
