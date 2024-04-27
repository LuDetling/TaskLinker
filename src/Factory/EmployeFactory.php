<?php

namespace App\Factory;

use App\Entity\Employe;
use App\Repository\EmployeRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Employe>
 *
 * @method        Employe|Proxy                     create(array|callable $attributes = [])
 * @method static Employe|Proxy                     createOne(array $attributes = [])
 * @method static Employe|Proxy                     find(object|array|mixed $criteria)
 * @method static Employe|Proxy                     findOrCreate(array $attributes)
 * @method static Employe|Proxy                     first(string $sortedField = 'id')
 * @method static Employe|Proxy                     last(string $sortedField = 'id')
 * @method static Employe|Proxy                     random(array $attributes = [])
 * @method static Employe|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EmployeRepository|RepositoryProxy repository()
 * @method static Employe[]|Proxy[]                 all()
 * @method static Employe[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Employe[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Employe[]|Proxy[]                 findBy(array $attributes)
 * @method static Employe[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Employe[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EmployeFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
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
            'dateStart' => self::faker()->dateTime(),
            'email' => self::faker()->email(),
            'firstname' => self::faker()->firstName(),
            'lastname' => self::faker()->lastName(),
            'statut' => self::faker()->text(20),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Employe $employe): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Employe::class;
    }
}
