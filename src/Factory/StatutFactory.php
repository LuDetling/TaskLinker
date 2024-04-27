<?php

namespace App\Factory;

use App\Entity\Projet;
use App\Entity\Statut;
use App\Repository\StatutRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Statut>
 *
 * @method        Statut|Proxy                     create(array|callable $attributes = [])
 * @method static Statut|Proxy                     createOne(array $attributes = [])
 * @method static Statut|Proxy                     find(object|array|mixed $criteria)
 * @method static Statut|Proxy                     findOrCreate(array $attributes)
 * @method static Statut|Proxy                     first(string $sortedField = 'id')
 * @method static Statut|Proxy                     last(string $sortedField = 'id')
 * @method static Statut|Proxy                     random(array $attributes = [])
 * @method static Statut|Proxy                     randomOrCreate(array $attributes = [])
 * @method static StatutRepository|RepositoryProxy repository()
 * @method static Statut[]|Proxy[]                 all()
 * @method static Statut[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Statut[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Statut[]|Proxy[]                 findBy(array $attributes)
 * @method static Statut[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Statut[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class StatutFactory extends ModelFactory
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
            'libelle' => self::faker()->word(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Statut $statut): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Statut::class;
    }
}
