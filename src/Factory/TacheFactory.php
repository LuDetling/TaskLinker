<?php

namespace App\Factory;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use DateTime;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

use function Symfony\Component\Clock\now;

/**
 * @extends ModelFactory<Tache>
 *
 * @method        Tache|Proxy                     create(array|callable $attributes = [])
 * @method static Tache|Proxy                     createOne(array $attributes = [])
 * @method static Tache|Proxy                     find(object|array|mixed $criteria)
 * @method static Tache|Proxy                     findOrCreate(array $attributes)
 * @method static Tache|Proxy                     first(string $sortedField = 'id')
 * @method static Tache|Proxy                     last(string $sortedField = 'id')
 * @method static Tache|Proxy                     random(array $attributes = [])
 * @method static Tache|Proxy                     randomOrCreate(array $attributes = [])
 * @method static TacheRepository|RepositoryProxy repository()
 * @method static Tache[]|Proxy[]                 all()
 * @method static Tache[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Tache[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Tache[]|Proxy[]                 findBy(array $attributes)
 * @method static Tache[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Tache[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class TacheFactory extends ModelFactory
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
            'title' => self::faker()->words(3, true),
            'description' => self::faker()->paragraph(3),
            'deadline' =>  new DateTime(),
            // 'employe' => EmployeFactory::random(),
            'projet' => ProjetFactory::random(),
            'statut' => StatutFactory::random(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Tache $tache): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Tache::class;
    }
}
