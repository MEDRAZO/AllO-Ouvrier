<?php

namespace App\Factory;

use App\Entity\Announces;
use App\Repository\AnnouncesRepository;
use App\Repository\UserRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Announces>
 *
 * @method        Announces|Proxy                     create(array|callable $attributes = [])
 * @method static Announces|Proxy                     createOne(array $attributes = [])
 * @method static Announces|Proxy                     find(object|array|mixed $criteria)
 * @method static Announces|Proxy                     findOrCreate(array $attributes)
 * @method static Announces|Proxy                     first(string $sortedField = 'id')
 * @method static Announces|Proxy                     last(string $sortedField = 'id')
 * @method static Announces|Proxy                     random(array $attributes = [])
 * @method static Announces|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AnnouncesRepository|RepositoryProxy repository()
 * @method static Announces[]|Proxy[]                 all()
 * @method static Announces[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Announces[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Announces[]|Proxy[]                 findBy(array $attributes)
 * @method static Announces[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Announces[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AnnouncesFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(private readonly UserRepository $userRepository)
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'created_at' => \DateTimeImmutable::createFromMutable(self::faker()->dateTime()),
            'description' => self::faker()->paragraph(),
            'status' => self::faker()->randomElement(['online', 'offline']),
            'title' => self::faker()->name(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function(Announces $announces): void {
                $users = $this->userRepository->findAll();
                $randomUser = self::faker()->randomElement($users);
                $announces->setClient($randomUser);
            })
        ;
    }

    protected static function getClass(): string
    {
        return Announces::class;
    }
}
