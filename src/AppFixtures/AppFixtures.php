<?php

namespace App\AppFixtures;

use App\Factory\AnnouncesFactory;
use App\Factory\CommentsFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const USER_NBR = 10;
    const ANNOUNCES_NBR = 10;
    const COMMENTS_NBR = 10;
    public function load(ObjectManager $manager): void
    {
        UserFactory::createMany(self::USER_NBR);
        AnnouncesFactory::createMany(self::ANNOUNCES_NBR);
        CommentsFactory::createMany(self::COMMENTS_NBR);
    }
}
