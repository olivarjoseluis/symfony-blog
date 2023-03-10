<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Factory\CategoryFactory;
use App\Factory\CommentFactory;
use App\Factory\PostFactory;
use App\Factory\UserFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'name' => 'Admin',
            'email' => 'olivarjoseluis9@gmail.com',
            'roles' => ['ROLE_ADMIN']
        ]);

        UserFactory::createOne([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ]);
        UserFactory::createMany(8);

        CategoryFactory::createMany(8);
        PostFactory::createMany(40, function () {
            return [
                'comments' => CommentFactory::new()->many(0, 8),
                'category' => CategoryFactory::random(),
                'user' => UserFactory::random(),
            ];
        });
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
