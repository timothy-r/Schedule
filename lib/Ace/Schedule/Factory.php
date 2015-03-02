<?php namespace Ace\Schedule;

use Ace\Schedule\FactoryInterface;
use Ace\Schedule\BuilderInterface;
use Ace\Schedule\DirectorInterface;
use Ace\Schedule\ParserFactoryInterface;
use Ace\Schedule\Entry;

/**
* This is the single 'public' class for external clients
*
* Creates an Entry object for a given schedule string and type
*/
class Factory implements FactoryInterface
{
	/**
	* @var DirectorInterface
	*/
	private $director;

	/**
	* @var BuilderInterface
	*/
	private $builder;

    /**
     * @var ParserFactoryInterface
     */
    private $parser_factory;

	/**
	* @param DirectorInterface $director
	* @param BuilderInterface $builder
    * @param ParserFactoryInterface $parser_factory
	*/
	public function __construct(
        DirectorInterface $director,
        BuilderInterface $builder,
        ParserFactoryInterface $parser_factory
    ){
		$this->director = $director;
		$this->builder = $builder;
        $this->parser_factory = $parser_factory;
	}

	/*
	* @param string $schedule
	* @param string $type
	* @throws Ace\Schedule\Exception
	*
	* @return Ace\Schedule\Entry
	*/
	public function createEntry($schedule, $type)
	{
		// build schedule and inject into Entry
		$this->director->setBuilder($this->builder);
        $this->director->setParser($this->parser_factory->create($type));
		$this->director->create($schedule);
        return $this->builder->getProduct();
	}
}
